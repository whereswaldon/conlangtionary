<?php

namespace App\Policies;

use App\User;
use App\Language;
class LanguagePolicy
{
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Give super administrators the ability to do everything.
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Check whether the authenticated user can view the languages index.
     *
     * @return bool
     */
    public function index(User $user)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can create a new language.
     *
     * @return bool
     */
    public function create(User $user)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can save a new language
     *
     * @return bool
     */
    public function store(User $user)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can view a language.
     *
     * @return bool
     */
    public function show(User $user, Language $language)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can edit a Language.
     *
     * @return bool
     */
    public function edit(User $user, Language $language)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticaed user can update a language.
     *
     * @return bool
     */
    public function update(User $user, Language $language)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can delete a language.
     *
     * @return bool
     */
    public function destroy(User $user, Language $language)
    {
        //TODO:
        return false;
    }
}
