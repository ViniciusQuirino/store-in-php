@extends('layout')
@section('conteudo')
    <div class="min-vh-100 col-sm-5 d-flex justify-content-center align-items-center m-auto">
        <form action="{{ route('auth.login.create') }}" class="container mt-5 border mx-2 rounded text-center p-4"
            method="POST">
            @csrf
            <h3 class="text-center p-4">Faça o login</h3>
            <div class="form-floating mb-3 m-auto">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                    placeholder="Name@example.com" name="email">
                <label for="floatingInput">Email</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-floating mb-3  m-auto">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="floatingPassword" placeholder="Senha">
                <label for="floatingPassword">Senha</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <input class="form-check-input mb-3 " type="checkbox" name="remember">Lembrar-me

            <div class="container ">
                <a href="{{ route('auth.register') }}" class="btn btn-outline-success me-4 fs-5">Registrar</a>
                <button type="submit" class="btn btn-outline-primary ms-4 fs-5">Entrar</button>
            </div>
        </form>
    </div>
@endsection
