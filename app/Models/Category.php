<?php
    namespace App\Models;

    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Database\Eloquent\Model;

    class Category extends Model {
        use Sluggable, SluggableScopeHelpers;

        /**
         * * The table name.
         * @var string
         */
        protected $table = 'categories';
        
        /**
         * * The table primary key name.
         * @var string
         */
        protected $primaryKey = 'id_category';

        /**
         * * The attributes that are mass assignable.
         * @var array
         */
        protected $fillable = [
            'name', 'slug', 'id_created_by',
        ];
        
        /**
         * * The Sluggable configuration for the Model.
         * @return array
         */
        public function sluggable () {
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
            'adding' => [
                'rules' => [
                    'name' => 'required',
                ], 'messages' => [
                    'es' => [
                        'name.required' => 'El Nombre es obligatorio.',
                    ],
                ],
            ], 'updating' => [
                'rules' => [
                    'name' => 'required',
                ], 'messages' => [
                    'es' => [
                        'name.required' => 'El Nombre es obligatorio.',
                    ],
                ],
            ], 'deleting' => [
                'rules' => [
                    'message' => 'required|regex:/^BORRAR$/',
                ], 'messages' => [
                    'es' => [
                        'message.required' => 'El Mensaje de confirmación es obligatorio.',
                        'message.regex' => 'El Mensaje no es correcto.',
                    ],
                ],
            ],
        ];
    }