<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\LoginRequest;
use App\Actions\Auth\LoginUser;

class AuthController extends Controller
{
    protected $loginUser;
    public function __construct(
        LoginUser $loginUser
        )
    {
        $this->loginUser = $loginUser;
    }
    
    public function login(LoginRequest $request)
    {
        try {
            
            $token = $this->loginUser->handle($request->validated());
            if($token) {
                return response()->json(['message' => 'Login successful!', 'user' => $token], 200);
            }
            return response()->json(['message' => 'Invalid credentials'], 401);
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
            return response()->json(['status' => 'error', 'message' => 'An error occurred while creating user'], 500);
        }
    }
}
