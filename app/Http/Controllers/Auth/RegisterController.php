<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->intended();
        }

        $clientRole = Role::where('slug', UserRole::Client->value)->first();

        return view('auth.register', compact('clientRole'));
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $role = Role::where('slug', UserRole::Client->value)->first();

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role_id' => $role->id,
            'is_active' => true,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('client.dashboard'))
            ->with('success', 'Welcome to NishaLawyer! Your account has been created successfully.');
    }
}