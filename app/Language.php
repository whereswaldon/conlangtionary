<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes;

 	protected $fillable = [
        'name',
        'notes',
        'short_description',
	];   //

	protected $table = 'languages';

	public function words() {
		return $this->hasMany('App\Word');
	}

    public function description() {
        return $this->hasOne('App\Description');
    }
}
