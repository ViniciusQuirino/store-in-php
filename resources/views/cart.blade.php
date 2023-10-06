@extends('layout')

@section('conteudo')
    <div class="container mt-5 min-vh-100">
        @empty($userData)
            <h1 class="min-vh-100">Seu carrinho de compras está vazio ...</h1>
        @endempty

        @isset($userData['cart']['cart_product'])
            <h1 class="mb-4">Seu Carrinho de Compras</h1>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userData['cart']['cart_product'] as $product)
                            <tr>
                                <td class="col-1">
                                    <img src="{{ $product['product']['imagem'] }}" class="img-fluid rounded"
                                        alt="Imagem do produto" style="max-height: 35px;">
                                </td>

                                <td>{{ $product['product']['name'] }}</td>

                                <td><input type="number" value="{{ $product['amount'] }}" class="form-control form-control-sm"
                                        style="width:60px;" data-product-id="{{ $product['product']['id'] }}"
                                        value-product="{{ $product['product']['value'] }}" name="quantity"
                                        oninput="if (this.value < 0) this.value = 0; updateHiddenInputValue(this);">
                                </td>

                                <td class="product-total">
                                    R$ {{ number_format($product['product']['value'] * $product['amount'], 2, ',', '.') }}
                                </td>

                                <td class='d-flex'>
                                    <form action="{{ route('cart.destroy') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product['product']['id'] }}">
                                        <button type="submit" class="btn btn-outline-primary me-2">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('cart.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="{{ $product['product']['id'] }}" name="productId"
                                            value="">
                                        <input type="hidden" product-id="{{ $product['product']['id'] }}" name="amount"
                                            value="">

                                        <button type="submit" class="btn btn-outline-warning">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-right">
                <h3>Total: <span id="cart-total">R$ {{ number_format($total, 2, ',', '.') }}</span></h3>
            </div>

            <a href="{{ route('user.checkout', $userData) }}" class="btn btn-primary mt-3">Finalizar Compra</a>
        </div>
        <script src="{{ asset('js/script.js') }}"></script>
    @endisset
@endsection
