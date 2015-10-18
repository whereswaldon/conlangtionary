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
        $definitions = Definition::orderBy('word_id')->orderBy('definition_number')->get();
        return view('definitions.index', compact('definitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
//        if (Gate::denies('create')) {
//            Flash::error('You do not have permission to create a new definition.');
//            return redirect()->back();
//        }
        $words = Word::orderBy('language_id')->orderBy('ascii_string')->get();
        return view('definitions.create', compact('languages', 'words'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('create')) {
            Flash::error('You do not have permission to save a new definition for this word.');
            return redirect()->back();
        }
        $data = $request->all();
        $newDef= Definition::create($data);

        return redirect('definitions');
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
        return view('definitions.edit', compact('definition', 'words'));
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

        return redirect('definitions');
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

        return redirect('definitions');
    }
}
