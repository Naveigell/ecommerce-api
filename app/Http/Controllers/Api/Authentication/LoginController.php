<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RequestLogin;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\PersonalAccessTokenFactory;

class LoginController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function login(RequestLogin $request)
    {
        $email      = $request->get('email');
        $password   = $request->get('password');

        $user = DB::table("users")->select(["id", "email", "password"])
                                        ->where("email", $email)
                                        ->first();

        if (!is_null($user)) {
            if (Hash::check($password, $user->password)) {
                return json([
                    "email"     => $email,
                    "token"     => app(PersonalAccessTokenFactory::class)->make($user->id, "app")->accessToken
                ]);
            } else {
                return error([
                    "messages"   => ["password" => "Password incorrect"],
                ], 422);
            }
        } else {
            return error([
                "messages"   => "User not found",
            ], 404);
        }
    }
}
