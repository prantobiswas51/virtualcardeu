<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function uploadProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        // Store the file in 'public/profile_photos'
        $path = $request->file('profile_photo')->store('profile_photos', 'public');

        // Save to database
        $user = Auth::user();
        $user->profile_photo = $path;
        $user->save();

        return back()->with('success', 'Profile photo updated successfully!');
    }

    public function update_other_info(Request $request){

        $request->validate([
            'paypal_email' => 'nullable|email',
            'mobile_number' => 'nullable|numeric',
            'pin' => 'nullable|required_with:new_pin|numeric',
            'new_pin' => 'nullable|numeric',
        ]);

        $user = Auth::user();
        $user->paypal_email = $request->paypal_email;
        $user->number = $request->mobile_number;
        $user->save();

        // Check if both 'pin' and 'new_pin' are at least 6 digits
        if ($request->filled('pin') && strlen($request->pin) < 6) {
            return redirect()->route('profile.edit')->with('message', 'PIN must be at least 6 digits.');
        }

        if ($request->filled('new_pin') && strlen($request->new_pin) < 6) {
            return redirect()->route('profile.edit')->with('message', 'New PIN must be at least 6 digits.');
        }

         // If the user has a PIN, verify the old PIN before updating
        if (!empty($user->pin) && $request->new_pin) {
            // Check if the entered PIN matches the stored PIN
            if (!Hash::check($request->pin, $user->pin)) {
                return redirect()->route('profile.edit')->with('message', 'Incorrect PIN');
            }
            // Update the PIN if the old PIN is correct
            $user->pin = Hash::make($request->new_pin);
            $user->save();
            return redirect()->route('profile.edit')->with('message', 'New PIN updated!');
        } 

        // If the user does not have a PIN, set a new PIN
        if (empty($user->pin) && $request->pin) {
            $user->pin = Hash::make($request->pin);
            $user->save();
            return redirect()->route('profile.edit')->with('message', 'PIN Set!');
        }


        return redirect()->route('profile.edit')->with('message', 'Info Updated Successfully');

    }


    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
