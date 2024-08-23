<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\EmailSettings;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {

    public function edit(Request $request): View{
        $user = Auth::user();
        $email_settings = $user->emailSettings;
        return view('profile', [
            'user' => $request->user(),
            'email_settings' => $email_settings,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function update(Request $request) {
        // Validate the form data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
            'phone' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'company_vat' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePictureName = time() . '_' . $profilePicture->getClientOriginalName();
            $profilePicture->move(public_path('assets/images/profile-pictures'), $profilePictureName);
            $profilePicturePath = 'assets/images/profile-pictures/' . $profilePictureName;
            $request->user()->profile_picture = $profilePicturePath;
        }

        $request->user()->first_name = $request->first_name;
        $request->user()->last_name = $request->last_name;
        $request->user()->email = $request->email;
        $request->user()->phone = $request->phone;
        $request->user()->company_name = $request->company_name;
        $request->user()->company_vat = $request->company_vat;

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        return redirect()->back()->with('success', __('messages.data_updated'));
    }

    public function updatePassword(Request $request){
        // Validate the input
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect with success message
        return redirect()->back()->with('success', __('messages.data_updated'));
    }

    public function updateEmailSettings(Request $request, string $id){
        $request->validate([
            'job_type' => 'nullable|array',
            'budget' => 'nullable|array',
        ]);

        $data = $request->only(['job_type', 'budget']);
        $data['job_type'] = json_encode($data['job_type'], JSON_UNESCAPED_UNICODE);
        $data['budget'] = json_encode($data['budget'], JSON_UNESCAPED_UNICODE);

        $email_settings = EmailSettings::where('user_id', $id)->first();

        if ($email_settings) {
            // Update existing EmailSettings
            $email_settings->update($data);
        } else {
            // Create a new EmailSettings record
            $email_settings = new EmailSettings([
                'user_id' => $id,
                'job_type' => $data['job_type'],
                'budget' => $data['budget'],
            ]);
            $email_settings->save();
        }

        return redirect()->back()->with('success', __('messages.data_updated'));
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse{
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
