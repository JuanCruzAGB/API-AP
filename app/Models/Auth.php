<?php
  namespace App\Models;

  use Auth as Model;

  class Auth extends Model {
    /**
     * * Validation messages and rules.
     * @static
     * @var array
     */
    public static $validation = [
      'login' => [
        'rules' => [
          'email' => 'required',
          'password' => 'required|min:4',
        ], 'messages' => [
          'es' => [
            'email.required' => 'El correo es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña no puede tener menos de :min caracteres.',
          ],
        ],
      ],
    ];
  }