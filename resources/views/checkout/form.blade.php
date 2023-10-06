@extends('layout')

@section('conteudo')
    <div class="container mt-5 min-vh-100">
        {{-- <h1 class="mb-4">Seu Carrinho de Compras</h1>

        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Produto</th>
                        <th>Total</th>
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

                            <td class="product-total">
                                R$ {{ number_format($product['product']['value'] * $product['amount'], 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
        <div class="container mt-4">
            <h1>Checkout</h1>
            @foreach ($userData['cart']['cart_product'] as $product)
                <div class="card mt-2">
                    <div class="row">
                        <div class="col-4 col-md-2">
                            <img src="http://localhost/uploads/1693852743.png" alt="Produto" style='max-width:100px;'
                                class="d-none d-md-block">
                        </div>
                        <div class="col-8 col-md-10">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">{{ $product['product']['name'] }}</h5>
                                    <p>{{ $product['amount'] }} Unidades.</p>
                                </div>
                                <p class="card-text">Preço: R$
                                    {{ number_format($product['product']['value'] * $product['amount'], 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <form action="{{ route('create.order') }}" method="POST" class="container mt-4">
            @csrf
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço de Entrega</label>
                <div class="row">
                    <div class="col-md-6 mb-6">
                        <input type="text" class="form-control @error('street') is-invalid @enderror" id="rua"
                            name="street" placeholder="Nome da Rua">
                        @error('street')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-6">
                        <input type="text" class="form-control @error('number') is-invalid @enderror" id="numero"
                            name="number" placeholder="Numero">
                        @error('number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                </div>
                <div class="row mt-2">
                    <div class="col-md-6 mb-6">
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="cidade"
                            name="city" placeholder="Nome da Cidade">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" col-md-6 mb-6">
                        <input type="text" class="form-control @error('zip_code') is-invalid @enderror" id="cep"
                            name="zip_code" placeholder="CEP">
                        @error('zip_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- <div class="mb-3">
                <label for="forma-pagamento" class="form-label">Forma de Pagamento</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="forma-pagamento" id="cartao-pagamento"
                        value="cartao">
                    <label class="form-check-label" for="cartao-pagamento">
                        Cartão de Crédito
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="forma-pagamento" id="pix-pagamento" value="pix">
                    <label class="form-check-label" for="pix-pagamento">
                        PIX
                    </label>
                </div>
            </div>


            <div class="col-mb-3 mb-3" id="cartao-campos">
                <label for="cartao" class="form-label">Número do Cartão de Crédito</label>
                <input type="text" class="form-control" id="cartao" placeholder="XXXX-XXXX-XXXX-XXXX">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3" id="validade">
                    <label for="validade" class="form-label">Validade do Cartão</label>
                    <input type="text" class="form-control" id="validade" placeholder="MM/AA">
                </div>
                <div class="col-md-6 mb-3" id="cvv-campos">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cvv" placeholder="XXX">
                </div>
            </div> --}}



            <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
            <button type="submit" class="btn btn-primary">Finalizar Compra</button>
        </form>
    </div>

    <!-- Inclua os scripts JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script>
    {{-- 
    <script>
        // Função para controlar a exibição dos campos de Cartão de Crédito
        function mostrarCamposCartao() {
            document.getElementById("cartao-campos").style.display = "block";
            document.getElementById("validade").style.display = "block";
            document.getElementById("cvv-campos").style.display = "block";
        }

        // Função para ocultar os campos de Cartão de Crédito
        function ocultarCamposCartao() {
            document.getElementById("cartao-campos").style.display = "none";
            document.getElementById("validade").style.display = "none";
            document.getElementById("cvv-campos").style.display = "none";
        }

        // Adicionar um ouvinte de evento aos radio buttons
        document.getElementById("cartao-pagamento").addEventListener("change", mostrarCamposCartao);
        document.getElementById("pix-pagamento").addEventListener("change", ocultarCamposCartao);

        // Inicialmente, ocultar os campos de Cartão de Crédito
        ocultarCamposCartao();
    </script> --}}
@endsection
