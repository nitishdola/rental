<?php

namespace App\Http\Controllers\Adminauth;

use App\Admin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;

use App\Unit,App\Renter,App\Bill;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/admin';
    protected $guard = 'admin';
    protected $username = 'username';
    
    public function showDashboard() {
        $units = Unit::count();
        $renters = Renter::count();
        $bills = Bill::count();
        return view('auth.admin.dashboard', compact('units', 'renters', 'bills'));
    }
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check())
        {
            return redirect('/admin');
        }
        return view('auth.admin.login');
    }
    
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }
    
    public function resetPassword()
    {
        return view('admin.auth.passwords.email');
    }
    
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}