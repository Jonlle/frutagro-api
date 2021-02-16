<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Http\Requests\RecommendedProduct;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\Product as ProductResource;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Product;
use App\ProductAttribute;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = !empty(request()->all()) ? Product::filter()->get() : Product::all();
        $products =  new ProductCollection($products);

        return $this->sendResponse(trans('response.success_product_index'), $products);
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

        $data_product = Arr::except($validated, ['attributes']);
        $data_product['slug'] = isset($data_product['slug']) ? $data_product['slug'] : Str::slug($data_product['product_name']);

        $product = new Product($data_product);
        $product->save();

        $attributes = $validated['attributes'];
        $id = $product->id;
        $category = $product->category->category_name;

        foreach ($attributes as $key => $value) {
            $product_attributes = new ProductAttribute($value);

            if (!$product_attributes->sku) {
                $product_attributes->sku = strtoupper(substr($category, 0, 3) . substr($data_product['slug'], 0, 3) . substr($value['unit_name'], 0, 1) . sprintf("%'.03d", $id));
            }

            $product->product_attributes()->save($product_attributes);
        }

        return $this->sendResponse(trans('response.success_product_store'), null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        $product =  new ProductResource($product);

        return $this->sendResponse(trans('response.success_product_show'), $product);
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
        $product = Product::findOrFail($id);

        $validated = $request->validated();

        $data_product = Arr::except($validated, ['attributes']);
        $data_product['slug'] = isset($data_product['slug']) ? $data_product['slug'] : Str::slug($data_product['product_name']);

        foreach ($data_product as $key => $value) {
            $product[$key] = $value;
        }

        $product->save();

        $attributes = $validated['attributes'];
        $id = $product->id;
        $category = $product->category->category_name;

        $product_attributes = $product->product_attributes;

        foreach ($attributes as $key => $attrs) {
            if (isset($product_attributes[$key])) {
                $product_attrs = $product_attributes[$key];
                foreach ($attrs as $key => $value) {
                    $product_attrs[$key] = $value;
                }
                $product_attrs->save();
            } else {
                $product_attrs = new ProductAttribute($attrs);
                if (!$product_attrs->sku) {
                    $product_attrs->sku = strtoupper(substr($category, 0, 3) . substr($data_product['slug'], 0, 3) . substr($attrs['unit_name'], 0, 1) . sprintf("%'.03d", $id));
                }
                $product->product_attributes()->save($product_attrs);
            }
        }

        return $this->sendResponse(trans('response.success_product_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return $this->sendResponse(trans('response.success_product_destroy'));
    }

    public function lock($id)
    {
        $product = Product::findOrFail($id);

        if ($product->status_id == "di") {
            $status = 'av';
            $message = trans('response.success_product_unlock');
        } else {
            $status = 'di';
            $message = trans('response.success_product_lock');
        }

        $product->status_id = $status;
        $product->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }

    public function lockAttribute($attribute)
    {
        $attr = ProductAttribute::findOrFail($attribute);

        if ($attr->status_id == "di") {
            $status = 'av';
            $message = trans('response.success_product_unlock');
        } else {
            $status = 'di';
            $message = trans('response.success_product_lock');
        }

        $attr->status_id = $status;
        $attr->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }

    /**
     * Display a listing of the products by category.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function getByCategory($category)
    {
        $category = Category::findOrFail($category);

        $products = new ProductCollection($category->products);

        return $this->sendResponse(trans('response.success_product_index'), $products);
    }

    /**
     * get recommended products.
     *
     * @param  RecommendedProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function getRecomended(RecommendedProduct $request)
    {
        $validated = $request->validated();

        $recommendedProducts = Product::where('category_id', $validated['category_id'])
            ->where('id', '!=', $validated['id'])
            ->inRandomOrder()
            ->take(isset($validated['take']) ? $validated['take'] : 4)
            ->get();

        $response =  new ProductCollection($recommendedProducts);

        return $this->sendResponse(trans('response.success_product_index'), $response);
    }
}
