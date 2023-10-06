<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAddressRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartController = new CartController();
        $userData = $cartController->object();

        return view('checkout.form', compact('userData'));
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
    public function store(CreateAddressRequest $request)
    {
       
        Address::create($request->all());

        $cart = Cart::firstWhere('user_id', auth()->user()->id);

        if (is_null($cart)) {
            flash()->addError('Carrinho vázio!');
        } else {
            $products = CartProduct::where('cart_id', '=', $cart->id)->get();

            foreach ($products as $index => $product) {
                $seller = Product::firstWhere('id', $product->product_id);

                $ids[] = $seller->seller_id;

                if ($seller->stock < $product->amount) {
                    flash()->addError('O produto está indisponivel no estoque.');
                    return redirect()->back();
                } else {
                    $newStock = $seller->stock - $product->amount;
                    $seller->fill(['stock' => $newStock]);

                    $seller->save();
                }
            }

            $result = $this->createOrders($ids, auth()->user()->id, $products, $cart);
            return $result;
        }
    }

    public function createOrders($ids, $userId, $products, $cart)
    {
        if (count(array_unique($ids)) === 1) {
            $sellerId = $ids[0];
            $orderArray = [
                Order::create([
                    'status' => 'PEDIDO REALIZADO',
                    'user_id' => $userId,
                    'cart_id' => $cart->id,
                    'seller_id' => $sellerId,
                ]),
            ];

            foreach ($products as $product) {
                OrderProduct::create([
                    'amount' => $product->amount,
                    'value' => $product->amount * $product->product->value,
                    'product_id' => $product->product_id,
                    'order_id' => $orderArray[0]['id'],
                ]);
            }

            $result = $this->returnOrder($userId);
            return $result;
        } else {
            $unique = array_unique($ids);

            foreach ($unique as $uniques) {
                Order::create([
                    'status' => 'PEDIDO REALIZADO',
                    'cart_id' => $cart->id,
                    'user_id' => $userId,
                    'seller_id' => $uniques,
                ]);
            }

            foreach ($products as $product) {
                $order = Order::where('seller_id', $product->product->seller_id)
                    ->latest()
                    ->first();

                if ($product->product->seller_id == $order->seller_id) {
                    OrderProduct::create([
                        'amount' => $product->amount,
                        'value' => $product->amount * $product->product->value,
                        'product_id' => $product->product_id,
                        'order_id' => $order->id,
                    ]);
                }
            }
            $result = $this->returnOrder($userId);
            return $result;
        }
    }
    public function returnOrder($userId)
    {
        $userData = User::with(['order.order_product.product'])
            ->where('id', $userId)
            ->first();

        $latestOrders = [];
        $latestOrderTimeDifference = PHP_INT_MAX;

        foreach ($userData->order as $order) {
            $orderTime = Carbon::parse($order->created_at);
            $currentTime = Carbon::now();

            $timeDifference = $currentTime->diffInSeconds($orderTime);

            if ($timeDifference < $latestOrderTimeDifference) {
                $latestOrders = [$order];
                $latestOrderTimeDifference = $timeDifference;
            } elseif ($timeDifference === $latestOrderTimeDifference) {
                $latestOrders[] = $order;
            }
        }

        $result = [
            'id' => $userData->id,
            'name' => $userData->name,
            'email' => $userData->email,
            'age' => $userData->age,
            'cpf' => $userData->cpf,
            'type' => $userData->type,
            'latest_orders' => [],
        ];

        foreach ($latestOrders as $latestOrder) {
            $orderData = $latestOrder->toArray();
            $orderData['order_products'] = [];

            foreach ($latestOrder->order_product as $orderProduct) {
                $orderProductData = $orderProduct->toArray();
                $orderProductData['product'] = $orderProduct->product->toArray();
                $orderData['order_products'][] = $orderProductData;
            }

            $result['latest_orders'][] = $orderData;
        }

        $cart = Cart::firstWhere('user_id', $userId);
        $cart->delete();
        // dd($result);
        return view('order.completed', compact('result'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
