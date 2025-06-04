<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{

    public function banks()
    {
        $transactions = Transaction::where('payment_method', 'Bank')->get();
        $my_banks = Bank::where('user_id', Auth::id())->get();
        return view('mybanks', compact('my_banks', 'transactions'));
    }

    public function order_banks()
    {
        $available_banks = Bank::where('status', 'Inactive')->get()->groupBy([
            fn($bank) => $bank->account_type,
            fn($bank) => $bank->currency
        ]);

        $settings = Setting::first();

        return view('new_bank', [
            'available_banks' => $available_banks,
            'available_banks_json' => $available_banks->toJson(), // for JS
            'settings' => $settings // if needed
        ]);
    }

    public function request_bank(Request $request)
    {
        $request->validate([
            'bank_id' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $bank = Bank::findOrFail($request->bank_id);

            $user = Auth::user();
            $settings = Setting::first();

            $total_fee = $settings->bank_setup_fee + $settings->bank_maintenance_fee;

            if ($user->balance < $total_fee) {
                DB::rollBack();
                return redirect()->route('order_banks')->with('message', 'Not enough balance, Please deposit.');
            }

            // Update bank assignment
            $bank->update([
                'user_id' => $user->id,
                'status' => 'Active'
            ]);

            // Deduct fee
            $user->balance -= $total_fee;
            $user->save();

            DB::commit();

            return redirect()->route('banks')->with('message', 'Bank account successfully assigned.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Something went wrong. Please try again.');
        }
    }

    public function show($id)
    {
        $bank = Bank::find($id);

        if (!$bank) {
            return response()->json(['message' => 'Bank not found'], 404);
        }
        return response()->json($bank);
    }

    public function transfer_bank_balance(Request $request)
    {

        $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'bank_balance' => 'required|numeric|min:0',
        ]);

        // 2. Find the bank by its ID
        $bank = Bank::findOrFail($request->bank_id);
        $transaction = new Transaction();

        // 3. Update the bank's balance
        $transaction->user_id = Auth::id();
        $transaction->bank_id = $request->bank_id;
        $transaction->payment_method = "Bank";
        $transaction->amount = $request->bank_balance;
        $transaction->status = "Pending";
        $transaction->type = "Incoming";
        $transaction->save();

        // 4. Return a success response
        return redirect()->back()->with('message', 'Transfer requested, please wait for approval!');
    }
}
