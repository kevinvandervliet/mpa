<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Task;

class TaskController extends Controller
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
    public function create($collection_id)
    {
        return view("task.createTask",compact("task", "collection_id"));
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
            return redirect('task/create')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            // store
            $task = new Task();

            $task->collection_id = $request->collection_id;
            $task->title = $request->title;
            $task->description = $request->description;
            $task->status = $request->status;
            $task->duration = $request->duration;
            $task->save();

            // redirect
            return redirect(Route('showCollection', array($request->collection_id)));
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view("task.editTask",compact("task"));
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
            return redirect('task/create')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            // store
            $task = Task::find($id);

            $task->collection_id = $request->input('collection_id');
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->status = $request->input('status');
            $task->duration = $request->input('duration');
            $task->save();

            // redirect
            return redirect(Route('showCollection', array($request->collection_id)));
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
        $task = task::find($id);
        $collection_id = $task->collection_id;
        $task->delete();

        return redirect(Route('showCollection', array($collection_id)));
    }
}
