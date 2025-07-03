<?php

namespace App\Livewire\Tickets;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $tickets;
    public $selectedTicket;
    public $message = '';

    public function mount()
    {
        $this->tickets = Ticket::latest()->get();
        $this->selectedTicket = $this->tickets->first(); // default selection
    }

    public function selectTicket($ticketId)
    {
        $this->selectedTicket = Ticket::with('messages.user')->find($ticketId);
    }

    public function sendMessage()
    {
        $this->validate(['message' => 'required|string|max:1000']);

        TicketMessage::create([
            'ticket_id' => $this->selectedTicket->id,
            'user_id' => Auth::id(),
            'message' => $this->message,
        ]);

        $this->message = '';
        $this->selectedTicket = $this->selectedTicket->fresh('messages.user');
    }

    public function render()
    {
        return view('livewire.tickets.index');
    }
}
