@extends('layouts.app')

@section('title', 'Bem-vindo ao Doe Simples')

@section('content')
<div class="welcome-container">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div>
        <h1>Sua Doação Transforma Vidas</h1>
        <p>Cada ajuda já conta, faça a diferença na vida de uma pessoa que precisa!</p>

    </div>
</div>
@endsection
