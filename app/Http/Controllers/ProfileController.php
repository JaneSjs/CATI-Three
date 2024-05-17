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
        $id = $request->input('userId');
        $user = User::find($id);
        //dd($request);

        if ($user)
        {
            if ($request->has(['userId','gender']))
            {
                //dd($request->input('gender'));
                $userUpdate = $user->update([
                    'first_name' => $request->input('firstName'),
                    'last_name' => $request->input('lastName'),
                    'gender' => $request->input('gender'),
                ]);
                if ($userUpdate) {
                    return back()->with('success', 'Profile Details Updated Successfully');
                } else {
                    return back()->with('error', 'Profile Details Was Not Updated');
                }
            }

            if ($request->has(['userId','extNo']))
            {
                $user->update([
                    'ext_no' => $request->input('extNo'),
                ]);
            }

            if ($request->has(['userId','phone1']))
            {
                $user->update([
                    'phone_1' => $request->input('phone1'),
                ]);
            }

            if ($request->has(['userId','phone2']))
            {
                $user->update([
                    'phone_2' => $request->input('phone2'),
                ]);
            }

            if ($request->has(['userId','firstName']))
            {
                $user->update([
                    'first_name' => $request->input('firstName'),
                    'last_name' => $request->input('lastName'),
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
