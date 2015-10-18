<?php

namespace App\Policies;
use App\User;
use App\Word;

class WordPolicy
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
     * Check whether the authenticated user can view the words index.
     *
     */
    public function index(User $user)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can create a word.
     *
     * @return Response
     */
    public function create(User $user)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can save a new word.
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
     * Check whether the authenticated user can view a word.
     *
     * @param  int $id
     * @return Response
     */
    public function show(User $user, Word $word)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can edit a word.
     *
     * @param  int $id
     * @return Response
     */
    public function edit(User $user, Word $word)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can update a word.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(User $user, Word $word)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can delete a word.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(User $user, Word $word)
    {
        //TODO:
        return false;
    }
}
