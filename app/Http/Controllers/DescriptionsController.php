<?php

namespace App\Http\Controllers;
use App\Description;
use App\Language;
use Illuminate\Http\Request;
use Gate;
use Flash;

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
//       if (Gate::denies('index')) {
//          Flash::error('You do not have permission to see the description listing.');
//          return redirect()->back();
//       }
        $languages = Language::orderBy('name')->get();
        $descriptions = Description::orderBy('language_id')->paginate(50);
        return view('descriptions.index', compact('descriptions', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (Gate::denies('create', new Description())) {
        Flash::error('You do not have permission to create a new description for this language.');
        return redirect()->back();
    }
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
        if (Gate::denies('store', new Description())) {
            Flash::error('You do not have permission to save a new description for this language.');
            return redirect()->back();
        }
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
//       if (Gate::denies('show', $description)) {
//          Flash::error('You do not have permission to view this description.');
//          return redirect()->back();
//       }
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
        if (Gate::denies('edit', $description)) {
            Flash::error('You do not have permission to edit this description.');
            return redirect()->back();
        }
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
        if (Gate::denies('update', $description)) {
            Flash::error('You do not have permission to update this description.');
            return redirect()->back();
        }
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
        if (Gate::denies('destroy', $description)) {
            Flash::error('You do not have permission to delete this description.');
            return redirect()->back();
        }
        $description->delete();

        return redirect('descriptions');
    }
}
