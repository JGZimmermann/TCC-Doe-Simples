<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreAvailableHourRequest;
use App\Http\Requests\UpdateAvailableHours;
use App\Http\Services\AvailableHourService;
use App\Models\User;

class AvailableHourController extends Controller
{
    public function __construct(protected AvailableHourService $availableHourService)
    {
    }

    public function availableHourById($id)
    {
        return response()->json($this->availableHourService->getAvailableHourById($id));
    }

    public function show($day)
    {
        return response()->json($this->availableHourService->showAllAvailableHours($day));
    }

    public function create()
    {
        $employees = User::where('user_type', 'clinician')->get();
        return view('availablehours.create', compact('employees'));
    }

    public function store(StoreAvailableHourRequest $request)
    {
        return $this->availableHourService->storeAvailableHour($request);
    }

    public function update(UpdateAvailableHours $request, $id)
    {
        return response()->json($this->availableHourService->updateAvailableHour($request, $id));
    }

    public function destroy($id)
    {
        return response()->json($this->availableHourService->deleteAvailableHour($id));
    }

    public function turnHourAvailable($id)
    {
        return response()->json($this->availableHourService->turnHourAvailable($id));
    }
}
