@extends('layouts.app')

@section('title', 'Cadastro de Doador')

@section('content')
    <div class="container">
        <h2>Cadastro de Novo Doador</h2>
        <p>Preencha os campos abaixo para criar sua conta e agendar sua doação.</p>

        @if ($errors->any())
            <div class="alert-danger">
                <strong>Opa!</strong> Algo deu errado.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.donor.store') }}">
            @csrf

            <div>
                <label for="name">Nome Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
            </div>

            <div>
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div>
                <label for="address">Endereço</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" required>
            </div>

            <div>
                <label for="password">Senha (mínimo 8 caracteres)</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div>
                <label for="cpf">CPF (apenas números)</label>
                <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" required>
            </div>

            <div>
                <label for="phone_number">Telefone / Celular (apenas números)</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
            </div>

            <div>
                <label for="birth_date">Data de Nascimento</label>
                <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
            </div>

            <div>
                <label for="blood_type">Tipo Sanguíneo</label>
                <select id="blood_type" name="blood_type" required>
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

            <br>
            <div>
                <button type="submit">Cadastrar</button>
            </div>
        </form>

        <p>
            Já tem uma conta? <a href="{{ route('login.form') }}">Faça o login aqui</a>.
        </p>
    </div>

    <style>
        .alert-danger {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
        .container {
            font-family: sans-serif;
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
        }
        input, select, button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }
        div {
            margin-bottom: 15px;
        }
    </style>
@endsection
