<?php

namespace App\Filament\Pages;

use App\Models\TicketMessage;
use Filament\Pages\Page;
use Illuminate\Contracts\View\View;

class Ticket extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right'; // Icon for the sidebar
    protected static ?string $navigationGroup = 'Tickets';
    protected static ?string $navigationLabel = 'Ticket Chat';

    protected static string $view = 'filament.pages.ticket'; // Path to the view

    public $tickets;

    // Fetch data when the page is mounted
    public function mount()
    {
        // Fetch all tickets with their messages and user relationships
        $this->tickets = \App\Models\Ticket::with(['user', 'messages.user'])->get(); // Eager loading related data
    }
}
