<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLoginController extends AuthController
{
    public function __invoke(Request $request): JsonResponse
    {

        // Récupération des identifiants dans la requète
        $credentials = $request->only('email', 'password');

        // Tentative de login

        // Succès
        if (Auth::attempt($credentials)) {

            // Récupération de l'utilisateur
            $user = Auth::user();

            // On révoque les éventuels anciens tokens
            $user->tokens()->delete();

            // Génération d'un nouveau token
            $token = $user->createToken('appToken');

            // Retour de la réponse avec l'utilisateur dans les data ainsi que le nouveau token
            return $this->sendJsonResponse(success: true, message: 'Welcome', data: [
                'user' => $user->toArray(),
            ], statusCode: 200, accessToken: $token->plainTextToken);
        }

        // Erreur, on retourne une réponse json avec le bon statut et un message
        return $this->sendJsonResponse(success: false, message: 'Invalid credentials', statusCode: 400);
    }
}
