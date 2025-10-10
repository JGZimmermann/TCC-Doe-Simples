@extends('layouts.app')

@section('title', 'Editar Meu Perfil')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Meu Perfil</h2>
        </div>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header">
                    Informações Pessoais
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf', $user->cpf) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="text" class="form-control" id="password" name="password" value="{{ old('password', $user->password) }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="blood_type" class="form-label">Tipo Sanguíneo</label>
                            <select class="form-select" id="blood_type" name="blood_type" required>
                                <option value="">Selecione...</option>
                                @php
                                    $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'N/A'];
                                @endphp
                                @foreach ($bloodTypes as $type)
                                    <option value="{{ $type }}" {{ old('blood_type', $user->blood_type) == $type ? 'selected' : '' }}>
                                        {{ $type === 'N/A' ? 'Não sei' : $type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="birth_date" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}" required>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($user->information as $information)
                <div class="card">
                    <div class="card-header">
                        Informações de Contato
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="address" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $information->address) }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone_number" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $information->phone_number) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $information->email) }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </form>
    </div>
@endsection
