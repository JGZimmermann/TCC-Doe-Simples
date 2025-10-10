<?php

namespace App\Http\Services;

use App\Http\Repositories\InformationRepository;
use Illuminate\Support\Facades\Auth;

class InformationService
{
    public function __construct(protected InformationRepository $informationRepository)
    {
    }

    public function getInformationById($id)
    {
        return $this->informationRepository->getInformationById($id);
    }

    public function updateInformation($id, $data)
    {
        $information = $this->getInformationById($id);
        return $this->informationRepository->updateInformation($information, $data);
    }

    public function storeInformation($data)
    {
        return $this->informationRepository->storeInformation($data);
    }

    public function getInformationByUserId()
    {
        return Auth::user()->information();
    }

    public function deleteInformation($id)
    {
        $information = $this->getInformationById($id);
        $information->delete();
        return [
            'message' => 'Informação deletada com sucesso!',
            $information
        ];
    }
}

