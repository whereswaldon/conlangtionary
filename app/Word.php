<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Word extends Model
{
    use SoftDeletes;

    /**
     * The attributes of this model that can be filled in
     * by the user.
     *
     * @var array
     */
	protected $fillable = [
	    'ascii_string',
	    'language_id',
        'notes',
	];

    /**
     * The database table for this model.
     *
     * @var string
     */
	protected $table = 'words';

    /**
     * A word belongs to a language.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function language() {
		return $this->belongsTo('App\Language');
	}

    /**
     * A word has many definitions.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function definitions() {
        return $this->hasMany('App\Definition');
    }
}
