<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche la vue de connexion.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Gère la connexion.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentifie l'utilisateur
        $request->authenticate();

        // Régénère la session pour sécurité
        $request->session()->regenerate();

        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // 🔒 Vérifie si le compte est bloqué avant de continuer
        if ($user->is_blocked) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Votre compte a été bloqué par l’administrateur.',
            ]);
        }

        // ✅ Redirection selon le rôle
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    /**
     * Déconnexion.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
