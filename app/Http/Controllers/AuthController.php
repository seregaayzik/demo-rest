<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller;

class AuthController extends Controller
{
    public function signIn(Request $request): JsonResponse
    {
        try {
            $data = $this->validate($request, [
                'email' => 'required|string|email',
                'password' => 'required|string|min:8|max:64',
            ]);
            if (! $token = Auth::setTTL(7200)->attempt($data)) {
                return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }
            return response()->json([
                'bearer_token' => $token,
                'expires_in' => Auth::factory()->getTTL()
            ], Response::HTTP_OK);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e){
            return response()->json(['errors' => 'Please contact to the support'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
