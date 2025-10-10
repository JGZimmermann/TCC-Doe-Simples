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
