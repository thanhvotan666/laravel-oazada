<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogin(Request $request)
    {

        if (auth()->user()) {
            return redirect(route('index'));
        }
        if (url()->previous() != route('register'))
            $request->session()->put('url.intended', url()->previous());
        return view('customer.login');
    }
    public function checkLogin(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required:min:8'
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('user_id', Auth::user()->id);
            $request->session()->put('user_name', Auth::user()->name);

            return redirect()->to($this->redirectTo());
            //return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to(route('index'));
    }
    public function showRegister(Request $request)
    {
        if (url()->previous() != route('login'))
            $request->session()->put('url.intended', url()->previous());
        return view('customer.register');
    }
    public function checkRegister(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->to($this->redirectTo());
        //return redirect()->intended('/');
    }
    public function resetPassword(Request $request)
    {
        $user =  User::find(Auth::id());
        $request->validate([
            'now_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed', // 'confirmed' yêu cầu có trường new_password_confirmation
        ]);

        if (!Hash::check($request->now_password, $user->password)) {
            return back()->with('error', 'The now password is incorrect.');
        }

        try {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return back()->with('success', 'Password updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update the password. Please try again.');
        }
    }
}
