<?php

namespace App\Policies;

use App\User;
use App\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

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
     * Check whether the authenticated user can view the tags index.
     *
     */
    public function index(User $user)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can create a tag.
     *
     * @return Response
     */
    public function create(User $user)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can save a new tag.
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
     * Check whether the authenticated user can view a tag.
     *
     * @param  int $id
     * @return Response
     */
    public function show(User $user, Tag $tag)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can edit a tag.
     *
     * @param  int $id
     * @return Response
     */
    public function edit(User $user, Tag $tag)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can update a tag.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(User $user, Tag $tag)
    {
        //TODO:
        return true;
    }

    /**
     * Check whether the authenticated user can delete a tag.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(User $user, Tag $tag)
    {
        //TODO:
        return false;
    }
}
