@extends('layouts.app')

@section('title', 'Cadastro de Doador')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="text-center mb-3">Cadastro de novo doador</h2>
            <p class="text-center text-muted mb-4">Preencha os campos abaixo para criar sua conta e agendar sua doação.</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Opa!</strong> Algo deu errado.
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.donor.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nome Completo</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Endereço</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Senha (mínimo 8 caracteres)</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF (apenas números)</label>
                    <input type="text" id="cpf" name="cpf" class="form-control" value="{{ old('cpf') }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Telefone / Celular (apenas números)</label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
                </div>

                <div class="mb-3">
                    <label for="birth_date" class="form-label">Data de Nascimento</label>
                    <input type="date" id="birth_date" name="birth_date" class="form-control" value="{{ old('birth_date') }}" required>
                </div>

                <div class="mb-4">
                    <label for="blood_type" class="form-label">Tipo Sanguíneo</label>
                    <select id="blood_type" name="blood_type" class="form-select" required>
                        <option value="">Selecione...</option>
                        <option value="A+" {{ old('blood_type') == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A-" {{ old('blood_type') == 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ old('blood_type') == 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B-" {{ old('blood_type') == 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="AB+" {{ old('blood_type') == 'AB+' ? 'selected' : '' }}>AB+</option>
                        <option value="AB-" {{ old('blood_type') == 'AB-' ? 'selected' : '' }}>AB-</option>
                        <option value="O+" {{ old('blood_type') == 'O+' ? 'selected' : '' }}>O+</option>
                        <option value="O-" {{ old('blood_type') == 'O-' ? 'selected' : '' }}>O-</option>
                        <option value="N/A" {{ old('blood_type') == 'N/A' ? 'selected' : '' }}>Não sei</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>

            <p class="text-center mt-4 mb-0">
                Já tem uma conta?
                <a href="{{ route('login.form') }}" class="text-decoration-none">Faça o login aqui</a>.
            </p>
        </div>
    </div>
</div>

@endsection
