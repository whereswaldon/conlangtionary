<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gate;
use App\Tag;
use App\Language;
use App\Definition;
use Laracasts\Flash\Flash;

class TagsController extends Controller
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
//          Flash::error('You do not have permission to see the tags listing.');
//          return redirect()->back();
//       }
        $languages = Language::orderBy('name')->get();
        $tags = Tag::orderBy('language_id')->orderBy('name')->paginate(20);
        return view('tags.index', compact('tags', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (Gate::denies('create', new Tag())) {
            Flash::error('You do not have permission to create a new tag in this language.');
            return redirect()->back();
        }
        $languages = Language::orderBy('name')->get();
        return view('tags.create', compact('languages'));
    }

    /**
     * Redirects the user to the creation form for a tag with the language preselected.
     * @param Language $language
     * @return \Illuminate\View\View
     */
    public function createForLanguage($id) {
        $target_language = Language::where('id', $id)->firstOrFail();
        $languages = Language::all();
        return view('tags.create', compact('languages', 'target_language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('store', new Tag())) {
            Flash::error('You do not have permission to save a new tag in this language.');
            return redirect()->back();
        }
        $data = $request->all();
        $tag= Tag::create($data);

        return redirect()->action('LanguagesController@show', [$tag->language->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $tag = Tag::where('id', $id)->firstOrFail();
//       if (Gate::denies('show', $tag)) {
//          Flash::error('You do not have permission to view this tag.');
//          return redirect()->back();
//       }
        return view('tags.show', compact('tag'));
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
        $tag = Tag::where('id', $id)->firstOrFail();
        if (Gate::denies('edit', $tag)) {
            Flash::error('You do not have permission to edit this tag.');
            return redirect()->back();
        }
        return view('tags.edit', compact('tag', 'languages'));
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
        $tag = Tag::where('id', $id)->firstOrFail();
        if (Gate::denies('update', $tag)) {
            Flash::error('You do not have permission to update this tag.');
            return redirect()->back();
        }
        $tag->update($data);

        return redirect()->action('LanguagesController@show', [$tag->language->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $tag = Tag::where('id', $id)->firstOrFail();
        if (Gate::denies('destroy', $tag)) {
            Flash::error('You do not have permission to delete this tag.');
            return redirect()->back();
        }
        foreach($tag->definitions as $definition) {
            $definition->delete();
        }
        $tag->delete();

        return redirect()->action('LanguagesController@show', [$tag->language->id]);
    }
}
