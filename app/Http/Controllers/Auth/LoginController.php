<?php
  namespace App\Http\Controllers\Auth;

  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Validator;

  class AuthController extends Controller {
    /**
     * * The Controller Model.
     * @var \App\Models\Auth
     */
    protected $model = \App\Models\Auth::class;

    /**
     * * Control the "log in" page.
     * @return \Illuminate\Http\Response
     */
    function showLogin () {
      if ($this->model::check())
        return redirect()
          ->route('panel');

      else
        return view('auth', [
          // ? Return variables.
        ]);
    }

    /**
     * * Executes the "log in".
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    function doLogin (Request $request) {
      $input = (object) $request->all();

      $request->validate($this->model::$validation['login']['rules'], $this->model::$validation['login']['messages'][$this->lang]);

      if (!$this->model::attempt([
        'email' => $input->email,
        'password' => $input->password,
      ], true))
        return response()
          ->json([
            'code' => 404,
            'message' => 'Correo y/o contraseña incorrectos.',
          ]);

      return redirect()
        ->route('panel');
    }

    /**
     * * Executes the "log out".
     * @return \Illuminate\Http\Response
     */
    function doLogout () {
      $this->model::logout();

      return redirect()
        ->route('index')
        ->with('status', [
          'code' => 200,
          'message' => 'Sesión Cerrada.',
        ]);
    }
  }