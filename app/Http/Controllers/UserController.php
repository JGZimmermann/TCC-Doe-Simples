<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreDonorRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Services\UserService;
use App\Http\Services\InformationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService, protected InformationService $informationService)
    {
    }

    public function create()
    {
        return view('users.create');
    }

    public function registerDonor(StoreDonorRequest $request)
    {
        $user = $this->userService->storeDonor($request->validated());
        $request['user_id'] = $user->id;
        $this->informationService->storeInformation($request);

        Auth::login($user);
        return redirect()->route('home')->with('success', 'Sua conta foi criada com sucesso!');
    }

    public function createEmployee()
    {
        return view('employees.create');
    }

    public function registerEmployee(StoreEmployeeRequest $request)
    {
        $this->userService->storeEmployee($request->validated());
        return redirect()->route('home')->with('success', 'Usuário criado com sucesso!');
    }

    public function loginForm()
    {
        return view('users.login');
    }

    public function login(LoginRequest $request)
    {
        $login = $this->userService->login($request->validated());
        if($login){
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Sua conta foi criada com sucesso!');
        }
        return back()->withErrors([
            'cpf' => 'O CPF ou senha estão incorretos.',
        ])->onlyInput('cpf');
    }

    public function logout(Request $request)
    {
        $this->userService->logoutUser();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Você saiu da sua conta!');
    }

    public function profile()
    {
        return $this->userService->profile();
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        return $this->userService->updateUser($request->validated());
    }

    public function delete()
    {
        return response()->json($this->userService->deleteUser(),204);
    }
}
