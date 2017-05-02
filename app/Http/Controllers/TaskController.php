<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return Response::json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create([
            'task' => $request->task,
            'description' => $request->description,
            'done' => $request->done
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param $task_id
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($task_id)
    {
        $task = Task::find($task_id);

        return Response::json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param                           $task_id
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, $task_id)
    {
        $task = Task::find($task_id);
        $task->task = $request->task;
        $task->description = $request->description;
        $task->done = $request->done;

        $task->save();

        return Response::json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $task_id
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($task_id)
    {
        $task = Task::destroy($task_id);
        return Response::json($task);
    }
}
