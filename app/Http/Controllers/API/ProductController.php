<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\Product as ProductResource;
use App\Product;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class ProductController extends BaseController
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =  new ProductCollection(Product::all());

        return $this->sendResponse($products, 'Products has been retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $validated = $request->validated();

        $product = new Product($validated);
        $product->save();

        $success = new ProductResource($product);

        return $this->sendResponse($success, 'Product has been created successfully.', BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if(!$product) {
            return $this->sendError('Product no found.', []);
        }

        $product =  new ProductResource($product);

        return $this->sendResponse($product, 'Product has been retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProduct  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduct $request, $id)
    {
        $validated = $request->validated();

        $product = Product::find($id);

        if(!$product) {
            return $this->sendError('Product no found.', []);
        }

        $product->save();
        $success = new ProductResource($product);

        return $this->sendResponse($success, 'Product has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(!$product) {
            return $this->sendError('Product no found.', []);
        }

        $product->delete();

        return $this->sendResponse([], 'Product has been deleted successfully.');
    }
}
