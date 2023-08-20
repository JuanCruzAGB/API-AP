<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * * The Controller Model.
     * @var User
     */
    protected $model = User::class;

    /**
     * * Sign the User in.
     * @param Request $request
     * @return JsonResponse
     */
    function in(Request $request): JsonResponse
    {
        $input = (object) $request->all();
        return response()
            ->json((array) $input);

        $request->validate($this->model::$validation['sign']['in']['rules'], $this->model::$validation['sign']['in']['messages'][config('app.locale')]);

        if (!Auth::attempt([
            'email' => $input->email,
            'password' => $input->password,
        ], true)) {
            return response()
                ->json([
                    'code' => 404,
                    'message' => 'Correo y/o contraseña incorrectos.',
                ]);
        }

        return response()
            ->json([
                'code' => 200,
                'message' => 'Sesión iniciada.',
            ]);
    }

    /**
     * * Sign the User out.
     * @return JsonResponse
     */
    function out(): JsonResponse
    {
        Auth::logout();

        return response()
            ->json([
                'code' => 200,
                'message' => 'Sesión cerrada.',
            ]);
    }
}