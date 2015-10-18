<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    /**
     * The Role model fields that can be updated from the front end.
     * Deliberately empty.
     * @var array
     */
    protected $fillable = [];

    /**
     * Specifies the name of the database table for this model.
     * @var string
     */
    protected $table = 'roles';

    /**
     * Fetches the users with this role.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany('App\User');
    }
}
