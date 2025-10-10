@extends('layouts.app')

@section('title', 'Doações')

@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- A sidebar de navegação que você já tinha --}}
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.hour.form') }}">
                                Criar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.hour.index') }}">
                                Horários
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('donation.index') }}">
                                Agendamentos
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Agendamentos de Doação</h1>
                </div>

                <div class="mb-3">
                    <label for="status-filter" class="form-label fw-bold">Filtrar por status:</label>
                    <select class="form-select" id="status-filter" style="max-width: 250px;">
                        <option value="pending" selected>Pendentes</option>
                        <option value="accepted">Aceitas</option>
                    </select>
                </div>

                <div id="donations-container" class="row mt-4">
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilter = document.getElementById('status-filter');
            const donationsContainer = document.getElementById('donations-container');

            async function fetchDonations(status) {
                donationsContainer.innerHTML = '<p class="text-center col-12">Carregando agendamentos...</p>';

                const baseUrl = '/donations/pending';
                const url = `${baseUrl}`;

                try {
                    const response = await fetch(url);

                    if (!response.ok) {
                        throw new Error(`Erro na requisição: ${response.statusText}`);
                    }

                    const data = await response.json();

                    donationsContainer.innerHTML = '';

                    if (!data || data.length === 0) {
                        donationsContainer.innerHTML = `<p class="text-center col-12">Nenhum agendamento encontrado com o status "${status}".</p>`;
                        return;
                    }

                    data.forEach(donation => {
                        const cardHtml = `
                            <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Agendamento #${donation.id}</h5>
                                        <p class="card-text"><strong>Doador:</strong> ${donation.donor_name || 'Não informado'}</p>
                                        <p class="card-text">
                                            <strong>Data:</strong> ${new Date(donation.scheduled_at).toLocaleString('pt-BR')}
                                        </p>
                        <a href="/donations/${donation.id}" class="btn btn-primary mt-2">Ver Detalhes</a>
                                    </div>
                                </div>
                            </div>
                        `;
                        donationsContainer.insertAdjacentHTML('beforeend', cardHtml);
                    });

                } catch (error) {
                    console.error('Falha ao buscar doações:', error);
                    donationsContainer.innerHTML = '<p class="text-center text-danger col-12">Ocorreu um erro ao carregar os agendamentos. Por favor, tente novamente mais tarde.</p>';
                }
            }

            statusFilter.addEventListener('change', function() {
                fetchDonations(this.value);
            });

            fetchDonations(statusFilter.value);
        });
    </script>
@endsection
