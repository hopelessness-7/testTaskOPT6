<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create([
            'telephone' => $request->telephone,
            'email' => $request->email,
            'address' => $request->address,
            'price' => $request->price,
            'date_order' => $request->date_order
        ]);

        $productsArrId = explode(',', $request->products);

        $products = Product::find($productsArrId);
        $order->products()->sync($products);

        return redirect()->route('orders');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::find($id);
        $products = Product::all();
        return view('orders.edit', compact('order','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        $order->telephone = $request->telephone;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->price = $request->price;
        $order->date_order = $request->date_order;

        $order->save();

        $productsArrId = explode(',', $request->products);

        $products = Product::find($productsArrId);
        $order->products()->sync($products);

        return redirect()->route('orders');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        $order->delete();

        return redirect()->route('orders');
    }
}
