<?php
namespace App\Http\Repositories;

use App\Models\AvailableHour;

class AvailableHourRepository{
    public function getAvailableHourById($id)
    {
        return AvailableHour::findOrFail($id);
    }

    public function updateAvailableHour(AvailableHour $availableHour, $data)
    {
        return $availableHour->update($data);
    }

    public function showAllAvailableHoursByEmployeeId($id)
    {
        return AvailableHour::where('employee_id', $id)->get();
    }

    public function showAllAvailableHours($day)
    {
        return AvailableHour::where('availability', 1)
            ->where('day', $day)
            ->get();
    }

    public function storeAvailableHour($data)
    {
        return AvailableHour::create([
            'employee_id' => $data['employee_id'],
            'day' => $data['date'],
            'start_time' => $data['time'],
            'availability' => true
        ]);
    }
}
