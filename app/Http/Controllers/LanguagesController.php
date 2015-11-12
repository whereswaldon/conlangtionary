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
        return view('search.results', compact('word_results', 'definition_results', 'language'));
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
        $words = Word::where('language_id', $language->id)->paginate(20);
//        if (Gate::denies('show', $language)) {
//              Flash::error('You do not have permission to view this language.');
//            return redirect()->back();
//        }
        return view('languages.show', compact('language', 'words'));
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
