<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userData = User::with(['order.order_product.product'])
            ->where('id', auth()->user()->id)
            ->first();

        $latestOrders = [];

        foreach ($userData->order as $order) {
            $orderData = $order->toArray();
            $orderData['order_products'] = [];

            foreach ($order->order_product as $orderProduct) {
                $orderProductData = $orderProduct->toArray();
                $orderProductData['product'] = $orderProduct->product->toArray();
                $orderData['order_products'][] = $orderProductData;
            }

            $latestOrders[] = $orderData;
        }

        $result = [
            'id' => $userData->id,
            'name' => $userData->name,
            'email' => $userData->email,
            'age' => $userData->age,
            'cpf' => $userData->cpf,
            'type' => $userData->type,
            'orders' => $latestOrders,
        ];
        // dd($result);
        return view('order.myOrders', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderProduct $orderProduct)
    {
        //
    }
}
