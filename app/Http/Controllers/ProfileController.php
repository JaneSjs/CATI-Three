<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Schema;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = new User();
        $survey = new Schema();

        $data['user']  = $user->find($id);
        $data['roles'] = $user->roles()->get();
        $data['projects'] = $user->projects()->get();
        $data['surveys'] = $user->schemas()->get();
        //dd($data['projects']);
        $data['results'] = $user->results();

        return view('profiles.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = new User();
        $data['user']  = $user->find($id);

        return view('profiles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, string $id)
    {
        $id = $request->input('user_id');
        $user = User::find($id);
        dd($user);

        if ($user)
        {
            if ($request->has(['user_id','gender']))
            {
                //dd($request->input('gender'));
                $userUpdate = $user->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'gender' => $request->input('gender'),
                ]);
                if ($userUpdate) {
                    return back()->with('success', 'Profile Details Updated Successfully');
                } else {
                    return back()->with('error', 'Profile Details Was Not Updated');
                }
            }

            if ($request->has(['user_id','ext_no']))
            {
                $user->update([
                    'ext_no' => $request->input('ext_no'),
                ]);
            }

            if ($request->has(['user_id','national_id']))
            {
                $user->update([
                    'national_id' => $request->input('national_id'),
                ]);
            }

            if ($request->has(['user_id','phone_1']))
            {
                $user->update([
                    'phone_1' => $request->input('phone_1'),
                ]);
            }

            if ($request->has(['user_id','phone_2']))
            {
                $user->update([
                    'phone_2' => $request->input('phone_2'),
                ]);
            }

            if ($request->has(['user_id','first_name']))
            {
                $user->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                ]);
            }   
        }

        return redirect()->back()->with('success', 'Profile Details Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
