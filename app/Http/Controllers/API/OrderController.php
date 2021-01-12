<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreOrder;
use App\Http\Requests\UpdateOrder;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\Order as OrderResource;
use App\Order;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = !empty(request()->all()) ? Order::filter()->orderBy('id')->get() : Order::all();
        $orders = new OrderCollection($orders);

        return $this->sendResponse('Orders has been retrieved successfully.', $orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOrder  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrder $request)
    {
        $validated = $request->validated();

        $order = new Order($validated);
        $order->save();

        return $this->sendResponse('Order has been created successfully.', null, BaseController::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        $order =  new OrderResource($order);

        return $this->sendResponse('Order has been retrieved successfully.', $order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateOrder  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrder $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            $order[$key] = $value;
        }

        $order->save();

        return $this->sendResponse('Order has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return $this->sendResponse('Order has been deleted successfully.');
    }

    public function lock($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status_id == "di") {
            $status = 'en';
            $message = "The order has been enabled successfully.";
        } else {
            $status = 'di';
            $message = "The order has been disabled successfully.";
        }

        $order->status_id = $status;
        $order->save();

        $succes['status'] = $status;

        return $this->sendResponse($message, $succes);
    }

    public function filterOrder(Request $request)
    {
        $orders = Order::filter()->orderBy('id')->get();
        $orders = new OrderCollection($orders);

        return $this->sendResponse('Orders has been retrieved successfully.', $orders);
    }
}
