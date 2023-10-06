@extends('layout')

@section('conteudo')
    <div class="container min-vh-100">
        <div class="container mt-5">
            <h5>Parabéns! Seu pedido foi finalizado com sucesso.</h5>
        </div>

        @foreach ($result['latest_orders'] as $order)
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Detalhes do Pedido</h2>
                        <p class="card-text">Número do Pedido: #{{ substr($order['id'], -5) }}</p>
                        <p class="card-text">Total: R$
                            {{ number_format(array_sum(array_column($order['order_products'], 'value')), 2, ',', '.') }}
                        </p>
                        <p class="card-text">Status: PEDIDO REALIZADO</p>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="container mt-4">
            <a href="/" class="btn btn-primary">Voltar à Página Inicial</a>
        </div>

    </div>
@endsection
