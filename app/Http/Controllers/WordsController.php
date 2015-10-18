<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $words = Word::orderBy('language_id')->orderBy('ascii_string')->get();
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
        $data = $request->all();
        $newLang = Word::create($data);

        return redirect('words');
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

        return redirect('words');
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

        return redirect('words');
    }
}
