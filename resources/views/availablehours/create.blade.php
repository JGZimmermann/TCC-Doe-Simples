@extends('layouts.app')

@section('title', 'Criar Novos Horários')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('register.hour.form') }}">
                                Criar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.hour.index') }}">
                                Horários
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('donation.index') }}">
                                Agendamentos
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Criar Horário Disponível</h1>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Opa! Encontramos alguns problemas:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.hour.store') }}">
                    @csrf

                    <div class="mb-4">
                        <h3>1. Selecione o Atendente</h3>
                        <div class="d-flex flex-wrap gap-3">
                            @forelse ($employees as $employee)
                                <div class="card" style="width: 12rem;">
                                    <div class="card-body text-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="employee_id" id="employee_{{ $employee->id }}" value="{{ $employee->id }}">
                                            <label class="form-check-label stretched-link" for="employee_{{ $employee->id }}">
                                                {{ $employee->name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">Nenhum atendente cadastrado.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="mb-4">
                        <h3>2. Selecione os Dias e Horários</h3>
                        <div class="mb-3">
                            <label class="form-label">Dias da Semana:</label>
                            <div class="d-flex flex-wrap gap-4">
                                @php
                                    $weekDays = [
                                        '1' => 'Segunda-feira',
                                        '2' => 'Terça-feira',
                                        '3' => 'Quarta-feira',
                                        '4' => 'Quinta-feira',
                                        '5' => 'Sexta-feira'
                                    ];
                                @endphp

                                @foreach ($weekDays as $dayValue => $dayName)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="days_of_week[]" value="{{ $dayValue }}" id="day_{{ $dayValue }}">
                                        <label class="form-check-label" for="day_{{ $dayValue }}">
                                            {{ $dayName }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="form-label fw-bold">Horários Disponíveis:</label>
                            <div class="d-flex flex-wrap gap-4">
                                @php
                                    $availableTimes = ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'];
                                @endphp
                                @foreach ($availableTimes as $time)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="times[]" value="{{ $time }}" id="time_{{ str_replace(':', '', $time) }}">
                                        <label class="form-check-label" for="time_{{ str_replace(':', '', $time) }}">
                                            {{ $time }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Horários</button>
                </form>
            </main>
        </div>

    </div>

@endsection
