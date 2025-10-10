<?php

namespace App\Http\Controllers;



use App\Http\Requests\StoreDonationRequest;
use App\Http\Requests\StoreDonationWithouLoginRequest;
use App\Http\Services\DonationService;

class DonationController extends Controller
{
    public function __construct(protected DonationService $donationService)
    {
    }

    public function index()
    {
        return view('donations.index');
    }

    public function allDonations()
    {
        return response()->json($this->donationService->getAllDonations());
    }

    public function acceptedDonations()
    {
        return response()->json($this->donationService->getAllAcceptedDonations());
    }

    public function pendingDonations()
    {
        return response()->json($this->donationService->getAllPendingDonations());
    }

    public function create()
    {
        return $this->donationService->create();
    }

    public function show($id)
    {
        return response()->json($this->donationService->getDonationById($id));
    }

    public function store(StoreDonationRequest $request)
    {
        $this->donationService->storeDonation($request);
        return redirect()->route('home')->with('success', 'Seu agendamento foi solicitado com sucesso!');
    }

    public function storeWithoutLogin(StoreDonationWithouLoginRequest $request)
    {
        $this->donationService->storeDonationWithoutLogin($request);
        return redirect()->route('home')->with('success', 'Seu agendamento foi solicitado com sucesso!');
    }

    public function update($id, $request)
    {
        return response()->json($this->donationService->updateDonation($id, $request));
    }

    public function delete($id)
    {
        return response()->json($this->donationService->deleteDonation($id));
    }
}
