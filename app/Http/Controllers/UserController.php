<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        return view('auth.form');
    }
    public function store(Request $request)
    {
        $validator = User::siteStoreValidation($request->all());

        if ($validator->fails()) {
            $response['error'] = $validator->errors();
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
                DB::commit();
            return redirect()->route('auth.handleLogin.view')->with('success', 'You are registered now');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    public function login()
    {
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ]);

        if (Auth::attempt($data)) {
            $user = Auth::user();
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($data['password']);
                $user->save();
            }
            return redirect()->route('post');
        }
        return back()->withErrors([
            'email' => 'You entered your email or password incorrectly.'
        ]);

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.handleLogin.view');

    }

}
