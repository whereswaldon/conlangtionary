<?php

namespace App;

use App\Language;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The name of the database table for this model.
     * @var string
     */
    protected $table = 'tags';

    /**
     * The fields that can be filled out from the user interface.
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'abbreviation',
        'language_id',
    ];

    /**
     * This tag belongs to one language.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language() {
        return $this->belongsTo(Language::class);
    }

    /**
     * This tag applies to many definitions.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function definitions() {
        return $this->belongsToMany(Definition::class)->withTimestamps();
    }
}
