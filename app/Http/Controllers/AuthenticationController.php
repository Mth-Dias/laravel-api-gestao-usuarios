<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $user_exists = User::where('email', $loginRequest['email'])->exists();

        if (!$user_exists)
            return response()->json([
                'message' => 'Não existe usuário com este endereço de email para ser logado!',
            ], 404);

        $user_hashed_password = User::where('email', $loginRequest['email'])->get('password')->pluck('password')->first();

        $password_match = Hash::check($loginRequest['password'], $user_hashed_password);

        if (!$password_match)
            return response()->json([
                'message' => 'Credenciais de login não são válidas, tente novamente com as credenciais corretas!'
            ], 401);

        return response()->json([
            'message' => 'Usuário logado com sucesso!',
            'token' => $this->issueUserToken($loginRequest['email']),
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }

    public function endAllSessions(Request $request)
    {
        $request->user()->tokens()->delete();
    }

    public function sessionDetails(Request $request): PersonalAccessToken
    {
        return $request->user()->currentAccessToken();
    }

    private function issueUserToken(string $email, string $token_name = 'ordinary-token'): NewAccessToken
    {
        $user = User::where('email', $email)->first();

        return $user->createToken($token_name);
    }
}
