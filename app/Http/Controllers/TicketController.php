<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        return view('support');
    }

    public function create_ticket(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'number'  => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Store ticket
        Ticket::create([
            'user_id' => Auth::id(),
            'email'   => $request->email,
            'number'  => $request->number,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Support ticket submitted successfully.');
    }
}
