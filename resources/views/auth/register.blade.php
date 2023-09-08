@extends('layout')
@section('conteudo')
    @if ($mensagem = Session::get('erro'))
        {{ $mensagem }}
    @endif
    <form action="{{ route('auth.register.create') }}" method="POST"
        class="container col-sm-5 mt-5 border rounded text-center p-4">
        @csrf
        <h3 class="text-center p-4">Crie sua conta!</h3>
        <div class="form-floating mb-3 w-100 m-auto">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="nome" name='name'
                placeholder="name@example.com" value="{{ old('name') }}">
            <label for="nome">Nome</label>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-floating mb-3 w-100 m-auto">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name='email'
                placeholder="email">
            <label for="email">Email</label>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-floating mb-3 w-100 m-auto">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="senha"
                name='password' placeholder="senha">
            <label for="senha">Senha</label>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-floating mb-3 w-100 m-auto">
            <input type="number" class="form-control @error('age') is-invalid @enderror" id="idade" name='age'
                placeholder="idade">
            <label for="idade">Idade</label>
            @error('age')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-floating mb-3 w-100 m-auto">
            <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name='cpf'
                placeholder="cpf" oninput="formatarCPF(this)">
            <label for="cpf">CPF</label>
            @error('cpf')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex flex-column ">
            <select class="form-select w-100 m-auto mb-4 @error('type') is-invalid @enderror" name='type'
                aria-label="Default select example">
                <option selected>Tipo de conta</option>
                <option value="CLIENTE">Cliente</option>
                <option value="VENDEDOR">Vendedor</option>
            </select>
            @error('type')
                <div class="invalid-feedback" style="margin: -20px 0 20px 0;">{{ $message }}</div>
            @enderror
        </div>
        <div class="container">
            <a href="{{ route('auth.login') }}" class="btn btn-outline-success me-4 fs-5">Login</a>
            <button type="submit" class="btn btn-outline-primary ms-4 fs-5">Criar conta</button>
        </div>
    </form>
    <script>
        function formatarCPF(campo) {
            // Remove caracteres não numéricos
            let cpf = campo.value.replace(/\D/g, '');

            // Adiciona a formatação
            cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");

            // Define o valor formatado de volta no campo
            campo.value = cpf;
        }
    </script>
@endsection
