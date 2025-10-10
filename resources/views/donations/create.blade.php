@extends('layouts.app')

@section('title', 'Agendar Doação')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Agendar sua Doação</h1>
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

        @guest
            <form method="POST" action="{{ route('donation.store.guest') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                1. Selecione a data
                            </div>
                            <div class="card-body">
                                <label for="donation_date" class="form-label">Escolha um dia para doar:</label>
                                <input type="date" class="form-control" id="donation_date" name="date" min="{{ now()->toDateString() }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                2. Selecione o horário
                            </div>
                            <div class="card-body" id="hours-container">
                                <p class="text-muted">Selecione uma data para ver os horários disponíveis.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone_number">Telefone / Celular (apenas números)</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                </div>

                <div class="mb-3">
                    <label for="birth_date">Data de Nascimento</label>
                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
                </div>

                <div class="mb-3">
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

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Confirmar Agendamento</button>
                </div>
            </form>
        @endguest
        @auth
            <form method="POST" action="{{ route('donation.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                1. Selecione a data
                            </div>
                            <div class="card-body">
                                <label for="donation_date" class="form-label">Escolha um dia para doar:</label>
                                <input type="date" class="form-control" id="donation_date" name="date" min="{{ now()->toDateString() }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                2. Selecione o horário
                            </div>
                            <div class="card-body" id="hours-container">
                                <p class="text-muted">Selecione uma data para ver os horários disponíveis.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Confirmar Agendamento</button>
                </div>
            </form>
        @endauth
    </div>
    <script>
        const dateInput = document.getElementById('donation_date');
        const hoursContainer = document.getElementById('hours-container');

        dateInput.addEventListener('change', async function () {
            const selectedDate = this.value;
            hoursContainer.innerHTML = '<p class="text-muted">Carregando horários...</p>';

            if (!selectedDate) return;

            try {
                const response = await fetch(`/availableHours/${selectedDate}`);
                if (!response.ok) throw new Error('Erro na resposta do servidor.');

                const availableHours = await response.json();

                if (availableHours.length === 0) {
                    hoursContainer.innerHTML = '<p class="text-danger">Nenhum horário disponível para esta data. Por favor, selecione outro dia.</p>';
                    return;
                }
                let html = '<div class="list-group">';

                for (const availableHour of availableHours) {
                    html += `
                    <label class="list-group-item">
                        <input class="form-check-input me-1" type="radio" id="hour_id" name="hour_id" value="${availableHour.id}" required>
                        <strong>${availableHour.start_time.split(':')[0]}:${availableHour.start_time.split(':')[1]}</strong>
                    </label>
                `;
                }

                html += '</div>';
                hoursContainer.innerHTML = html;

            } catch (error) {
                console.error(error);
                hoursContainer.innerHTML = '<p class="text-danger">Ocorreu um erro ao carregar os horários.</p>';
            }
        });

    </script>
@endsection


