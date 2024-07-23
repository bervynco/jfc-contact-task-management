<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;

use App\Actions\User\CreateNewUser;
class UserController extends Controller
{
    protected $createNewUser;
    public function __construct(
        CreateNewUser $createNewUser
        )
    {
        $this->createNewUser = $createNewUser;
    }
    
    public function store(CreateUserRequest $request)
    {
        try {
            \Log::debug($request->validated());
            $user = $this->createNewUser->handle($request->validated());
            return response()->json(['status' => 'success', 'message' => "User created Successfully"], 200);
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
            return response()->json(['status' => 'error', 'message' => 'An error occurred while creating user'], 500);
        }
    }
}
