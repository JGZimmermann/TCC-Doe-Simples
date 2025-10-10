<?php

namespace App\Http\Services;

use App\Http\Repositories\AvailableHourRepository;
use Illuminate\Support\Carbon;

class AvailableHourService
{
    public function __construct(protected AvailableHourRepository $availableHourRepository)
    {
    }

    public function getAvailableHourById($id)
    {
        return $this->availableHourRepository->getAvailableHourById($id);
    }

    public function showAllAvailableHours($day)
    {
        return $this->availableHourRepository->showAllAvailableHours($day);
    }
    public function updateAvailableHour($id, $data)
    {
        $availableHour = $this->getAvailableHourById($id);
        return $this->availableHourRepository->updateAvailableHour($availableHour, $data);
    }

    public function storeAvailableHour($data)
    {
        $validatedData = $data;
        $daysOfWeekSelected = $validatedData['days_of_week'];
        $timesSelected = $validatedData['times'];
        $employeeId = $validatedData['employee_id'];

        $carbonDayMap = [
            1 => Carbon::MONDAY,
            2 => Carbon::TUESDAY,
            3 => Carbon::WEDNESDAY,
            4 => Carbon::THURSDAY,
            5 => Carbon::FRIDAY,
            6 => Carbon::SATURDAY,
            7 => Carbon::SUNDAY
        ];

        foreach ($daysOfWeekSelected as $dayNumber) {
            $targetDate = Carbon::now()->next($carbonDayMap[$dayNumber]);

            foreach ($timesSelected as $time) {
                for ($i = 0; $i < 4; $i++) {

                    $hourData = [
                        'employee_id' => $employeeId,
                        'date'        => $targetDate->toDateString(),
                        'time'        => $time,
                    ];
                    $this->availableHourRepository->storeAvailableHour($hourData);
                }
            }
        }

        return redirect()->route('register.hour.form')->with('success', 'Grade de horários criada com sucesso!');
    }

    public function deleteAvailableHour($id)
    {
        $availableHour = $this->getAvailableHourById($id);
        $availableHour->delete();
        return [
            'message' => 'Horário deletado com sucesso!',
            $availableHour
        ];
    }

    public function turnHourAvailable($id)
    {
        $availableHour = $this->getAvailableHourById($id);
        return $availableHour->update(['available_hour' => true]);
    }

    public function storeAmountOfHoursByEmployee($data){
        for ($i = 0; $i < 5; $i++){
            $this->storeAvailableHour($data);
        }
        return [
            'message' => 'Horários criados com sucesso!'
        ];
    }
}
