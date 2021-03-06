<?php

namespace abrahamy\Todo\Http\Controllers;

use abrahamy\Todo\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $_validationRule = [
        'category_id' => 'required|exists:categories,id',
        'description' => 'required',
        'done' => 'nullable|boolean'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::all();

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => $tasks
            ]);
        }

        return view('todo::index', $tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, $this->_validationRule);

        if (empty($data)) {
            return response()->json([
                'status' => 'fail',
                'message' => 'invalid data.'
            ], 400);
        }

        $task = Task::create($data);

        return response()->json([
            'status' => 'success',
            'data' => [
                'task_id' => $task->id
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json([
            'status' => 'success',
            'data' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $taskId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $taskId)
    {
        $data = $this->validate($request, $this->_validationRule);

        if (empty($data)) {
            return response()->json([
                'status' => 'error',
                'message' => 'invalid data.'
            ], 400);
        }

        Task::findOrFail($taskId)->update($data);

        return response()->json(null, 204);
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

        return response()->json([
            'status' => 'success',
            'message' => 'resource deleted.'
        ]);
    }
}
