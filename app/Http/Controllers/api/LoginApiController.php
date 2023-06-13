<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast;

class LoginApiController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            
        ]);

        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials))
        {
            return response()->json(['code'=> 401,'msg'=>'Unauthorized']);
        }

        $user = $request->user();
        $token_result = $user->createToken('Personal Token Access');
        $token = $token_result->token;
        $token->expires_at = Carbon::now()->addWeek(1);
        $token->save();

        return response()->json(['data'=>[
            'user'=> Auth::user(),
            'access_token'=> $token_result->accessToken,
            'token_type'=> 'Bearer',
            'expires_at'=> Carbon::parse($token_result->token->expires_at)->toDateTimeString()

        ]]);
    }
}
