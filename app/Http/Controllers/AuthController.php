<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
//        dd($request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|same:re_password',
            'username' => 'required|min:3|max:60|unique:users,username',
            'photo' => 'nullable|mimes:jpg,jpeg,png',
        ], [
            'email' => 'Пользователь с такой почтой уже существует'
        ], [
            'username' => 'Такой пользователь уже существует'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $validated = $validator->validated();

        $validated['password'] = Hash::make($validated['password']);

        if ($request->file('photo')) {
            $validated['image_path'] = $request->file('photo')->store('public/images');
        }

        $user = User::query()->create($validated);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function signIn(SignInRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return back()->withErrors(['Неверный данные']);
        }

        return redirect()->route('home');
    }

    public function logOut()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
