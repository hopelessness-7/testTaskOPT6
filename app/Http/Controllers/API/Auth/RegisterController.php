<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends MainController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'conf_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors(), 423);
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $dataUser = [
            'user' => $user,
            'token' => [
                'value' => $user->createToken('MyApp')->plainTextToken,
                'type' => 'Api token Bearer'
            ]
        ];

        return $this->sendResponse($dataUser);
    }
}
