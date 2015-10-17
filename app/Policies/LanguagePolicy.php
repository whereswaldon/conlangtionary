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
     */
    public function index(User $user)
    {
        //TODO:
        return true;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(User $user)
    {
        //TODO:
        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(User $user)
    {
        //TODO:
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show(User $user, Language $language)
    {
        //TODO:
        return true;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit(User $user, Language $language)
    {
        //TODO:
        return true;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(User $user, Language $language)
    {
        //TODO:
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(User $user, Language $language)
    {
        //TODO:
        return false;
    }
}
