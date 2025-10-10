<?php
namespace App\Http\Repositories;

use App\Models\Information;
use Illuminate\Support\Facades\Auth;

class InformationRepository{
    public function getInformationById($id)
    {
        return Information::findOrFail($id);
    }

    public function updateInformation(Information $information, $data)
    {
        return $information->update($data);
    }

    public function getInformationByAddress($address)
    {
        return Information::findOrFail($address);
    }

    public function getInformationByEmail($email)
    {
        return Information::findOrFail($email);
    }

    public function getInformationByPhone($phone)
    {
        return Information::findOrFail($phone);
    }

    public function storeInformation($data)
    {
        return Information::create([
            'user_id' => Auth::id() ?? $data['user_id'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'email' => $data['email']
        ]);
    }
}
