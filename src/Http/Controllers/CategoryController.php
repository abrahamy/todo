<?php

namespace abrahamy\Todo\Http\Controllers;

use abrahamy\Todo\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    private $_validationRule = [
        'name' => 'required|unique:categories|max:30'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
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
                'message' => 'Invalid data.',
                'data' => [
                    'name' => 'Category name is required'
                ]
            ], 400);
        }

        $category = new Category();
        $category->name = $data['name'];
        $category->save();

        return response()->json([
            'status' => 'success',
            'data' => [
                'category_id' => $category->id
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $categoryId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoryId)
    {
        $data = $this->validate($request, $this->_validationRule);

        if (empty($data)) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Invalid data.',
                'data' => [
                    'name' => 'Category name is required'
                ]
            ], 400);
        }

        Category::findOrFail($categoryId)->update($data);

        return response()->json(null, 204);
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

        return response()->json([
            'status' => 'success',
            'message' => 'resource deleted.'
        ]);
    }
}
