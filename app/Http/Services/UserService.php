<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Http\Repositories\InformationRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(protected UserRepository $userRepository, protected InformationRepository $informationRepository)
    {
    }

    public function storeDonor($data)
    {
        return $this->userRepository->storeDonor($data);
    }

    public function storeEmployee($data)
    {
        return $this->userRepository->storeEmployee($data);
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function updateUser($data)
    {
        $id = Auth::id();
        $user = $this->getUserById($id);
        if(isset($data['password'])){
            $data = $this->hashPassword($data);
        }
        if(isset($data['address'])){
            $information = $this->informationRepository->getInformationByAddress($data['address']);
            $this->informationRepository->updateInformation($information, $data);
        }
        if(isset($data['phone_number'])){
            $information = $this->informationRepository->getInformationByPhone($data['phone_number']);
            $this->informationRepository->updateInformation($information, $data);
        }
        if(isset($data['email'])){
            $information = $this->informationRepository->getInformationByEmail($data['email']);
            $this->informationRepository->updateInformation($information, $data);
        }
        $this->userRepository->updateUser($user, $data);
        return redirect()->route('profile')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function hashPassword($data)
    {
        $data['password'] = Hash::make($data['password']);
        return $data;
    }

    public function login($data)
    {
        return Auth::attempt($data);
    }

    public function logoutUser()
    {
        Auth::logout();
    }

    public function profile()
    {
        $user = Auth::user();
        $user->load('information');
        return view('users.profile', [
            'user' => $user
        ]);
    }

    public function deleteUser()
    {
        $id = Auth::id();
        $user = $this->getUserById($id);
        $user->delete();
        return [
            'message' => 'Usuário deletado com sucesso!'
        ];
    }
}
