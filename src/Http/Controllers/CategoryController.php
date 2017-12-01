<?php

namespace abrahamy\Todo\Http\Controllers;

use abrahamy\Todo\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:categories|max:30'
        ]);

        if (!isset($data['name'])) {
            $jsend = [
                'status' => 'fail',
                'data' => [
                    'name' => 'Category name is required'
                ]
            ];
            $response = Response::make(json_encode($jsend), 400);
            return response;
        }

        $category = new Category();
        $category->name = $data['name'];
        $category->save();

        $jsend = [
            'status' => 'success',
            'data' => [
                'category_id' => $category->id
            ]
        ];
        $response = Response::make(\json_encode($jsend), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $jsend = [
            'status' => 'success',
            'data' => [
                'category' => $category
            ]
        ];

        $response = Response::make(\json_encode($jsend), 200);
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|unique:categories|max:30'
        ]);

        if (!isset($data['name'])) {
            $jsend = [
                'status' => 'fail',
                'data' => [
                    'name' => 'Category name is required'
                ]
            ];
            $response = Response::make(json_encode($jsend), 400);
            return response;
        }

        $category->name = $data['name'];
        $category->save();

        $jsend = [
            'status' => 'success',
            'message' => 'resource updated.'
        ];
        $response = Response::make(\json_encode($jsend), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $jsend = [
            'status' => 'success',
            'message' => 'resource deleted.'
        ];
        $response = Response::make(\json_encode($jsend), 200);
        return $response;
    }
}
