<?php

namespace App\Http\Controllers;
use App\Description;
use App\Language;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DescriptionsController extends Controller
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
        $descriptions = Description::orderBy('language_id')->get();
        return view('descriptions.index', compact('descriptions', 'languages'));
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
        return view('descriptions.create', compact('languages'));
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
        $description = Description::create($data);

        return redirect('descriptions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $description = Description::where('id', $id)->firstOrFail();
        return view('descriptions.show', compact('description'));
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
        $description = Description::where('id', $id)->firstOrFail();
        return view('descriptions.edit', compact('description', 'languages'));
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
        $description = Description::where('id', $id)->firstOrFail();
        $description->update($data);

        return redirect('descriptions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $description = Description::where('id', $id)->firstOrFail();
        $description->delete();

        return redirect('descriptions');
    }
}
