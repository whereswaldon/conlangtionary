<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Language' => 'App\Policies\LanguagePolicy',
        'App\Word' => 'App\Policies\WordPolicy',
        'App\Description' => 'App\Policies\DescriptionPolicy',
        'App\Definition' => 'App\Policies\DefinitionPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $gate->before(function ($user, $ability) {
            if ($user->isAdmin()) {
                return true;
            }
        });
        parent::registerPolicies($gate);

        //
    }
}