<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;
use App\Language;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WordsController extends Controller
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
	    $languages = Language::orderBy('name')->get();
	    $words = Word::orderBy('ascii_string')->get();
	    return view('words.index', compact('words', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
	    $languages = Language::orderBy('name')->get();
	    return view('words.create', compact('languages'));
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
	   $newLang = Word::create($data);

	   return redirect('words');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
	    $word = Word::where('id', $id)->firstOrFail();
	    return view('words.show', compact('word'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
	    $languages = Language::orderBy('name')->get();
	    $word = Word::where('id', $id)->firstOrFail();
	    return view('words.edit', compact('word', 'languages'));
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
	    $word = Word::where('id', $id)->firstOrFail();
	    $word->update($data);

	    return redirect('words');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
	    $word = Word::where('id', $id)->firstOrFail();
	    $word->delete();

	    return redirect('words');
    }
}
