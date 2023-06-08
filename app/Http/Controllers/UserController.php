<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = new User();

        // if (Gate::allows('admin')){
        //     $data['users'] = $user->paginate(10);
        //     //dd($data);
        // } else {
        //     $data['users'] = $user->roles()
        //                         ->where('role_id', '!=', '1')
        //                         ->paginate(10);
        //     //dd($data);
        // }
        $data['users'] = $user->with('roles')->paginate(10);
        //dd($data);

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
            'ext_no' => $request->input('ext_no'),
            'email' => $request->input('email'),
            'national_id' => $request->input('national_id'),
            'phone_1' => $request->input('phone_1'),
            'gender' => $request->input('gender'),
            'password' => Hash::make('buzz-word')
        ]);

        //dd($user);

        if ($user) {
            $user->roles()->sync($request->roles);

            // Send Password Reset Link
            //$reset_link = Password::sendResetLink($request->only(['email']));
            
            if (true) {
                return redirect('users/create')->with('success', ' User is now registered. Ask them to check their email.');
            } else {
                return redirect('users/create')->with('error', ' User has been registered. But the system has not been able to Successfully email them their login instructions. They can meanwhile use <strong>buzz-word</strong> as their temporary password');
            }
            
            
            
            
        } else {
            return redirect('users.create')->with('error', ' User registration has failed.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data['user'] = $user;
        $data['roles'] = $user->roles()->get();

        return view('users.show', $data);
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

                return redirect()->back()->with('warning', 'User Has Been Deactivated');
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

    /**
     * Send User Reset Password Link
     */
    public function password_reset_link(Request $request)
    {
        Password::sendResetLink($request->only(['email']));

        return redirect()->back()->with('success', "Activation Link Sent to $request->email. Ask them to check their inbox");
    }
}
