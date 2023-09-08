@extends('layout')

@section('conteudo')
    <div class="container my-5">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-4 shadow-sm">
                        <img src="{{$product->imagem}}" class="card-img-top" alt="Imagem do produto">
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $product->category }}</li>
                            <li class="list-group-item">R$ {{ number_format($product->value, 2, ',', '.') }}</li>

                        </ul>
                        <form class="card-body" action="{{ route('cart.create', $product->id) }}" method="POST">
                            @csrf
                            @if (Auth::check())
                                <button type="submit" class="btn btn-outline-primary">ADICIONAR
                                    NO
                                    CARRINHO</button>
                            @else
                                <a href="{{ route('auth.login') }}" class="btn btn-outline-primary">ADICIONAR NO
                                    CARRINHO</a>
                            @endif

                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
