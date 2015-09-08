<?php

use Illuminate\Database\Seeder;

class LatinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'name' => 'Latin'
        ]);
        $latin = \App\Language::where('name', 'Latin')->firstOrFail();
        DB::table('words')->insert([
            'ascii_string' => 'vendi',
            'language_id' => $latin->id,
        ]);
        DB::table('descriptions')->insert([
            'description' => 'Test data',
            'language_id' => $latin->id,
        ]);
        $vendi = \App\Word::where('ascii_string', 'vendi')->firstOrFail();
        DB::table('definitions')->insert([
            'definition_number' => 1,
            'definition_text' => 'came',
            'word_id' => $vendi->id,
        ]);
    }
}
