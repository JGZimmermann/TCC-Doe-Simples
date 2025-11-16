@extends('layouts.app')

@section('title', 'Bem-vindo ao Doe Simples')

@section('content')
@if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
@endif
<section class="hero bg-light py-5">
    <div class="container text-center">
        <h1 class="display-5 fw-bold text-danger">Doe sangue, salve vidas</h1>
        <p class="lead text-muted mb-4">
            Um simples gesto pode transformar o destino de alguém. Agende sua doação e ajude o Hemocentro de Guarapuava a manter os estoques de sangue sempre disponíveis.
        </p>
        <a href="{{ route('donation.create') }}" class="btn btn-danger btn-lg px-5 py-3 shadow-sm">
            Quero agendar minha doação
        </a>
    </div>
</section>

<section class="py-5" style="background-color:#f8f9fa;">
  <div class="container d-flex flex-wrap align-items-center justify-content-between">
    <div style="flex:1; min-width:300px; padding-right:20px;">
      <h2 style="color:#d63e49; font-weight:700; margin-bottom:15px;">Sobre o Doe Simples</h2>
      <p style="font-size:1rem; color:#333; line-height:1.6;">
        O Doe Simples é um sistema agendamento do hemocentro de Guarapuava que foi criado para facilitar o processo de doação de sangue.
        Através dele, qualquer pessoa pode escolher o melhor dia e horário para doar, de forma rápida, prática e totalmente online.
      </p>
      <p style="font-size:1rem; color:#333; line-height:1.6;">
        O objetivo é reduzir o tempo de espera e otimizar o atendimento, garantindo conforto aos doadores e eficiência à equipe do Hemocentro.
      </p>

      <h3 style="color:#d63e49; font-weight:600; margin-top:25px;">Sobre o Hemocentro</h3>
      <p style="font-size:1rem; color:#333; line-height:1.6;">
        O Hemocentro Regional de Guarapuava é responsável por coletar, processar e distribuir sangue e hemocomponentes para hospitais da região. Atua com rigor técnico e compromisso social, salvando vidas todos os dias graças aos doadores voluntários.
      </p>
    </div>

    <div style="flex:1; min-width:300px; text-align:center;">
      <img src="https://diarioreservense.com.br/fotos/g_130.jpg" alt="Doação de Sangue" style="max-width:100%; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.2);">
    </div>
  </div>
</section>


<section class="info py-5 bg-white border-top">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-md-6">
                <img src="https://nossagente.info/wp-content/uploads/2022/06/sangue-scaled.jpg" alt="Doação de sangue" class="img-fluid rounded-3 shadow-sm">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold text-danger mb-3">Por que doar sangue?</h2>
                <p class="text-muted">
                    Cada doação pode salvar até <strong>quatro vidas</strong>. A doação é rápida, segura e essencial para pacientes em cirurgias, acidentes e tratamentos de doenças graves.
                </p>
                <ul class="list-unstyled mt-3">
                    <li class="mb-2"><i class="bi bi-heart-fill text-danger me-2"></i> Doe a cada 3 meses (homens) ou 4 meses (mulheres)</li>
                    <li class="mb-2"><i class="bi bi-people-fill text-danger me-2"></i> Contribua com a saúde da sua comunidade</li>
                    <li><i class="bi bi-clock-history text-danger me-2"></i> Leva menos de 40 minutos do seu tempo</li>
                </ul>
                <a href="{{ route('donation.create') }}" class="btn btn-outline-danger mt-3">
                    Agendar agora
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
