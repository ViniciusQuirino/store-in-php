@extends('layout')

@section('conteudo')
    <div class="container mt-5 min-vh-100">

        @if ($userData['cart']['cart_product'])
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
                                <th class="col-1" scope="row">
                                    <img src="{{ asset('uploads/' . '1693852743.png') }}" class="img-fluid rounded"
                                        alt="">
                                </th>
                                <td>{{ $product['product']['name'] }}</td>
                                <td>
                                    <input type="number" value="{{ $product['amount'] }}"
                                        class="form-control form-control-sm" style="width:60px;"
                                        data-product-id="{{ $product['product']['id'] }}">
                                </td>
                                <td class="product-total">
                                    R$ {{ number_format($product['product']['value'] * $product['amount'], 2, ',', '.') }}
                                </td>

                                <form action="{{ route('cart.destroy', $product['product']['id']) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <td>
                                        <button class="btn btn-outline-primary" type="submit">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-right">
                <?php
                $total = 0;
                
                foreach ($userData['cart']['cart_product'] as $product) {
                    $subtotal = $product['product']['value'] * $product['amount'];
                    $total += $subtotal;
                }
                ?>
                <h3>Total: <span id="cart-total">R$ {{ number_format($total, 2, ',', '.') }}</span></h3>
            </div>

            <button class="btn btn-primary mt-3">Finalizar Compra</button>

            <script>
                // Captura todos os elementos de input
                const inputElements = document.querySelectorAll('input[data-product-id]');
                const cartTotalElement = document.getElementById('cart-total');

                // Adiciona um ouvinte de evento para detectar mudanças no valor de cada input
                inputElements.forEach(inputElement => {
                    inputElement.addEventListener('input', function() {
                        // Obtém o valor atual do input e o ID do produto associado
                        const valor = parseFloat(inputElement.value);
                        const productId = inputElement.getAttribute('data-product-id');

                        // Calcula o novo valor total para o produto atual
                        const productPrice = parseFloat("{{ $product['product']['value'] }}");
                        const newTotal = (isNaN(valor) ? 0 : valor) * productPrice;

                        // Atualiza o valor total do produto na tabela
                        const productTotalElement = inputElement.closest('tr').querySelector('.product-total');
                        productTotalElement.textContent = `R$ ${newTotal.toFixed(2).replace('.', ',')}`;

                        // Recalcula o valor total do carrinho
                        const inputValues = Array.from(inputElements).map(input => parseFloat(input.value) || 0);
                        const cartTotal = inputValues.reduce((total, value) => total + value * productPrice, 0);
                        cartTotalElement.textContent = `R$ ${cartTotal.toFixed(2).replace('.', ',')}`;
                    });
                });
            </script>
    </div>
@else
    <h1 class="mb-4">Seu carrinho de compras está vázio ...</h1>
    @endif


@endsection
