<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * * The Controller Model.
     * @var User
     */
    protected $model = User::class;

    /**
     * * Check if the User can log in.
     * @param Request $request
     * @return JsonResponse
     */
    function check(Request $request): JsonResponse
    {
        $input = (object) $request->all();

        $request->validate($this->model::$validation['login']['rules'], $this->model::$validation['login']['messages'][config('app.locale')]);

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
                'message' => 'El usuario está autenticado correctamente.',
            ]);
    }

    /**
     * * Log the User in.
     * @param Request $request
     * @return JsonResponse
     */
    function login(Request $request): JsonResponse
    {
        $input = (object) $request->all();

        $request->validate($this->model::$validation['login']['rules'], $this->model::$validation['login']['messages'][config('app.locale')]);

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
     * * Log the User out.
     * @return JsonResponse
     */
    function logout(): JsonResponse
    {
        Auth::logout();

        return response()
            ->json([
                'code' => 200,
                'message' => 'Sesión cerrada.',
            ]);
    }
}