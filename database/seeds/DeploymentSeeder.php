<?php

use Illuminate\Database\Seeder;

class DeploymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(LatinSeeder::class);
        $this->call(FakeLanguageSeeder::class);

        Model::reguard();
    }
}
