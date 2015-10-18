<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Description extends Model
{
    use SoftDeletes;

    protected $table = 'descriptions';

    protected $fillable = [
        'description',
        'language_id',
    ];

    public function language() {
        return $this->belongsTo('App\Language');
    }
}
