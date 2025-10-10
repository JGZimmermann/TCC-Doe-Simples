<?php
namespace App\Http\Repositories;

use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class DonationRepository{

    public function getAllDonations()
    {
        return Donation::all();
    }
    public function getDonationById($id)
    {
        return Donation::findOrFail($id);
    }

    public function getAllPendingDontations()
    {
        return Donation::where('status', 'pending')->get();
    }

    public function getAllAcceptedDonations()
    {
        return Donation::where('status', 'accepted')->get();
    }

    public function updateDonation(Donation $donation, $data)
    {
        return $donation->update($data);
    }

    public function storeDonationWithoutLogin($data)
    {
        return Donation::create([
            'hour_id' => $data['hour_id'],
            'donor_id' => $data['donor_id'],
            'status' => 'pending'
        ]);
    }

    public function storeDonation($data)
    {
        return Donation::create([
            'hour_id' => $data['hour_id'],
            'donor_id' => Auth::user()->id,
            'status' => 'pending'
        ]);
    }
}
