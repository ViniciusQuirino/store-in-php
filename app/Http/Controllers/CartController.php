<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cart = Cart::firstWhere('user_id', auth()->user()->id);

        if(is_null($cart)){
            return view('cart');
        }

        $found = CartProduct::where('cart_id', $cart->id)->first();

        $user = User::with('cart.cart_product.product')->find(auth()->user()->id);

        $user->cart->cart_product = $user->cart->cart_product->map(function ($cartProduct) {
            unset($cartProduct->cart_id);
            unset($cartProduct->product_id);
            return $cartProduct;
        });

        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'age' => $user->age,
            'cpf' => $user->cpf,
            'type' => $user->type,
            'cart' => $user->cart->toArray(),
        ];

        $total = 0;

        foreach ($userData['cart']['cart_product'] as $product) {
            $subtotal = $product['product']['value'] * $product['amount'];
            $total += $subtotal;
        }

        return view('cart', compact('userData', 'total'));
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
    public function store(Request $request, $productId)
    {
        // dd(auth()->user()->id);
        $product = Product::firstWhere('id', $productId);

        if (is_null($product)) {
            flash()->addError('Produto não encontrado.');
        }

        $cart = Cart::firstWhere('user_id', auth()->user()->id);
        if (!is_null($cart)) {
            $found = CartProduct::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->first();

            if ($found) {
                $found->amount += 1;
                $found->save();

                $userData = $this->object();

                flash()->addSuccess('Produto adicionado no carrinho.');

                return redirect()
                    ->route('cart.index')
                    ->with(compact('userData'));
            } else {
                $cartProduct = new CartProduct();
                $cartProduct->product_id = $productId;
                $cartProduct->cart_id = $cart->id;
                $cartProduct->save();

                $userData = $this->object();

                flash()->addSuccess('Produto adicionado no carrinho.');
                return redirect()
                    ->route('cart.index')
                    ->with(compact('userData'));
            }
        } else {
            $cart = Cart::create(['user_id' => auth()->user()->id]);

            $cartProduct = new CartProduct();
            $cartProduct->product_id = $productId;
            $cartProduct->cart_id = $cart->id;
            $cartProduct->save();

            $userData = $this->object();

            return redirect()
                ->route('cart.index')
                ->with(compact('userData'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->input('amount'));
        $cart = CartProduct::where('product_id', $request->input('productId'))->first();

        if ($cart) {
            $cart->amount = $request->input('amount');

            $cart->save();

            $userData = $this->object();

            return redirect()
                ->route('cart.index')
                ->with(compact('userData'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $found = CartProduct::where('product_id', $request->input('id'))->first();

        if ($found) {
            $found->delete();
        }

        $userData = $this->object();

        return redirect()
            ->route('cart.index')
            ->with(compact('userData'));
    }

    public function object()
    {
        $user = User::with('cart.cart_product.product')->find(auth()->user()->id);

        $user->cart->cart_product = $user->cart->cart_product->map(function ($cartProduct) {
            unset($cartProduct->cart_id);
            unset($cartProduct->product_id);
            return $cartProduct;
        });

        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'age' => $user->age,
            'cpf' => $user->cpf,
            'type' => $user->type,
            'cart' => $user->cart->toArray(),
        ];

        return $userData;
    }
}
