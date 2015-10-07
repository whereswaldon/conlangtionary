<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Language extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'languages.name' => 3,
            'words.ascii_string' => 10,
            'definitions.definition_text' => 5
        ],
        'joins' => [
            'words' => ['languages.id', 'words.language_id'],
            'definitions' => ['words.id', 'definitions.word_id']
        ]
    ];

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
