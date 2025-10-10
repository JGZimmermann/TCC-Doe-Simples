<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInformationRequest;
use App\Http\Requests\UpdateInformationRequest;
use App\Http\Services\InformationService;

class InformationController extends Controller
{
    public function __construct(protected InformationService $informationService)
    {
    }

    public function show($id)
    {
        return response()->json($this->informationService->getInformationById($id));
    }

    public function store(StoreInformationRequest $request)
    {
        response()->json($this->informationService->storeInformation($request),201);
    }

    public function update(UpdateInformationRequest $request,$id)
    {
        return response()->json($this->informationService->updateInformation($id,$request));
    }

    public function destroy($id)
    {
        return response()->json($this->informationService->deleteInformation($id));
    }
}
