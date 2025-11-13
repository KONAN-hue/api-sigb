<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Authentifie l'utilisateur et retourne un token JWT.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'motDePasse' => 'required|string'
        ]);

        // Renommer la clé pour correspondre à 'password' attendu par Auth::attempt
        $credentials['password'] = $credentials['motDePasse'];
        unset($credentials['motDePasse']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Identifiants invalides.',
                'data' => null
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Connexion réussie.',
            'data' => [
                'user' => Auth::user(),
                'token' => $token
            ]
        ], 200);
    }

    /**
     * Déconnecte l'utilisateur (invalide le token).
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Déconnexion réussie.',
            'data' => null
        ], 200);
    }
    /**
     * Inscrit un nouvel utilisateur.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'role' => 'required|string',
            'motDePasse' => 'required|string|min:6',
            'status' => 'string'
        ]);

        // Hash du mot de passe
        $validated['motDePasse'] = bcrypt($validated['motDePasse']);

        // ✅ Création de l'utilisateur
        $user = Utilisateur::create($validated);

        // ✅ Générer un token JWT
        $token = auth()->login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Compte créé avec succès.',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 201);
    }

}
