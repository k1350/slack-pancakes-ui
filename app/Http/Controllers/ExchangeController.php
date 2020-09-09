<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TotalPancake;
use App\Models\Prize;
use App\Models\SlackUser;
use App\Models\ExchangePrize;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;


class ExchangeController extends Controller
{

    /** 交換完了画面表示用のセッションキー */
    const SESSION_KEY = __CLASS__ . "::complete";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 交換所トップ
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 現在認証されているユーザーの取得
        $user = Auth::user();
        // total取得
        $total = TotalPancake::where('user_id', $user->user_id)
        ->select('received', 'sent', 'used')
        ->firstOrFail();

        // 使用可能数
        $number = $total->received - $total->used;

        // Slackのユーザー
        $slack_user = SlackUser::where('id', $user->user_id)
        ->select('team_id')
        ->firstOrFail();

        // 景品
        $prizes = Prize::where([
            ['deleted', '=', 0],
        ])
        ->select('id', 'name', 'description', 'number', 'url')
        ->orderBy('number', 'desc')
        ->get();

        return view('exchange.index')
        ->with('number', $number)
        ->with('prizes', $prizes);
    }

    /**
     * 確認画面
     */
    public function confirm(Request $request) {
        try {
            $id = decrypt($request->input('id'));
            $name = decrypt($request->input('name'));
            $number = decrypt($request->input('number'));

            return view('exchange.confirm')
            ->with('id', $id)
            ->with('name', $name)
            ->with('number', $number);
        } catch (DecryptException $e) {
            report($e);
            return redirect('exchange')->with('error', __('messages.generalError'));
        }
    }

    /**
     * 景品交換
     */
    public function exchange(Request $request) {
        try {
            $id = decrypt($request->input('id'));
            $number = decrypt($request->input('number'));

            $result = $this->save($id, $number);

            if ($result) {
                $random = encrypt(str_random(16));
                $request->session()->put(self::SESSION_KEY, $random);
                return redirect()->action('ExchangeController@complete', ['key' => $random]);
            }

            return redirect('exchange')->with('error', __('messages.generalError'));

        } catch (DecryptException $e) {
            report($e);
            return redirect('exchange')->with('error', __('messages.generalError'));
        }
    }

    /**
     * 完了画面
     */
    public function complete(Request $request) {
        if (!$request->session()->has(self::SESSION_KEY)) {
            return redirect('exchange');
        }

        $random_session = $request->session()->get(self::SESSION_KEY);
        $request->session()->forget(self::SESSION_KEY);
        if ($random_session != $request->input('key')) {
            return redirect('exchange');
        }

        return view('exchange.complete');
    }

    /**
     * 保存
     * @param $id
     * @param $number
     * @return 保存成否
     */
    private function save($id, $number) {
        // 現在認証されているユーザーの取得
        $user = Auth::user();

        DB::beginTransaction();

        try {
            $exchange = new ExchangePrize;
            $exchange->user_id = $user->user_id;
            $exchange->prize_id = $id;
            $exchange->save();

            $total = TotalPancake::where('user_id',$user->user_id)->firstOrFail();
            $total->used = $total->used + $number;
            $total->save();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return false;
        }
    }
}
