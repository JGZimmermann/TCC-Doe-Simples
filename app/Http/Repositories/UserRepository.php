<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository{
    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function updateUser(User $user, $data)
    {
        return $user->update($data);
    }

    public function storeDonor($data)
    {
        return User::create([
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'password' => Hash::make($data['password']),
            'birth_date' => $data['birth_date'],
            'blood_type' => $data['blood_type'],
            'user_type' => 'donor'
        ]);
    }

    public function storeEmployee($data)
    {
        return User::create([
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'password' => Hash::make($data['password']),
            'birth_date' => $data['birth_date'],
            'blood_type' => $data['blood_type'],
            'user_type' => $data['user_type']
        ]);
    }

    public function findUserByCPF($data)
    {
        return User::where('cpf',$data)->first();
    }

    public function findUserByUsername($data)
    {
        return User::where('username',$data)->whereNotNull('hashed_password')->first();
    }
}
