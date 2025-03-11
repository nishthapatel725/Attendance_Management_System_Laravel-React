<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;

class PassportController extends Controller
{
    public function login(Request $request)
    {
        $formData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];
  
        $formData['password'] = bcrypt($request->password);
  
        $user = User::create($formData);        
  
        return response()->json([ 
            'user' => $user, 
            'token' => $user->createToken('passportToken')->accessToken
        ], 200);     
    }

}
