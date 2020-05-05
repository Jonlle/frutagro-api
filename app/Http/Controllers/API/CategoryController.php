<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\Category as CategoryResource;
use App\Category;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        if(!$categories) {
            return $this->sendError('Categories no found.', []);
        }

        $success =  new CategoryCollection($categories);

        return $this->sendResponse($success, 'Categories has been retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCategory  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $validated = $request->validated();

        $category = new Category($validated);
        $category->save();

        $success = new CategoryResource($category);

        return $this->sendResponse($success, 'Category has been created successfully.', BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        if(!$category) {
            return $this->sendError('Category no found.', []);
        }

        $category =  new CategoryResource($category);

        return $this->sendResponse($category, 'Category has been retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCategory  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, $id)
    {
        $validated = $request->validated();

        $category = Category::find($id);

        if(!$category) {
            return $this->sendError('Category no found.', []);
        }

        foreach ($validated as $key => $value) {
            $category[$key] = $value;
        }

        $category->save();
        $success = new CategoryResource($category);

        return $this->sendResponse($success, 'Category has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if(!$category) {
            return $this->sendError('Category no found.', []);
        }

        $category->delete();

        return $this->sendResponse([], 'Category has been deleted successfully.');
    }
}
