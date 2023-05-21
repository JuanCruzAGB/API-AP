<?php
    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use Auth;
    use Illuminate\Http\Request;

    class LoginController extends Controller {
    /**
     * * The Controller Model.
     * @var \App\Models\Auth
     */
    protected $model = \App\Models\User::class;

    /**
     * * Check if the User can log in.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    function check (Request $request) {
      $input = (object) $request->all();

      $request->validate($this->model::$validation['login']['rules'], $this->model::$validation['login']['messages'][config('app.locale')]);

      if (!Auth::attempt([
        'email' => $input->email,
        'password' => $input->password,
      ], true))
        return response()
          ->json([
            'code' => 404,
            'message' => 'Correo y/o contraseña incorrectos.',
          ]);

      return response()
        ->json([
          'code' => 200,
          'message' => 'El usuario está autenticado correctamente.',
        ]);
    }

    /**
     * * Log the User in.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    function login (Request $request) {
      $input = (object) $request->all();

      $request->validate($this->model::$validation['login']['rules'], $this->model::$validation['login']['messages'][config('app.locale')]);

      if (!Auth::attempt([
        'email' => $input->email,
        'password' => $input->password,
      ], true))
        return response()
          ->json([
            'code' => 404,
            'message' => 'Correo y/o contraseña incorrectos.',
          ]);

      return response()
        ->json([
          'code' => 200,
          'message' => 'Sesión iniciada.',
        ]);
    }

    /**
     * * Log the User out.
     * @return \Illuminate\Http\Response
     */
    function logout () {
      Auth::logout();

      return response()
        ->json([
          'code' => 200,
          'message' => 'Sesión cerrada.',
        ]);
    }
  }