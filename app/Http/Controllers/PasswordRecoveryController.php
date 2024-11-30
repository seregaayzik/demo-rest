<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\RestorePasswordServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller;

class PasswordRecoveryController extends Controller
{
    private RestorePasswordServiceInterface $_restorePasswordService;
    public function __construct(
        RestorePasswordServiceInterface $restorePasswordService
    )
    {
        $this->_restorePasswordService = $restorePasswordService;
    }
    public function requestPasswordReset(Request $request): JsonResponse
    {
        try {
            $data = $this->validate($request, [
                'email' => 'required|string|email|exists:users,email',
            ]);
            $token = $this->_restorePasswordService->requestForNewPassword($data['email']);
            Mail::raw($token, function ($message) use ($data) {
                $message->to($data['email'])->subject('Password Reset');
            });
            return response()->json(['message' => 'The token has been sent'], Response::HTTP_OK);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e){
            return response()->json(['errors' => 'Please contact to the support'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function resetPassword(Request $request): JsonResponse
    {
        try {
            $data = $this->validate($request, [
                'token' => 'required|string|exists:password_resets,token',
                'new_password' => 'required|string|min:8|max:64',
            ]);
            $this->_restorePasswordService->setNewPassword($data['token'],$data['new_password']);
            return response()->json(['message' => 'The password has been changed'], Response::HTTP_OK);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e){
            return response()->json(['errors' => 'Please contact to the support'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
