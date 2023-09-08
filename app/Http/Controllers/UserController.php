<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $existingCPF = User::where('cpf', $request->input('cpf'))->first();
        $existingEMAIL = User::where('email', $request->input('email'))->first();
        if ($existingCPF) {
            flash()->addError('Já existe um usuário com esse CPF');
            return redirect()->back();
        }

        if ($existingEMAIL) {
            flash()->addError('Já existe um usuário com esse EMAIL');

            return redirect()->back();
        }

        $user = User::create($request->all());

        Auth::login($user);
        flash()->addSuccess('Usuário criado e logado');
        
        return redirect()->route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
