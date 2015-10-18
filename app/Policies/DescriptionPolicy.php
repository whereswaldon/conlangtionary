<?php

namespace App\Policies;

use App\User;
use App\Description;

class DescriptionPolicy
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
     * Check whether the authenticated user can view the descriptions index.
     *
     */
    public function index(User $user)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can create a description.
     *
     * @return Response
     */
    public function create(User $user)
    {
        //TODO:
        return false;
    }

    /**
     * Check whether the authenticated user can save a new description.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(User $user)
    {
        //TODO:
        return false;
    }

    /**
     * Check whether the authenticated user can view a description.
     *
     * @param  int $id
     * @return Response
     */
    public function show(User $user, Description $description)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can edit a description.
     *
     * @param  int $id
     * @return Response
     */
    public function edit(User $user, Description $description)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can update a description.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(User $user, Description $description)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can delete a description.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(User $user, Description $description)
    {
        //TODO:
        return false;
    }
}
