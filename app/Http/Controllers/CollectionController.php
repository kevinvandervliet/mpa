<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use Validator;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::all();
        return view("list.index",compact("collections"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('collections');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('collections/create')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            // store
            $collection = new Collection();

            $collection->title = $request->title;
            $collection->description = $request->description;
            $collection->save();

            // redirect
            return redirect('collections');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collections = Collection::all();
        $collection = Collection::find($id);
        return view("task.tasks",compact("collection","collections"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collections = Collection::all();
        $collection = Collection::find($id);
        return view("list.editList",compact("collection","collections"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'title' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('collections/create')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            // store
            $collection = collection::find($id);

            $collection->title = $request->input('title');
            $collection->description = $request->input('description') ;
            $collection->save();

            // redirect
            return redirect('collections');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = collection::find($id);
        $collection->delete();

        return redirect('collections');
    }
}
