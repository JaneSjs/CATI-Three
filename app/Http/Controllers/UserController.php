<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        if (Gate::denies('admin')) {
            $data['users'] = User::where('role', '!=', 'admin')
                                ->paginate(10);
        } else {
            $data['users'] = User::paginate(10);
        }

        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roles'] = Role::all();

        return view('users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //dd($request);

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'ext_no' => $request->input('ext_no'),
            'password' => Hash::make('password')
        ]);

        //dd($user);
        

        //Email The User with reset Password Link.

        
        if ($user) {
            $user->roles()->sync($request->roles);
            
            //If email has been sent,flash success message
            return redirect('users/create')->with('success', ' User is now registered. Ask them to check their email.');
        } else {
            return redirect('users.create')->with('error', ' User registration has failed.');
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
        $data['user'] = $user;
        $data['roles'] = Role::all();

        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //dd($user);
        if ($user)
        {
            if ($request->has(['password']))
            {
                $user->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'ext_no' => $request->input('ext_no'),
                    'password' => Hash::make('buzzword')
                ]);
                $user->roles()->sync($request->roles);

                return redirect()->back()->with('warning', 'User Has Been DeActivated');
            }
            else
            {
                $user->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'ext_no' => $request->input('ext_no'),
                ]);
                $user->roles()->sync($request->roles);

                return redirect()->back()->with('success', 'User Details Has Been Updated Successfully.');
            }
            
        } else {
            // code...
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user) {
            $user->delete();

            return redirect()->route('users.index')->with('info', 'User has been removed from the system');
        } else {
            return redirect()->route('users.index')->with('error', 'User was not found in the system');
        }

    }

    /**
     * Show the login page.
     */
    public function login()
    {
        return view('auth.login');
    }
}
