<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\MainController;
use App\Http\Requests\API\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends MainController
{
    public function index(Request $request)
    {
        $order = Order::with('products')->orderBy('date_order', 'desc')->paginate($request->size);
        return $this->sendResponse($order);
    }

    public function show($id)
    {
        $order = Order::find($id);

        if (isset($order)) {
            return $this->sendResponse(new OrderResource($order));
        } else {
            return $this->sendError('The record is either deleted or does not exist', 404);
        }
    }

    public function store(OrderRequest $request)
    {
        $cost = 0;

        $products = Product::find($request->products);

        foreach ($products as $product) {
            $cost += $product->cost;
        }

        if ($cost <= 3000) {
            $this->sendError('price is less than or equal to 3000', 400);
        }

        $order = Order::create([
            'telephone' => $request->telephone,
            'email' => $request->email,
            'address' => $request->address,
            'price' => $cost,
            'date_order' => date('Y-m-d', strtotime($request->date_order))
        ]);

        $order->products()->sync($products);

        return $this->sendResponse(new OrderResource($order));
    }

    public function update(OrderRequest $request, $id)
    {
        $order = Order::find($id);

        if (isset($order)) {
            $order->telephone = $request->telephone;
            $order->email = $request->email;
            $order->address = $request->address;
            $order->price = $request->price;
            $order->date_order = $request->date_order;
            $order->save();

            $products = Product::find($request->products);
            $order->products()->sync($products);

            return $this->sendResponse(new OrderResource($order));
        } else {
            return $this->sendError('The record is either deleted or does not exist', 404);
        }
    }

    public function delete($id)
    {
        $order = Order::find($id);

        if (isset($order)) {
            $order->delete();
            return $this->sendResponse([]);
        } else {
            return $this->sendError('The record is either deleted or does not exist', 404);
        }

    }

}
