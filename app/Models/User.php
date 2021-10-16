<?php
    namespace App\Models;

    use Auth;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;

    class User extends Authenticatable {
        use Notifiable, Sluggable, SluggableScopeHelpers;

        /**
         * * The table name.
         * @var string
         */
        protected $table = 'users';
        
        /**
         * * The table primary key name.
         * @var string
         */
        protected $primaryKey = 'id_user';

        /**
         * * The attributes that are mass assignable.
         * @var array
         */
        protected $fillable = [
            'name', 'email', 'password', 'slug',
        ];

        /**
         * * The attributes that should be hidden for arrays.
         * @var array
         */
        protected $hidden = [
            'password',
        ];

        /**
         * * The attributes that should be cast to native types.
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];
        
        /**
         * * The Sluggable configuration for the Model.
         * @return array
         */
        public function sluggable(){
            return [
                'slug' => [
                    'source'	=> 'name',
                    'onUpdate'	=> true,
                ]
            ];
        }
        
        /**
         * * Validation messages and rules.
         * @static
         * @var array
         */
        public static $validation = [
            'log-in' => [
                'rules' => [
                    'email' => 'required|email',
                    'password' => 'required|min:4|max:40',
                ], 'messages' => [
                    'en' => [
                        'email.required' => 'The email is required.',
                        'email.email' => 'The email must be a valid email.',
                        'password.required' => 'The password is required.',
                        'password.min' => 'The password min length is :min.',
                        'password.max' => 'The password max length is :max.',
                    ], 'es' => [
                        'email.required' => 'El correo es obligatorio.',
                        'email.email' => 'El correo no es un formato válido.',
                        'password.required' => 'La contraseña es obligatoria.',
                        'password.min' => 'La contraseña no puede tener menos de :min caracteres.',
                        'password.max' => 'La contraseña no puede tener más de :max caracteres.',
                    ],
                ],
            ], 'register' => [
                //
            ], 'create' => [
                //
            ], 'edit' => [
                //
            ],
        ];
    }