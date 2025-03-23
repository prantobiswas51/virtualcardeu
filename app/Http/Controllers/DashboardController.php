<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{

    public function index(){
        $transactions = Transaction::where('user_id', Auth::id())->get();
        return view('dashboard', compact('transactions'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function support()
    {
        return view('support');
    }

    public function cards()
    {
        return view('mycards');
    }

    public function banks()
    {
        return view('mybanks');
    }

    public function settings()
    {
        return view('settings');
    }
    

}
