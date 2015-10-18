<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Definition extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'definition_number',
        'definition_text',
        'word_id',
        'notes',
    ];

    protected $table = 'definitions';

    public function word() {
        return $this->belongsTo('App\Word');
    }
}
