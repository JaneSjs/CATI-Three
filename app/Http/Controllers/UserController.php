<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::paginate(10);

        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'ext_no' => 'required|integer|numeric|max:999',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:255',
        ]);
        

        User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'ext_no' => $request->input('ext_no'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        //Email The User with reset Password Link.

        
        if (true) {
            //If email has been sent,flash success message
            return redirect('users/create')->with('success', ' User is now registered. Ask them to check their email.');
        } else {
            return redirect('register')->with('error', ' User registration has failed.');
        }
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
    public function update(UpdateUserRequest $request, User $user)
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

    /**
     * Show the login page.
     */
    public function login()
    {
        return view('auth.login');
    }
}
