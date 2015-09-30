<?php

namespace App\Http\Controllers;
use App\Definition;
use App\Word;
use App\Language;
use Illuminate\Http\Request;

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
        //
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
        $def = Definition::where('id', $id)->firstOrFail();
        $def->update($data);

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
        $def = Definition::where('id', $id)->firstOrFail();
        $def->delete();

        return redirect('definitions');
    }
}
