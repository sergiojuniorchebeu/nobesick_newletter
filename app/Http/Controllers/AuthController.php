<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    // Affiche le formulaire d'inscription
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Traite l'inscription
    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:6|confirmed',
        ]);

        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } catch (QueryException $e) {
            // gère une erreur éventuelle de base de données
            return back()
                ->withInput()
                ->withErrors(['register' => 'Une erreur est survenue, veuillez réessayer.']);
        }

        Auth::login($user);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Inscription réussie ! Bienvenue.');
    }

    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view('welcome'); // ou votre blade avec modal login
    }

    // Traite la connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()
                ->intended(route('dashboard'))
                ->with('success', 'Connexion réussie !');
        }

        return back()
            ->withInput()
            ->withErrors(['email' => 'Email ou mot de passe invalide.']);
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'Vous êtes déconnecté.');
    }

    // Affiche un dashboard basique pour l’admin
    public function dashboard()
    {
        // par exemple : $users = User::all();
        return view('dashboard' /*, compact('users')*/);
    }
}
