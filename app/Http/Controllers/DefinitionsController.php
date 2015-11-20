<?php

namespace App\Http\Controllers;
use App\Definition;
use App\Word;
use App\Language;
use Illuminate\Http\Request;
use Gate;
use Flash;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DefinitionsController extends Controller
{
    public function __construct() {
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
//          Flash::error('You do not have permission to see the definitions listing.');
//          return redirect()->back();
//       }
        $definitions = Definition::orderBy('word_id')->orderBy('definition_number')->paginate(20);
        return view('definitions.index', compact('definitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (Gate::denies('create', new Definition())) {
            Flash::error('You do not have permission to create a new definition.');
            return redirect()->back();
        }
        $words = Word::orderBy('language_id')->orderBy('ascii_string')->get();
        return view('definitions.create', compact('languages', 'words'));
    }

    /**
     * Redirects the user to the creation form for a word with the language preselected.
     * @param Language $language
     * @return \Illuminate\View\View
     */
    public function createForWord($id) {
        $target_word = Word::find($id);
        $words = Word::where('language_id', $target_word->language->id)->orderBy('ascii_string')->get();
        $languages = Language::where('id', $target_word->language->id);
        $tags = $target_word->language->tags;
        return view('definitions.create', compact('languages', 'words', 'target_word', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('store', new Definition())) {
            Flash::error('You do not have permission to save a new definition for this word.');
            return redirect()->back();
        }
        $data = $request->all();
        $otherDefs = Definition::where('word_id', $data['word_id'])->get();
        $data['definition_number'] = count($otherDefs) + 1;
        $newDef= Definition::create($data);

        //handle tags, if any are in the request.
        if (isset($data['tags'])) {
            //Attach the given tags to the word.
            $currentTags = $newDef->word->language->tags; //Get all tags on the language
            foreach($data['tags'] as $tagName) { //attach each tag
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
        return redirect()->action('LanguagesController@show', [$newDef->word->language->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $definition = Definition::where('id', $id)->firstOrFail();
//       if (Gate::denies('show', $definition)) {
//          Flash::error('You do not have permission to view this definition.');
//          return redirect()->back();
//       }
        return view('definitions.show', compact('definition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $definition = Definition::where('id', $id)->firstOrFail();
        $words = Word::orderBy('language_id')->orderBy('ascii_string')->get();
        if (Gate::denies('edit', $definition)) {
            Flash::error('You do not have permission to edit this definition.');
            return redirect()->back();
        }
        $tags = $definition->word->language->tags;
        return view('definitions.edit', compact('definition', 'words', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $definition = Definition::where('id', $id)->firstOrFail();
        if (Gate::denies('update', $definition)) {
            Flash::error('You do not have permission to update this definition.');
            return redirect()->back();
        }
        $definition->update($data);

        //Attach the given tags to the word.
        $languageTags = $definition->word->language->tags; //Get all tags on the language
        if (isset($data['tags'])) {
            foreach($data['tags'] as $tagName) { //attach each tag
                $matchingTag = $languageTags->where('name', $tagName)->first();
                if ( $matchingTag ) { //if the tag exists, just associate it.
                    if (! $definition->tags->contains($matchingTag)) { //if the tag is already on the word
                        $definition->tags()->attach($matchingTag->id);
                    }
                } else { //otherwise, create it and then associate it
                    $newTag = $definition->word->language->tags()->create([
                        'name' => $tagName,
                        'abbreviation' => "($tagName)",
                        'description' => 'A new tag, as yet undefined',
                    ]);
                    $definition->tags()->attach($newTag);
                }
            }
            $removeAll = array_diff($definition->tags->pluck('name')->toArray(), $data['tags']);
            foreach ($removeAll as $nameToRemove) {
                $definition->tags()->detach($languageTags->where('name', $nameToRemove)->first());
            }
        }
        return redirect()->action('LanguagesController@show', [$definition->word->language->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $definition = Definition::where('id', $id)->firstOrFail();
        if (Gate::denies('destroy', $definition)) {
            Flash::error('You do not have permission to delete this word.');
            return redirect()->back();
        }
        $definition->delete();

        return redirect()->action('LanguagesController@show', [$definition->word->language->id]);
    }
}
