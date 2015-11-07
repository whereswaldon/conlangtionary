<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Language;
use App\Policies\LanguagePolicy;
use App\Description;
use App\Policies\DescriptionPolicy;
use App\Definition;
use App\Policies\DefinitionPolicy;
use App\Word;
use App\Policies\WordPolicy;
use App\Tag;
use App\Policies\TagPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Language::class => LanguagePolicy::class,
        Word::class => WordPolicy::class,
        Description::class => DescriptionPolicy::class,
        Definition::class => DefinitionPolicy::class,
        Tag::class => TagPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        $gate->before(function ($user, $ability) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        //
    }
}