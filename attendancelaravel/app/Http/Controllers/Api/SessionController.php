<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function getSessionData()
    {
        $userName = session('name', 'Guest'); 
        $userDesig = session('designations', 'User'); 

        return response()->json([
            'userName' => $userName,
            'userDesig' => $userDesig,
        ]);
    }
}
