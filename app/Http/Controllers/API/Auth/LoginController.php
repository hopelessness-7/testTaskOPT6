<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController extends MainController
{
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $user['token'] =  $user->createToken('MyApp')->plainTextToken;

            return $this->sendResponse($user);
        }
        else{
            return $this->sendError(['error'=>'Unauthorised'], 403, 'Unauthorised.');
        }
    }
}
