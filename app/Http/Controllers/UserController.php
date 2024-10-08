<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
        if (Gate::any(['admin','ceo']) || auth()->user()->id == 1)
        {
            $data['allUsers'] = User::all()->count();

            $data['users'] = User::paginate(20);
        }
        elseif (Gate::any(['dpo']))
        {
            $data['allUsers'] = User::all()->count();

            $rolesToFilter = ['Head','Manager','Finance','Scripter','Coordinator','Supervisor','QC','Client','Interviewer','Respondent'];

            $data['users'] = User::where(function ($query) use ($rolesToFilter)
            {
                $query->whereHas('roles', function ($subQuery) use ($rolesToFilter)
                {
                    $subQuery->whereIn('name', $rolesToFilter);
                })
                ->orwhereDoesntHave('roles');
            })->paginate(20);
        }
        else
        {
            //dd(auth()->user()->roles);
            return back()->with('error', 'Authorization Error');    
        }

        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('admin') || auth()->user()->id == 1){
            $data['roles'] = Role::all();
            //dd('Admin');
        }
        elseif (Gate::allows('head'))
        {
            //dd('Head');
            $data['roles'] = Role::where('name', 'Interviewer')
                                ->orwhere('name', 'Client')
                                ->orwhere('name', 'Manager')
                                ->orwhere('name', 'Head')
                                ->orwhere('name', 'Coordinator')
                                ->orderBy('name')
                                ->get();
        }
        elseif (Gate::allows('manager'))
        {
            //dd('Manager');
            $data['roles'] = Role::where('name', 'Interviewer')
                                ->orwhere('name', 'Client')
                                ->orwhere('name', 'Supervisor')
                                ->orwhere('name', 'Scripter')
                                ->orwhere('name', 'Coordinator')
                                ->orwhere('name', 'QC')
                                ->get();

            //dd($data);
        }
        else
        {

            $data['roles'] = Role::where('name', 'Interviewer')
                                ->orderBy('name')
                                ->get();
        }

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
            //Password::sendResetLink($request->only(['email']));
            
            if (true) {
                return redirect(route('users.create'))->with('success', "User is now registered. (buzz-word) is their default password - without brackets.");
            } else {
                return redirect('users/create')->with('error', " User has been registered. But the system has not been able to Successfully email them their login instructions. They can meanwhile use 'buzz-word' as their temporary password");
            }
            
        } else {
            return redirect(route('users.create'))->with('error', ' User registration has failed.');
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

        if (Gate::allows('admin') || auth()->user()->id == 1)
        {
            $data['roles'] = Role::all();
        }
        elseif (Gate::any(['head','dpo']))
        {
            $data['roles'] = Role::where('name', 'Interviewer')
                                ->orwhere('name', 'Client')
                                ->orwhere('name', 'QC')
                                ->orwhere('name', 'Supervisor')
                                ->orwhere('name', 'Manager')
                                ->orwhere('name', 'Scripter')
                                ->orwhere('name', 'Coordinator')
                                ->orderBy('name')
                                ->get();
        }
        else
        {

            $data['roles'] = Role::where('name', 'Interviewer')
                                ->orderBy('name')
                                ->get();
        }

        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
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
     * API Login
     */
    public function api_login(Request $request)
    {
        // validator(request()->all(), [
        //     'email'    => ['required', 'email'],
        //     'password' => ['required']
        // ])->validate();

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', request('email'))->first();

        if (Hash::check(request('password'), $user->getAuthPassword())) {
            $token =  $user->createToken(time())->plainTextToken;

            return response($token, 200);
        } else {
            return response([
                'message' => 'Bad Login Credentials'
            ], 401);
        }
    }

    /**
     * API Logout
     */
    public function api_logout()
    {
        auth()->user()->tokens()
                    ->delete();
    }

    /**
     * Send User Reset Password Link
     */
    public function password_reset_link(Request $request)
    {
        Password::sendResetLink($request->only(['email']));

        return redirect()->back()->with('success', "Activation Link Sent to $request->email. Ask them to check their inbox");
    }

    

    /**
     * Return users who have the Client role.
     */
    public function clients()
    {
        $rolesToFilter = ['Client'];

        $data['clients'] = User::where(function ($query) use ($rolesToFilter)
        {
            $query->whereHas('roles', function ($subQuery) use ($rolesToFilter)
            {
                $subQuery->whereIn('name', $rolesToFilter);
            });
        })->paginate(10);

        return view('users.clients', $data);
    }

    /**
     * Return users who have the Interviewer role.
     */
    public function interviewers()
    {
        $rolesToFilter = ['Interviewer'];

        $data['interviewers'] = User::where(function ($query) use ($rolesToFilter)
        {
            $query->whereHas('roles', function ($subQuery) use ($rolesToFilter)
            {
                $subQuery->whereIn('name', $rolesToFilter);
            });
        })->paginate(10);

        $data['total_interviewers'] = count($data['interviewers']);

        return view('users.interviewers', $data);
    }

    /**
     * Reset Extention No
    */
    public function resetExtenNo(Request $request)
    {
        //dd('Here');
        if ($request->has(['user_id']))
        {
            $user_id = $request->input('user_id');

            $user = User::find($user_id);

            $user->update([
                'ext_no' => null,
            ]);

            return back()->with('success', 'Extention Number Has Been Reset Successfully');
        }
    }


    /**
     * Search System Users
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (Gate::allows('admin') || auth()->user()->id == 1){
            $allUsers = User::all();
            $data['allUsers'] = count($allUsers);
            
            $data['users'] = User::search($query)->paginate(10);
        }
        elseif (Gate::allows('head')) {
            $data['users'] = User::search($query)->paginate(10);
        }
        else
        {
            $role = Role::where('name', 'Interviewer')
                           ->find(auth()->id());

            //$data['users'] = User::search($query)->get();

            $data['users'] = User::search($query)->paginate(10);
        }

        return view('users.index', $data);
    }
}
