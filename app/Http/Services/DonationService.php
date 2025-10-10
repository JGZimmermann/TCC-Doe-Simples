<?php

namespace App\Http\Services;



use App\Http\Repositories\DonationRepository;
use App\Http\Repositories\AvailableHourRepository;
use App\Models\Information;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DonationService
{
    public function __construct(protected DonationRepository $donationRepository, protected AvailableHourRepository $availableHourRepository)
    {
    }

    public function getAllDonations()
    {
        return $this->donationRepository->getAllDonations();
    }

    public function getAllPendingDonations()
    {
        return $this->donationRepository->getAllPendingDontations();
    }

    public function getAllAcceptedDonations()
    {
        return $this->donationRepository->getAllAcceptedDonations();
    }
    public function getDonationById($id)
    {
        return $this->donationRepository->getDonationById($id);
    }
    public function updateDonation($id, $data)
    {
        $donation = $this->getDonationById($id);
        return $this->donationRepository->updateDonation($donation, $data);
    }

    public function create()
    {
        return view('donations.create');
    }

    public function storeDonation($data)
    {
        $hour = $this->availableHourRepository->getAvailableHourById($data['hour_id']);
        $hour->update([
            'availability' => 0
        ]);
        return $this->donationRepository->storeDonation($data);
    }

    public function storeDonationWithoutLogin($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'blood_type' => $data['blood_type'],
            'birth_date' => $data['birth_date'],
        ]);
        Information::create([
            'user_id' => $user->id,
            'phone_number' => $data['phone_number'],
        ]);

        $data['donor_id'] = $user->id;
        $hour = $this->availableHourRepository->getAvailableHourById($data['hour_id']);
        $hour->update([
            'availability' => 0
        ]);
        return $this->donationRepository->storeDonationWithoutLogin($data);
    }

    public function deleteDonation($id)
    {
        $donation = $this->getDonationById($id);
        $donation->delete();
        return [
            'message' => 'Registro de doação deletado com sucesso!',
            $donation
        ];
    }
}
