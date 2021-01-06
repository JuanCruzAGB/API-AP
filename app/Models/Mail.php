<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Storage;

    class Mail extends Model{
        /** @var array Validation messages and rules. */
        public static $validation = [
            'contact' => [
                'rules' => [
                    'name' => 'nullable|min:2',
                    'email' => 'required|email',
                    'phone' => 'required',
                ], 'messages' => [
                    'es' => [
                        'name.min' => 'El nombre no puede tener menos de :min caracteres', 
                        'email.required' => 'El correo es obligatorio',
                        'email.required' => 'El correo debe ser formato mail (ejemplo@corro.com)', 
                        'phone.required' => 'El teléfono es obligatorio',
                    ],
                ],
            ], 'query' => [
                'rules' => [
                    'name' => 'nullable|min:2',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'message' => 'required',
                ], 'messages' => [
                    'es' => [
                        'name.min' => 'El nombre no puede tener menos de :min caracteres', 
                        'email.required' => 'El correo es obligatorio',
                        'email.required' => 'El correo debe ser formato mail (ejemplo@corro.com)', 
                        'phone.required' => 'El teléfono es obligatorio',
                        'message.required' => 'El consulta es obligatorio',
                    ],
                ],
            ],
        ];
    }