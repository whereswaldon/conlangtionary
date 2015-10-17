<?php

namespace App\Http\Controllers;

use App\Description;
use Illuminate\Http\Request;
use Gate;
use Flash;
use App\Language;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LanguagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function search(Request $request) {
        $data = $request->all();
        $language = Language::where('id', $data['language_id'])->firstOrFail();
        $results = Language::where('languages.id', $data['language_id'])
            ->search($data['search-term'])
            ->with('words')
            ->get();
        return view('search.results', compact('results', 'language'));
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
        $languages = Language::orderBy('name')->get();
        return view('languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (Gate::denies('create')) {
            Flash::error('You do not have permission to create languages.');
            return redirect()->back();
        }
        //
        return view('languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('store')) {
            Flash::error('You do not have permission to save languages.');
            return redirect()->back();
        }
        $data = $request->all();
        $newLang = Language::create($data);
        Description::create(['description' => "I'm a new language!", 'language_id' => $newLang->id]);
        return redirect('languages');
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
//        if (Gate::denies('show', $language)) {
//              Flash::error('You do not have permission to view this language.');
//            return redirect()->back();
//        }
        return view('languages.show', compact('language'));
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

        return redirect('languages');
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
        $language->delete();

        return redirect('languages');
    }
}
