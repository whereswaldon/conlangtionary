<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
	protected $fillable = [
	    'ascii_string',
	    'language_id',
	];

	protected $table = 'words';

	public function language() {
		return $this->belongsTo('App\Language');
	}

    public function definitions() {
        return $this->hasMany('App\Definition');
    }
}
