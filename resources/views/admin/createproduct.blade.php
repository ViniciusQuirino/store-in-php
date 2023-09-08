@extends('layout')
@section('conteudo')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <form action="{{ route('create.product') }}" method="POST"
        class="container w-50 mt-5 border rounded  p-4" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name='seller_id' value="{{ auth()->user()->id }}">
        <input type="hidden" name='type' value="{{ auth()->user()->type }}">
        <h3 class="text-center p-4">Publicar produto!</h3>
        <div class="form-floating mb-3 w-75 m-auto">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="nome" name='name'
                placeholder="name@example.com" value="{{ old('name') }}">
            <label for="nome">Nome</label>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3 w-75 m-auto">
            <input type="number" class="form-control @error('value') is-invalid @enderror" id="value" name='value'
                placeholder="Valor" value="{{ old('value') }}">
            <label for="value">Valor</label>
            @error('value')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3 w-75 m-auto">
            <input type="text" class="form-control @error('category') is-invalid @enderror" id="category"
                name='category' placeholder="Categoria" value="{{ old('category') }}">
            <label for="category">Categoria</label>
            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3 w-75 m-auto">
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name='stock'
                placeholder="Valor" value="{{ old('stock') }}">
            <label for="stock">Estoque</label>
            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 w-75 m-auto" data-bs-theme="dark">
            <label for="formFile" class="form-label" >Publique imagens do produto</label>
            <input type="file" name ="imagem" class="form-control bg-light text-dark" id="formFile">
        </div>

        <div class="container text-center">
            <a href="{{ route('auth.login') }}" class="btn btn-outline-success me-4 fs-5 ">Login</a>
            <button type="submit" class="btn btn-outline-primary ms-4 fs-5">Criar conta</button>
        </div>
    </form>
@endsection
