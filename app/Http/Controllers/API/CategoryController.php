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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
        $categories = !empty(request()->all()) ? Category::filter()->get() : Category::all();
        $categories = new CategoryCollection($categories);

        return $this->sendResponse('Categories has been retrieved successfully.', $categories);
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
        $validated += ["slug" => Str::slug($validated['category_name'])];

        $category = new Category($validated);
        $category->save();

        return $this->sendResponse('Category has been created successfully.', null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        $category =  new CategoryResource($category);

        return $this->sendResponse('Category has been retrieved successfully.', $category);
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
        $category = Category::findOrFail($id);

        $validated = $request->validated();
        $validated += ["slug" => Str::slug($validated['category_name'])];

        foreach ($validated as $key => $value) {
            $category[$key] = $value;
        }

        $category->save();

        return $this->sendResponse('Category has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return $this->sendResponse('Category has been deleted successfully.');
    }

    public function lock($id)
    {
        $category = Category::findOrFail($id);

        if ($category->status_id == "di") {
            $status = 'en';
            $message = "The category has been enabled successfully.";
        } else {
            $status = 'di';
            $message = "The category has been disabled successfully.";
        }

        $category->status_id = $status;
        $category->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }
}
