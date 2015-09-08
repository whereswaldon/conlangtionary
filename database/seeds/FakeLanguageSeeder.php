<?php

use Illuminate\Database\Seeder;

class FakeLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Language::class, 10)->create()->each(function ($language) {
            $description = factory(\App\Description::class, 1)->make();
            $description->language_id = $language->id;
            $description->save();
            factory(\App\Word::class, 10)
                ->make()
                ->each(
                    function ($word) use ($language) {
                        $word->language_id = $language->id;
                        $word->save();
                        factory(\App\Definition::class, rand(2, 5))
                            ->make()
                            ->each(
                                function ($definition) use ($word) {
                                    $definition->word_id = $word->id;
                                    $definition->save();
                                }
                            );
                    }
                );
        });
    }
}
