<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Cookie;
class AuthController extends Controller
{
      use AuthenticatesUsers;

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $cookie = Cookie::forget('_token');
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out'
        ])->withCookie($cookie);
    }
}
