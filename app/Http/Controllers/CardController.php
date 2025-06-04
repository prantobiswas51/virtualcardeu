<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Setting;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function requestCard(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $user = Auth::user();
        $settings = Setting::first();

        // Check if the user has sufficient balance
        if ($user->balance < ($request->amount + $settings->card_issuance_fee)) {
            return redirect()->route('order_cards')->with('message', 'Not enough balance, Please deposit.');
        }

        try {
            DB::beginTransaction();
            // Find an available card, locking it to prevent race conditions
            $card = Card::where('user_id', null)
            ->where('status', 'Inactive')
            ->where('type', $request->type)
            ->where('amount', $request->amount)
            ->lockForUpdate()
            ->first();

            if (!$card) {
                DB::rollBack();
                return redirect()->route('order_cards')->with('message', 'No card found, try another or please contact admin.');
            }

            // Deduct balance and assign the card
            $user->decrement('balance', ($request->amount + $settings->card_issuance_fee));
            
            $card->update([
                'user_id' => $user->id,
                'status' => 'Active',
                'registered_at' => Carbon::now()
            ]);

            DB::commit();
            return redirect()->route('cards')->with('message', 'Card generated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cards')->with('message', 'Something went wrong. Please try again.');
        }
    }

    public function cards()
    {
        $transactions = Transaction::where('payment_method','Card')->get();
        $myCards = Card::where('user_id', Auth::id())->get();
        return view('mycards', compact('myCards', 'transactions'));
    }

    public function order_cards(){
        $available_cards = Card::whereNull('user_id')
        ->where('status', 'Inactive')
        ->selectRaw('type, amount, COUNT(*) as total') // Use COUNT to aggregate
        ->groupBy('type', 'amount')
        ->get();
        $settings = Setting::first();

        return view('new_card', compact('available_cards', 'settings'));
    }
}
