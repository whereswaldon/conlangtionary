<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Word extends Model
{
    use SoftDeletes;

	protected $searchable = [
		'columns' => [
			'ascii_string' => 10,
		]
	];
	protected $fillable = [
	    'ascii_string',
	    'language_id',
        'notes',
	];

	protected $table = 'words';

	public function language() {
		return $this->belongsTo('App\Language');
	}

    public function definitions() {
        return $this->hasMany('App\Definition');
    }
}
