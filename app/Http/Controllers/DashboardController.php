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

    public function notifications()
    {
        return view('notifications');
    }

    public function activity()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();
        return view('activity', compact('transactions'));
    }

    public function cards()
    {
        $myCards = Card::where('user_id', Auth::id())->get();
        $available_cards = Card::whereNull('user_id')
        ->where('status', 'Inactive')
        ->selectRaw('type, company, amount, COUNT(*) as total') // Use COUNT to aggregate
        ->groupBy('type', 'company', 'amount')
        ->get();
        return view('mycards', compact('myCards', 'available_cards'));
    }

    public function order_cards(){
        return view('new_card');
    }

    public function banks()
    {
        return view('mybanks');
    }

    public function order_banks(){
        return view('new_bank');
    }

    public function settings()
    {
        return view('settings');
    }
    

}
