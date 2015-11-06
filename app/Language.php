<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes;

    /**
     * The variables within the Language model that can be filled in
     * by the user.
     *
     * @var array
     */
 	protected $fillable = [
        'name',
        'notes',
        'short_description',
	];   //

    /**
     * The database table that this model uses.
     *
     * @var string
     */
	protected $table = 'languages';

    /**
     * A language has many words.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function words() {
		return $this->hasMany('App\Word');
	}

    /**
     * A language has one description
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function description() {
        return $this->hasOne('App\Description');
    }

    /**
     * A language has many tags.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags() {
        return $this->hasMany(Tag::class);
    }
}
