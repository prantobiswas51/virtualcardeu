<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\Notification;
use Illuminate\Http\Request;
use function Pest\Laravel\get;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{

    public function index()
    {
        // $transactions = Transaction::paginate(3);
        $transactions = Transaction::where('user_id', Auth::id())->paginate(5);
        $last_notification = Notification::where('user_id', Auth::id())->latest()->first();
        return view('dashboard', compact('transactions', 'last_notification'));
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
        $notifications = Notification::where('user_id', Auth::id())->latest()->get();
        return view('notifications', compact('notifications'));
    }

    public function activity(Request $request)
    {
        $query = Transaction::query()->where('user_id', Auth::id());

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            switch ($request->date) {
                case 'last7':
                    $query->where('created_at', '>=', now()->subDays(7));
                    break;
                case 'last30':
                    $query->where('created_at', '>=', now()->subDays(30));
                    break;
                case 'last90':
                    $query->where('created_at', '>=', now()->subDays(90));
                    break;
            }
        }

        $transactions = $query->latest()->paginate(10);

        return view('activity', compact('transactions'));
    }



    public function settings()
    {
        return view('settings');
    }


    public function mark_all_asRead(Request $request)
    {
        try {
            // Find all unread notifications for the authenticated user and update them
            Notification::where('user_id', Auth::id())
                ->where('read', false) // Only mark unread ones
                ->update(['read' => true]);

            return response()->json(['success' => true, 'message' => 'All notifications marked as read.']);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error marking notifications as read: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Failed to mark notifications as read.'], 500);
        }
    }
}
