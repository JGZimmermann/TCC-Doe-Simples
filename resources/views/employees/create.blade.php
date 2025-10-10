@extends('layouts.app')

@section('title', 'Cadastro de Funcionário')

@section('content')
    <div class="container">
        <h2>Cadastro de Novo Funcionário</h2>

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

        <form method="POST" action="{{ route('register.employee.store') }}">
            @csrf

            <div>
                <label for="name">Nome Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
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

            <div>
                <label for="user_type">Tipo de Usuário</label>
                <select id="user_type" name="user_type" required>
                    <option value="">Selecione...</option>
                    <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="clinician" {{ old('user_type') == 'clinician' ? 'selected' : '' }}>Clínico</option>
                    <option value="attendant" {{ old('user_type') == 'attendant' ? 'selected' : '' }}>Atendente</option>
                </select>
            </div>

            <br>
            <div>
                <button type="submit">Criar</button>
            </div>
        </form>
    </div>

    <style>
        .alert-danger {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            color: #a94442;
            background-color: #f2dede;
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
