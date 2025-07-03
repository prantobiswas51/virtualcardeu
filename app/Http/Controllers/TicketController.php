<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->latest()->get();
        return view('support.index', compact('tickets'));
    }

    // store ticket
    public function create_ticket(Request $request)
    {
        $request->validate([
            'number'  => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Store ticket
        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'number'  => $request->number,
            'subject' => $request->subject,
            'status' => "Open"
        ]);

        $ticket->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return back()->with('success', 'Support ticket submitted successfully.');
    }

    // Show single ticket with messages
   public function show_ticket($id)
{
    $ticket = Ticket::with('messages')->findOrFail($id);

    if (auth()->id() !== $ticket->user_id && !auth()->user()->is_admin) {
        abort(403, 'You are not authorized to view this ticket.');
    }

    return view('support.show', compact('ticket'));
}



    public function ticket_reply(Request $request, Ticket $ticket)
    {
        $ticket->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return back();
    }
}
