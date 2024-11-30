<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Interfaces\DTO\UserDTO;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller;

class RegisterController extends Controller
{
    private UserServiceInterface $_userService;
    public function __construct(
        UserServiceInterface $userService
    )
    {
        $this->_userService = $userService;
    }
    public function register(Request $request): JsonResponse
    {
        try {
            $data = $this->validate($request, [
                'first_name' => 'required|string|max:32',
                'last_name' => 'required|string|max:32',
                'email' => 'required|string|email|max:64|unique:users,email',
                'password' => 'required|string|min:8|max:64',
                'phone_number' => 'required|string|regex:/^\+?[0-9]{7,15}$/',
            ]);
            $userDto = new UserDTO($data['first_name'], $data['last_name'], $data['email'], $data['password'], $data['phone_number']);
            $user = $this->_userService->registerUser($userDto);
            return (new UserResource($user))->response()->setStatusCode(Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e){
            return response()->json(['errors' => 'Please contact to the support'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
