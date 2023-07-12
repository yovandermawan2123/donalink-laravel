<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', 2)->get();
       
        return view('backend.user.index', [
            'users' => $users,
          
        ]);
    }

    public function create()
    {
        $roles = Role::get();
        return view('backend.user.create', [
            // 'campaigns' => $campaigns
            'roles' => $roles,
        ]);
    }
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $roles = Role::get();
        return view('backend.user.edit', [
            // 'campaigns' => $campaigns
            'roles' => $roles,
            'user' => $user,
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:users',
            'email' => 'required|max:255|unique:users',
            'role_id' => 'required',
            'password' => 'required',
            'mobile' => 'required',
        ]);


        $validatedData['images'] = 'default_image.png';



        User::create($validatedData);

        return redirect('/users')->with('success', 'User has been Added!');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'role_id' => 'required',
            // 'password' => 'required',
            'mobile' => 'required',
        ]);

        $user = User::find($id);




        $user->update($validatedData);
        // Campaign::create($validatedData);

        return redirect('/users')->with('success', 'User has been Edited!');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect('/users')->with('success', 'User has been deleted!');
    }

    
}
