<?php

namespace App\Policies;
use App\User;
use App\Definition;

class DefinitionPolicy
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
     * Check whether the authenticated user can view the definitions index.
     *
     */
    public function index(User $user)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can create a definition.
     *
     * @return Response
     */
    public function create(User $user)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can save a new definition.
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
     * Check whether the authenticated user can view a definition.
     *
     * @param  int $id
     * @return Response
     */
    public function show(User $user, Definition $definition)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can edit a definition.
     *
     * @param  int $id
     * @return Response
     */
    public function edit(User $user, Definition $definition)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can update a definition.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(User $user, Definition $definition)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can delete a definition.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(User $user, Definition $definition)
    {
        //TODO:
        return false;
    }
}
