@extends('layouts.app')

@section('title', 'Cadastro de Funcionário')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Cadastro de Novo Funcionário</h2>

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

    <form method="POST" action="{{ route('register.employee.store') }}" class="p-4 border rounded shadow-sm bg-light">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome Completo</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha (mínimo 8 caracteres)</label>
            <input type="password" id="password" name="password" class="form-control" minlength="8" required>
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF (apenas números)</label>
            <input type="text" id="cpf" name="cpf" class="form-control" value="{{ old('cpf') }}" required>
        </div>

        <div class="mb-3">
            <label for="birth_date" class="form-label">Data de Nascimento</label>
            <input type="date" id="birth_date" name="birth_date" class="form-control" value="{{ old('birth_date') }}" required>
        </div>

        <div class="mb-3">
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

        <div class="mb-3">
            <label for="user_type" class="form-label">Tipo de Usuário</label>
            <select id="user_type" name="user_type" class="form-select" required>
                <option value="">Selecione...</option>
                <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="clinician" {{ old('user_type') == 'clinician' ? 'selected' : '' }}>Clínico</option>
                <option value="attendant" {{ old('user_type') == 'attendant' ? 'selected' : '' }}>Atendente</option>
            </select>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-danger">Criar</button>
        </div>
    </form>
</div>

@endsection
