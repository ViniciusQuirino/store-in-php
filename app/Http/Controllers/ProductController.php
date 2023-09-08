<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('home', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $validatedData = $request->validated();

        // dd($validatedData);
        if ($validatedData['type'] == 'ADMINISTRADOR' || $validatedData['type'] == 'VENDEDOR') {
            if ($validatedData['stock'] > 0) {
                $validatedData['status'] = 'DISPONIVEL';
            } else {
                $validatedData['status'] = 'INDISPONIVEL';
            }

            if ($request->hasFile('imagem')) {
                $imagem = $request->file('imagem');
                $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension();
                $caminho = public_path('/uploads');

                $imagem->move($caminho, $nomeImagem);

                $validatedData['imagem'] = "http://localhost/uploads/" . $nomeImagem;
            }

            Product::create($validatedData);
            flash()->addSuccess('Produto criado.');
            return redirect()
                ->route('admin.dashboard')
                ->with('sucesso', 'Produto cadastrado com sucesso!');
        } else {
            flash()->addError('Apenas administradores e vendedores podem criar novos produtos.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'LIKE', "%{$request->search}%")
            ->orWhere('category', 'LIKE', "%{$request->search}%")
            ->get();
        
        return view('home', compact('products'));
    }
}
