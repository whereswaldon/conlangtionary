<?php

namespace App\Http\Controllers;

use App\Description;
use Illuminate\Http\Request;
use Gate;
use Flash;
use App\Language;
use App\Http\Requests;
use App\Word;
use App\Definition;
use App\Http\Controllers\Controller;
use Markdown;

class LanguagesController extends Controller
{
    /**
     * Create a constructor and expose only index, show, and search
     * functions to unauthenticated users.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'search']]);
    }

    /**
     * Sends the requestor to the generator form.
     */
    public function morphologicalGenerator($language_id) {
        $language = Language::find($language_id);
        $tags = $language->tags;
        return view('generators.morphological', ['tags' => $tags, 'language' => $language]);
    }

    /**
     * Do the work of generating definitions based upon the given patterns.
     * @param Request $request
     */
    public function processMorphologicalGenerator(Request $request, $language_id) {

        //$sourceTags is the array of tag ids selected in the UI
        $sourceTags = $request->source_tags;
        $sourceCount = count($sourceTags);

        //$targetTags is the array of target tag ids selected in the UI
        $targetTags = $request->target_tags;

        //The language that the generator is being run on
        $language = Language::find($language_id);

        //Used to hold a working set of words in a given language
        $targetWords = $language->words;

        //$finalTargets holds every definition found with the desired tags
        $finalTargets = [];

        //$finalDefinitions ultimately holds all definitions created by the generator
        $finalDefinitions = [];

        /**
         * How this needs to work:
         * for each definition in the language, find all ids of that definition's tags
         * intersect those tags against the source tags
         * if the count of the intersection is the same as the count of the source tags, keep that definition
         */
        foreach($targetWords as $word) {
            $targetDefinitions = $word->definitions->filter(function($item) use ($sourceTags, $sourceCount) {
                $tagIds = $item->tags->pluck('id')->toArray();
                //if the intersection of the tags present on the definition and the desired tags is smaller
                //than the number of desired tags, it lacks some of them.
                if (count(array_intersect($sourceTags, $tagIds)) < $sourceCount) {
                    return false;
                }
                //otherwise, we want this definition
                return true;
            });
            foreach($targetDefinitions as $definition) {
                array_push($finalTargets, $definition);
            }
        }
        //dd($finalTargets);
        foreach($finalTargets as $target) {
            //generate the new word string with substitution
            $newWord = preg_replace(
                $request->source_pattern,
                $request->target_pattern,
                $target->word->ascii_string
            );

            //Check whether a word with this Ascii representation already exists. If so, use it.
            $word = $language->words()->where('ascii_string', $newWord)->first();
            if (! $word) {
                $word = $language->words()->create(['ascii_string' => $newWord]);
            }

            //attach a new definition with the correct tags and text to that word
            $definition = $word->definitions()
                ->create([
                    'definition_text' => $target->definition_text,
                    'definition_number' => 1,
                ]);
            $definition->generated = true;
            $definition->tags()->sync($targetTags);
            $definition->save();
            array_push($finalDefinitions, $definition);
        }

        return view('definitions.generated', compact('finalDefinitions'));
    }

    /**
     * Look for the search term within the words and definitions of the given language.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request) {
        $data = $request->all();
        $language = Language::where('id', $data['language_id'])->firstOrFail();
        $word_results = Word::where('language_id', $language->id)
            ->where('ascii_string', 'like', "%{$data['search-term']}%")
            ->get();
        $definition_results = Definition::join('words', 'definitions.word_id', '=', 'words.id')
            ->where('language_id', $language->id)
            ->where('definition_text', 'like', "%{$data['search-term']}%")
            ->get();
        $tag_results = $language->tags()->where('name', 'like', "%{$data['search-term']}%")->get();
        return view('search.results', compact('word_results', 'definition_results', 'tag_results', 'language'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        if (Gate::denies('index')) {
//              Flash::error('You do not have permission to see the languages listing.');
//            return redirect()->back();
//        }
        $languages = Language::orderBy('name')->paginate(20);
        return view('languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (Gate::denies('create', new Language())) {
            Flash::error('You do not have permission to create languages.');
            return redirect()->back();
        }
        //
        return view('languages.create');
    }

    /**
     * Store a newly created resource in storage.
     * Storing a new language also creates an empty description for that language.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('store', new Language())) {
            Flash::error('You do not have permission to save languages.');
            return redirect()->back();
        }
        $data = $request->all();
        $newLang = Language::create($data);
        Description::create(['description' => "I'm a new language!", 'language_id' => $newLang->id]);

        return redirect()->action('LanguagesController@show', [$newLang->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $language = Language::where('id', $id)->firstOrFail();
        $words = Word::where('language_id', $language->id)->orderBy('ascii_string')->paginate(30);
//        if (Gate::denies('show', $language)) {
//              Flash::error('You do not have permission to view this language.');
//            return redirect()->back();
//        }
        $description = Markdown::string($language->description->description);
        return view('languages.show', compact('language', 'words', 'description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $language = Language::where('id', $id)->firstOrFail();
        if (Gate::denies('edit', $language)) {
            Flash::error('You do not have permission to edit this language.');
            return redirect()->back();
        }
        return view('languages.edit', compact('language'));
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
        $language = Language::where('id', $id)->firstOrFail();
        if (Gate::denies('update', $language)) {
            Flash::error('You do not have permission to update this language.');
            return redirect()->back();
        }
        $language->update($data);

        return redirect()->action('LanguagesController@show', [$language->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $language = Language::where('id', $id)->firstOrFail();
        if (Gate::denies('destroy', $language)) {
            Flash::error('You do not have permission to delete this language.');
            return redirect()->back();
        }
        $words = $language->words;
        foreach ($words as $word) {
            foreach ($word->definitions as $definition) {
                $definition->delete();
            }
            $word->delete();
        }
        $language->description->delete();
        $language->delete();

        return redirect('languages');
    }
}
