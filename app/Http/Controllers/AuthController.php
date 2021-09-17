<?php
    namespace App\Http\Controllers;

    use App\Models\Auth;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class AuthController extends Controller{
        /**
         * * Control the "log in" page.
         * @return [type]
         */
        function showLogin () {
            if (Auth::check()) {
                return redirect("/panel");
            } else {
                return view("auth.login", [
                    // ? Return variables.
                ]);
            }
        }

        /**
         * * Executes the "log in".
         * @param Request $request
         * @return [type]
         */
        function doLogin (Request $request) {
            $input = (object) $request->all();

            $validator = Validator::make($request->all(), Auth::$validation["login"]["rules"], Auth::$validation["login"]["messages"]["es"]);

            if ($validator->fails()) {
                return redirect("/iniciar-sesion")->withErrors($validator)->withInput();
            }

            if (!Auth::attempt([
                "email" => $input->email,
                "password" => $input->password,
            ], true)) {
                return redirect("/iniciar-sesion")->withInput()->with("status", [
                    "code" => 401,
                    "message" => "Correo y/o contraseña incorrectos.",
                ]);
            }

            return redirect("/panel");
        }

        /**
         * * Executes the "log out".
         * @return [type]
         */
        function doLogout () {
            Auth::logout();

            return redirect()->route("web.home")->with("status", [
                "code" => 200,
                "message" => "Sesión Cerrada.",
            ]);
        }
    }