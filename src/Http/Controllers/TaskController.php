<?php

namespace abrahamy\Todo\Http\Controllers;

use abrahamy\Todo\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Validate form data
     * 
     * @param \Illuminate\Http\Request $request
     * @return array|boolean
     */
    private function validate(Request $request)
    {
        $validationRules = [
            'category_id' => 'required|exists:categories,id',
            'description' => 'required'
        ];
        $data = $request->validate($validationRules);

        if (!(isset($data['category_id']) && isset($data['description']))) {
            return false;
        }

        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('index', $tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request);

        if (!$data) {
            $jsend = [
                'status' => 'fail',
                'message' => 'invalid data.'
            ];
            $response = Response::make(json_encode($jsend), 400);
            return response;
        }

        $task = new Task();
        $task->category_id = $data['category_id'];
        $task->description = $data['description'];
        $category->save();

        $jsend = [
            'status' => 'success',
            'data' => [
                'task_id' => $task->id
            ]
        ];
        $response = Response::make(\json_encode($jsend), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $jsend = [
            'status' => 'success',
            'data' => $task
        ];

        $response = Response::make(\json_encode($jsend));
        return $response;
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
        $data = $this->validate($request);

        if (!$data) {
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

        $response = Response::make(null, 204);
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
        $response = Response::make(\json_encode($jsend));
        return $response;
    }
}
