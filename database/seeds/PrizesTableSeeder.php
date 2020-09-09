<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PrizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prizes')->insert([
            [
                'name' => '景品１',
                'description' => '説明',
                'number' => 550,
                'url' => Storage::url('image/prize1.jpg'),
                'deleted' => 0
            ],
            [
                'name' => '景品2',
                'description' => '説明',
                'number' => 500,
                'url' => Storage::url('image/prize2.jpg'),
                'deleted' => 0
            ],
            [
                'name' => '景品3',
                'description' => '説明',
                'number' => 5500,
                'url' => "",
                'deleted' => 1
            ],
            [
                'name' => '景品4',
                'description' => '説明',
                'number' => 1000,
                'url' => Storage::url('image/prize3.jpg'),
                'deleted' => 0
            ],
        ]);
    }
}
