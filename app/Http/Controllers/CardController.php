<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Card;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function requestCard(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'amount' => 'nullable|numeric',
        ]);

        $user = Auth::user();
        $settings = Setting::first();
        $fee = $settings->card_issuance_fee;

        try {
            DB::beginTransaction();

            if ($request->type === 'Reloadable Visa Card') {
                $card = Card::where('user_id', null)
                    ->where('status', 'Inactive')
                    ->where('type', $request->type)
                    ->lockForUpdate()
                    ->first();

                if (!$card) {
                    DB::rollBack();
                    return redirect()->route('order_cards')->with('alert', 'No reloadable card available. Please contact support.');
                }

                if ($user->balance < $fee) {
                    DB::rollBack();
                    return redirect()->route('order_cards')->with('alert', 'Not enough balance for card issuance fee.');
                }

                $user->decrement('balance', $fee);

                $card->update([
                    'user_id' => $user->id,
                    'status' => 'Active',
                    'registered_at' => Carbon::now()
                ]);
            } elseif ($request->type === 'Temporary Card') {
                if (!$request->amount || $request->amount <= 0) {
                    return redirect()->route('order_cards')->with('alert', 'Amount is required for temporary cards.');
                }

                $card = Card::where('user_id', null)
                    ->where('status', 'Inactive')
                    ->where('type', $request->type)
                    ->where('amount', $request->amount)
                    ->lockForUpdate()
                    ->first();

                if (!$card) {
                    DB::rollBack();
                    return redirect()->route('order_cards')->with('alert', 'No temporary card found for that amount.');
                }

                $total = $request->amount + $fee;

                if ($user->balance < $total) {
                    DB::rollBack();
                    return redirect()->route('order_cards')->with('alert', 'Not enough balance for card and fee.');
                }

                $user->decrement('balance', $total);

                $card->update([
                    'user_id' => $user->id,
                    'status' => 'Active',
                    'registered_at' => Carbon::now()
                ]);
            } else {
                DB::rollBack();
                return redirect()->route('order_cards')->with('alert', 'Invalid card type.');
            }

            DB::commit();

            Notification::create([
                'user_id' => $user->id,
                'content' => "Card ending with " . substr($card->number, -4) . " assigned successfully.",
            ]);

            return redirect()->route('cards')->with('message', 'Card generated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('order_cards')->with('alert', 'Something went wrong. Please try again.');
        }
    }

    public function cards()
    {
        $transactions = Transaction::where('payment_method', 'Card')->where('user_id', Auth::id())->get();
        $myCards = Card::where('user_id', Auth::id())->where('status', 'Active')->get();

        $user = Auth::user();

        if (!$user->card) {
            return redirect()->route('order_cards');
        }

        return view('mycards', compact('myCards', 'transactions'));
    }

    public function order_cards()
    {
        $available_cards = Card::whereNull('user_id')
            ->where('status', 'Inactive')
            ->selectRaw('type, amount, COUNT(*) as total') // Use COUNT to aggregate
            ->groupBy('type', 'amount')
            ->get();
        $settings = Setting::first();

        return view('new_card', compact('available_cards', 'settings'));
    }

    public function transactions($cardId)
    {
        $transactions = Transaction::where('card_id', $cardId)->get();

        return response()->json($transactions);
    }

    public function card_topup(Request $request)
    {

        // Validate request
        $request->validate([
            'topup_amount' => 'required|numeric|min:1',
            'card_id' => 'required|exists:cards,id', // assuming card_id is submitted
        ]);

        $user = Auth::user();

        // Check if user has enough balance
        if ($user->balance < $request->topup_amount) {
            return redirect()->back()->with('alert', 'Not enough balance');
        }

        // Create transaction
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->card_id = $request->card_id;
        $transaction->payment_method = 'Card';
        $transaction->merchant = 'MasterCard';
        $transaction->amount = $request->topup_amount;
        $transaction->status = 'Pending';
        $transaction->type = 'Topup';
        $transaction->save();

        return redirect()->back()->with('message', 'Top-up Requested, Please wait for approval.');
    }

    public function delete_card(Card $card)
    {

        $card->status = 'Deleted';
        $card->save();

        return response()->json([
            'success' => true,
            'message' => 'Card deleted Successfully.',
        ]);
    }
}
