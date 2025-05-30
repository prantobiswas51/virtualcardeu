<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{

    public function index(){
        // $transactions = Transaction::paginate(3);
        $transactions = Transaction::where('user_id', Auth::id())->paginate(3);
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

    public function notifications()
    {
        return view('notifications');
    }

    public function activity()
    {
        $transactions = Transaction::paginate(3);
        // $transactions = Transaction::where('user_id', Auth::id())->get();
        return view('activity', compact('transactions'));
    }


    public function settings()
    {
        return view('settings');
    }
    

}
