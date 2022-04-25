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
         * * Get the User that owns the Category.
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function user () {
            return $this->belongsTo(User::class, 'id_created_by', 'id_user');
        }
        
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
         * * Returns the Category by the slug.
         * @static
         * @param  \Illuminate\Database\Eloquent\Builder  $query
         * @param  string $slug
         * @return \Illuminate\Database\Eloquent\Builder
         */
        public static function scopeBySlug ($query, string $slug) {
            return $query->where('slug', $slug);
        }
        
        /**
         * * Validation messages and rules.
         * @static
         * @var array
         */
        public static $validation = [
            'create' => [
                'rules' => [
                    'name' => 'required',
                ], 'messages' => [
                    'es' => [
                        'name.required' => 'El Nombre es obligatorio.',
                    ],
                ],
            ], 'update' => [
                'rules' => [
                    'name' => 'required',
                ], 'messages' => [
                    'es' => [
                        'name.required' => 'El Nombre es obligatorio.',
                    ],
                ],
            ], 'delete' => [
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