<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Definition;
use Gate;
use Flash;
use App\Word;
use App\Language;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//       if (Gate::denies('index')) {
//          Flash::error('You do not have permission to see the words listing.');
//          return redirect()->back();
//       }
        $languages = Language::orderBy('name')->get();
        $words = Word::orderBy('language_id')->orderBy('ascii_string')->paginate(20);
        return view('words.index', compact('words', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (Gate::denies('create', new Word())) {
            Flash::error('You do not have permission to create a new word in this language.');
            return redirect()->back();
        }
        $languages = Language::orderBy('name')->get();
        return view('words.create', compact('languages'));
    }

    /**
     * Redirects the user to the creation form for a word with the language preselected.
     * @param Language $language
     * @return \Illuminate\View\View
     */
    public function createForLanguage($id, $withDefinition = false) {
        $target_language = Language::where('id', $id)->firstOrFail();
        $languages = Language::all();
        return view('words.create', compact('languages', 'target_language', 'withDefinition'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('store', new Word())) {
            Flash::error('You do not have permission to save a new word in this language.');
            return redirect()->back();
        }
        //handle the possibility of an attached definition
        $data = $request->all();
        $word = Word::create([
            'ascii_string' => $data['ascii_string'],
            'language_id' => $data['language_id'],
            'notes' => $data['notes'],
        ]);
        if ($data['withDefinition']) {
            $newDef = Definition::create([
                'definition_number' => 1,
                'definition_text' => $data['definition_text'],
                'definition_notes' => $data['definition_notes'],
                'word_id' => $word->id,
            ]);

            //handle tags, if any are in the request.
            if (isset($data['definition_tags'])) {
                //Attach the given tags to the word.
                $currentTags = $newDef->word->language->tags; //Get all tags on the language
                foreach($data['definition_tags'] as $tagName) { //attach each tag
                    $matchingTag = $currentTags->where('name', $tagName)->first();
                    if ( $matchingTag ) { //if the tag exists, just associate it.
                        $newDef->tags()->attach($matchingTag->id);
                    } else { //otherwise, create it and then associate it
                        $newTag = $newDef->word->language->tags()->create([
                            'name' => $tagName,
                            'abbreviation' => "($tagName)",
                            'description' => 'A new tag, as yet undefined',
                        ]);
                        $newDef->tags()->attach($newTag);
                    }
                }
            }
        }

        return redirect()->action('LanguagesController@show', [$word->language->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $word = Word::where('id', $id)->firstOrFail();
//       if (Gate::denies('show', $word)) {
//          Flash::error('You do not have permission to view this word.');
//          return redirect()->back();
//       }
        return view('words.show', compact('word'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $languages = Language::orderBy('name')->get();
        $word = Word::where('id', $id)->firstOrFail();
        if (Gate::denies('edit', $word)) {
            Flash::error('You do not have permission to edit this word.');
            return redirect()->back();
        }
        return view('words.edit', compact('word', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $word = Word::where('id', $id)->firstOrFail();
        if (Gate::denies('update', $word)) {
            Flash::error('You do not have permission to update this word.');
            return redirect()->back();
        }
        $word->update($data);

        return redirect()->action('LanguagesController@show', [$word->language->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $word = Word::where('id', $id)->firstOrFail();
        if (Gate::denies('destroy', $word)) {
            Flash::error('You do not have permission to delete this word.');
            return redirect()->back();
        }
        foreach($word->definitions as $definition) {
            $definition->delete();
        }
        $word->delete();

        return redirect()->action('LanguagesController@show', [$word->language->id]);
    }
}
