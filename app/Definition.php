<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Definition extends Model
{
    protected $fillable = [
        'definition_number',
        'definition_text',
        'word_id',
    ];

    protected $table = 'definitions';

    public function word() {
        return $this->belongsTo('App\Word');
    }
}
