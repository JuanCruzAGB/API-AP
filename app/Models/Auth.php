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
                        'email.required' => 'El Correo es obligatorio.',
                        'password.required' => 'La Contraseña es obligatoria.',
                        'password.min' => 'La Contraseña no puede tener menos de :min caracteres.',
                    ],
                ],
            ],
        ];
    }