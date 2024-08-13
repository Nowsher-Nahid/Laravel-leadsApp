<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['nullable', 'string', 'max:20'],  // Adjust validation as needed
            'company_name' => ['nullable', 'string', 'max:255'],
            'company_vat' => ['nullable', 'string', 'max:50'],  // Adjust validation as needed
            'profile_picture' => ['nullable', 'image', 'max:2048'],  // Limit to 2MB, adjust as needed
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePictureName = time().'_'.$profilePicture->getClientOriginalName();
            $profilePicture->move(public_path('assets/images/profile-pictures'), $profilePictureName);
            $profilePicturePath = 'assets/images/profile-pictures/' . $profilePictureName;
        } else {
            $profilePicturePath = null;
        }

        $user = User::create([
            // 'name' => $request->name,
            // 'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_name' => $request->company_name,
            'company_vat' => $request->company_vat,
            'profile_picture' => $profilePicturePath,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('lead.index', absolute: false));
    }
}
