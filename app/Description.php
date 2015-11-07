<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Description extends Model
{
    use SoftDeletes;

    /**
     * The database table for this model.
     *
     * @var string
     */
    protected $table = 'descriptions';

    /**
     * The attributes of this model that the user can fill in.
     * @var array
     */
    protected $fillable = [
        'description',
        'language_id',
    ];

    /**
     * This description belongs to one language.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language() {
        return $this->belongsTo('App\Language');
    }
}
