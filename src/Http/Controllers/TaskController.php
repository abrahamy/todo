<?php

namespace abrahamy\Todo\Http\Controllers;

use abrahamy\Todo\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'description' => 'required'
        ]);

        if (!(isset($data['category_id']) && isset($data['description']))) {
            $jsend = [
                'status' => 'error',
                'message' => 'invalid data.'
            ];
            $response = Response::make(json_encode($jsend), 400);
            return response;
        }

        $task->category_id = $data['category_id'];
        $task->description = $data['description'];
        $task->save();

        $jsend = [
            'status' => 'success',
            'message' => 'resource updated.'
        ];
        $response = Response::make(\json_encode($jsend), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        $jsend = [
            'status' => 'success',
            'message' => 'resource deleted.'
        ];
        $response = Response::make(\json_encode($jsend), 200);
        return $response;
    }
}
