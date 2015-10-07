<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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

        $this->call(FakeLanguageSeeder::class);

        Model::reguard();
    }
}
