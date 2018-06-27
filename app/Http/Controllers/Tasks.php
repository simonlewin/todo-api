<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

use App\Http\Resources\TaskResource;

class Tasks extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // get post request data for task
        $data = $request->only(["task"]);

        // create task with data and store in DB
        $task = Task::create($data);

        // return the task along with a 201 status code
        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // get the request data
        $data = $request->only(["task"]);

        // update the article
        $task->fill($data)->save();

        // return the updated version
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        // use a 204 code as there is no content in the response
        return response(null, 204);
    }

    public function complete(Task $task)
    {
        $task->fill(['completed' => true])->save();

        // use a 204 code as there is no content in the response
        return new TaskResource($task);
    }

}
