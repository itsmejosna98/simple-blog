<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register()
    {
        return view('user.register');
    }

    public function registerSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ],
        [
            'name.required'        => 'Name required',
            'email.required'        => 'Email address required',
            'email.email'           => 'Invalid email address',
            'email.unique'          => 'Email address is already in use',
            'password.required'             => 'Password required',
            'confirm_password.required'      => 'Confirm password required',
            'confirm_password.same'          => 'Passwords do not match',
        ]
    );

        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator)->withInput();

        } else {
            $user_registration = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return redirect('login');
        }
    }

    public function index()
    {
        return view('user.login');
    }

    public function loginCheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->withErrors(['message' => 'Invalid credentials'])->withInput();
            }
        }
    }

    public function dashboard()
    {
        if (Auth::check()) {
            $totalCustomers = Customer::count();
            $totalOrders  = Order::count();
            return view('admin.dashboard',compact('totalCustomers','totalOrders'));
        } else {
            return redirect()->route('login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
