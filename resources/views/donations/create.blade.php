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
                            <div class="card-body overflow-auto" id="hours-container" style="max-height: 300px;">
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

                <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirmacaoDoacao">
        		Confirmar Agendamento
    		</button>

    		<div class="modal fade" id="confirmacaoDoacao" tabindex="-1" aria-labelledby="confirmacaoDoacaoLabel" aria-hidden="true">
      			<div class="modal-dialog modal-lg modal-dialog-centered">
        			<div class="modal-content">
          				<div class="modal-header bg-danger text-white">
            					<h5 class="modal-title" id="confirmacaoDoacaoLabel">Antes de confirmar sua doação</h5>
            					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
          				</div>

          				<div class="modal-body" style="max-height:70vh; overflow-y:auto; color:#333;">
            					<h6 style="color:#d63e49; font-weight:700;">O que é preciso para doar:</h6>
            					<ul style="margin-left:15px;">
              						<li>Estar em boas condições de saúde;</li>
              						<li>Apresentar documento oficial de identidade com foto;</li>
              						<li>Ter idade entre 16 e 69 anos (menores de 18 acompanhados por responsável);</li>
              						<li>Pesar no mínimo 50 kg (com desconto de vestimentas);</li>
              						<li>Não estar em jejum e evitar alimentação gordurosa;</li>
              						<li>Ter dormido pelo menos 6 horas nas últimas 24 horas;</li>
              						<li>Não ter ingerido bebidas alcoólicas nas 12 horas anteriores à doação;</li>
              						<li>Não fumar pelo menos duas horas antes da doação;</li>
              						<li>Recomenda-se reforço na hidratação;</li>
              						<li>O limite de idade para a primeira doação é de 60 anos;</li>
              						<li>Se trabalha no período noturno, compareça após o horário diurno de descanso.</li>
            					</ul>

            					<h6 style="color:#d63e49; font-weight:700; margin-top:20px;">Impeditivos Temporários:</h6>
            					<ul style="margin-left:15px;">
              						<li>Gripe ou febre;</li>
              						<li>Gestantes ou mães que amamentam bebês com menos de 12 meses;</li>
              						<li>Até 90 dias após aborto ou parto normal e até 180 dias após cesariana;</li>
              						<li>Tatuagem ou acupuntura nos últimos 6 meses;</li>
              						<li>Piercing: 6 meses se em local seguro, 12 meses se sem avaliação sanitária;</li>
              						<li>Piercing em cavidade oral ou genital: 12 meses após retirada;</li>
              						<li>Exposição a risco para AIDS (múltiplos parceiros, uso de drogas);</li>
              						<li>Herpes labial ativa;</li>
              						<li>Vacina Covid:
                					<ul>
                  						<li>Coronavac (Butantan): 48 horas;</li>
                  						<li>AstraZeneca (Fiocruz): 7 dias;</li>
                  						<li>Pfizer: 7 dias.</li>
                					</ul>
              						</li>
            					</ul>

            					<h6 style="color:#d63e49; font-weight:700; margin-top:20px;">Impeditivos Definitivos:</h6>
            					<ul style="margin-left:15px;">
              						<li>Doença de Chagas;</li>
              						<li>Hepatite após os 11 anos de idade;</li>
              						<li>Ser portador de HIV (AIDS), Hepatite B ou C, HTLV;</li>
              						<li>Uso de drogas injetáveis.</li>
            					</ul>

            					<p style="margin-top:20px; font-weight:500; color:#000;"> Se você leu e confirma que não possui <strong>nenhum</strong> dos impeditivos, clique em "Confirmar e Prosseguir".</p>
          				</div>

          				<div class="modal-footer">
            					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            					<button type="submit" class="btn btn-danger">Confirmar e Prosseguir</button>
          				</div>
        			</div>
      			</div>
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
                            <div class="card-body overflow-auto" id="hours-container" style="max-height: 300px;">
                                <p class="text-muted">Selecione uma data para ver os horários disponíveis.</p>
                            </div>
                        </div>
                    </div>
                </div>
        	<button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirmacaoDoacao">
                        Confirmar Agendamento
                </button>

                <div class="modal fade" id="confirmacaoDoacao" tabindex="-1" aria-labelledby="confirmacaoDoacaoLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="confirmacaoDoacaoLabel">Antes de confirmar sua doação</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"><>
                                        </div>

                                        <div class="modal-body" style="max-height:70vh; overflow-y:auto; color:#333;">
                                                <h6 style="color:#d63e49; font-weight:700;">O que é preciso para doar:</h6>
                                                <ul style="margin-left:15px;">
                                                        <li>Estar em boas condições de saúde;</li>
                                                        <li>Apresentar documento oficial de identidade com foto;</li>
                                                        <li>Ter idade entre 16 e 69 anos (menores de 18 acompanhados por responsável);</li>
                                                        <li>Pesar no mínimo 50 kg (com desconto de vestimentas);</li>
                                                        <li>Não estar em jejum e evitar alimentação gordurosa;</li>
                                                        <li>Ter dormido pelo menos 6 horas nas últimas 24 horas;</li>
                                                        <li>Não ter ingerido bebidas alcoólicas nas 12 horas anteriores à doação;</li>
                                                        <li>Não fumar pelo menos duas horas antes da doação;</li>
                                                        <li>Recomenda-se reforço na hidratação;</li>
                                                        <li>O limite de idade para a primeira doação é de 60 anos;</li>
                                                        <li>Se trabalha no período noturno, compareça após o horário diurno de descanso.</li>
                                                </ul>

                                                <h6 style="color:#d63e49; font-weight:700; margin-top:20px;">Impeditivos Temporários:</h6>
                                                <ul style="margin-left:15px;">
                                                        <li>Gripe ou febre;</li>
                                                        <li>Gestantes ou mães que amamentam bebês com menos de 12 meses;</li>
                                                        <li>Até 90 dias após aborto ou parto normal e até 180 dias após cesariana;</li>
                                                        <li>Tatuagem ou acupuntura nos últimos 6 meses;</li>
                                                        <li>Piercing: 6 meses se em local seguro, 12 meses se sem avaliação sanitária;</li>
                                                        <li>Piercing em cavidade oral ou genital: 12 meses após retirada;</li>
                                                        <li>Exposição a risco para AIDS (múltiplos parceiros, uso de drogas);</li>
                                                        <li>Herpes labial ativa;</li>
                                                        <li>Vacina Covid:
								<ul>
                                                                <li>Coronavac (Butantan): 48 horas;</li>
                                                                <li>AstraZeneca (Fiocruz): 7 dias;</li>
                                                                <li>Pfizer: 7 dias.</li>
                                                        </ul>
                                                        </li>
                                                </ul>

                                                <h6 style="color:#d63e49; font-weight:700; margin-top:20px;">Impeditivos Definitivos:</h6>
                                                <ul style="margin-left:15px;">
                                                        <li>Doença de Chagas;</li>
                                                        <li>Hepatite após os 11 anos de idade;</li>
                                                        <li>Ser portador de HIV (AIDS), Hepatite B ou C, HTLV;</li>
                                                        <li>Uso de drogas injetáveis.</li>
                                                </ul>

                                                <p style="margin-top:20px; font-weight:500; color:#000;"> Se você leu e confirma que não possui <stro>
                                        </div>

                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Confirmar e Prosseguir</button>
                                        </div>
                                </div>
                        </div>
                </div>
            </form>
        @endauth
    </div>
    <script>
        const dateInput = document.getElementById('donation_date');
        const hoursContainer = document.getElementById('hours-container');

        dateInput.addEventListener('change', async function () {
            const selectedDate = this.value;
	    const today = new Date();
	    today.setDate(today.getDate() - 1);
            const parts = selectedDate.split('-');
            const selectedDateUnite = new Date(parts[0], parts[1] - 1, parts[2]);
	    if(selectedDateUnite < today) {
		hoursContainer.innerHTML = '<p class="text-danger">Escolha um dia válido.</p>';
	    }
	    else{
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
                let hours = [];
                const orderedHours = [...availableHours].sort((a, b) => {
                        const dataHoraA = new Date(`${a.day}T${a.start_time}`);
                        const dataHoraB = new Date(`${b.day}T${b.start_time}`);

                        return dataHoraA - dataHoraB;
                });
                for (const availableHour of orderedHours) {
                    if(!hours.includes(availableHour.start_time)){
                        html += `
                        <label class="list-group-item">
                                <input class="form-check-input me-1" type="radio" id="hour_id" name="hour_id" value="${availableHour.id}" required>
                                <strong>${availableHour.start_time.split(':')[0]}:${availableHour.start_time.split(':')[1]}</strong>
                        </label>
                        `;
                        hours.push(availableHour.start_time);
                    } else{
                        continue;
                      }
                }

                html += '</div>';
                hoursContainer.innerHTML = html;

            } catch (error) {
                console.error(error);
                hoursContainer.innerHTML = '<p class="text-danger">Ocorreu um erro ao carregar os horários.</p>';
            }
	    }
        });

    </script>
@endsection


