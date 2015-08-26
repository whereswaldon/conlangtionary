<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
 	protected $fillable = [
	  'name'  
	];   //

	protected $table = 'languages';

	public function words() {
		return $this->hasMany('App\Word');
	}
}
