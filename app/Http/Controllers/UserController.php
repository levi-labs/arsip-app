<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : String
    {
        $title      = 'Daftar User';
        $data       = User::all();
        return view('pages.user.index', [
            'title' => $title,
            'data'  => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : String
    {
        $title      = 'Form Tambah User';

        return view('pages.user.tambah', [
            'title' => $title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'username'  => 'required',
            'password'  => ['required', 'confirmed']
        ]);

        try {
            $user           = new User();
            $user->nama     = $request->nama;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);

            $user->save();
            return redirect('daftar-user')->with('success', 'User added successfully...');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $title         = 'Detail User';

        return view('pages.user.detail', ['title' => $title]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title          = 'Form Edit User';
        $user           = User::where('id', $user->id)->first();
        return view('pages.user.edit', [
            'title' => $title,
            'user'  => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'username'  => 'required',
        ]);
        try {
            $user           = User::where('id', $user->id)->first();
            $user->nama     = $request->nama;
            $user->username = $request->username;
            $user->save();

            return redirect('daftar-user')->with('success', 'User added successfully...');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user       = User::where('id', $user->id)->first();
        $user->delete();

        return back()->with('success', 'User deleted successfully...');
    }

    public function editPassword()
    {
        $title      = 'Form Edit Password';

        return view('pages.user.edit_password', ['title' => $title]);

    }

    public  function updatePassword(Request $request)
    {
        $user           = User::where('id', Auth()->user()->id)->first();
        $checkOldPassword    = $user->password;
        $inputOldPassword    = $request->old_password;

        if (Hash::check($inputOldPassword, $checkOldPassword)){
            $user->password = bcrypt($request->password);
            $user->save();

            return back()->with('success', 'Password updated successfully...');
        }else{
            return back()->withErrors(['old_password' => 'You\'r old password has been entered incorrectly' ] );
        }


    }

    public function resetPassword(User $user)
    {

        $user   = User::where('id', $user->id)->first();
        $user->password = bcrypt($user->username);


        return back()->with('success', 'User password changed to ' . $user->username);
    }
}
