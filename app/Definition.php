<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Definition extends Model
{
    use SoftDeletes;

    /**
     * The values of this model that can be filled from the UI.
     * @var array
     */
    protected $fillable = [
        'definition_number',
        'definition_text',
        'word_id',
        'notes',
    ];

    /**
     * The name of the database table for this model.
     * @var string
     */
    protected $table = 'definitions';

    /**
     * This definition belongs to one word.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function word() {
        return $this->belongsTo('App\Word');
    }

    /**
     * This definition can have many tags.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags() {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
