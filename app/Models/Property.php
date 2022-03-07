<?php
    namespace App\Models;

    use App\Models\Category;
    use App\Models\File;
    use App\Models\Location;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Database\Eloquent\Model;
    use Storage;

    class Property extends Model {
        use Sluggable, SluggableScopeHelpers;

        /**
         * * The table name.
         * @var string
         */
        protected $table = 'properties';
        
        /**
         * * The table primary key name.
         * @var string
         */
        protected $primaryKey = 'id_property';

        /**
         * * The attributes that are mass assignable.
         * @var array
         */
        protected $fillable = [
            'name', 'description', 'favorite', 'folder', 'id_category', 'id_location', 'slug', 'id_created_by',
        ];
        
        /**
         * * Get the files from the folder.
         * @return \Illuminate\Support\Collection
         */
        public function getFilesAttribute () {
            return File::all($this->folder);
        }
        
        /**
         * * Get the Category that owns the Property.
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function category () {
            return $this->belongsTo(Category::class, 'id_category', 'id_category');
        }
        
        /**
         * * Get the Location that owns the Property.
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function location () {
            return $this->belongsTo(Location::class, 'id_location', 'id_location');
        }

        /**
         * * Get the User that owns the Property.
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
         * * Returns the Properties by the Location foreign key.
         * @static
         * @param  \Illuminate\Database\Eloquent\Builder  $query
         * @param  int $id_location
         * @return \Illuminate\Database\Eloquent\Builder
         */
        public static function scopeByLocation ($query, int $id_location) {
            return $query->where('id_location', $id_location);
        }

        /**
         * * Returns the Property by the slug.
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
                    'description' => 'required',
                    'id_category' => 'required',
                    'id_location' => 'required',
                    'files' => 'required',
                    'files.*' => 'mimetypes:image/jpeg,image/png',
                ], 'messages' => [
                    'es' => [
                        'name.required' => 'El Nombre es obligatorio.',
                        'description.required' => 'La Descripción es obligatoria.',
                        'id_category.required' => 'La Categoría es obligatoria.',
                        'id_location.required' => 'La Ubicación es obligatoria.',
                        'files.required' => 'Al menos una imagen es obligatoria.',
                        'files.*.mimetypes' => 'Las imágenes tienen que ser formato JPEG/JPG o PNG.',
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
            ], 'update' => [
                'rules' => [
                    'name' => 'required',
                    'description' => 'required',
                    'id_category' => 'required',
                    'id_location' => 'required',
                    'files' => 'required',
                    'files.*' => 'mimetypes:image/jpeg,image/png',
                ], 'messages' => [
                    'es' => [
                        'name.required' => 'El Nombre es obligatorio.',
                        'description.required' => 'La Descripción es obligatoria.',
                        'id_category.required' => 'La Categoría es obligatoria.',
                        'id_location.required' => 'La Ubicación es obligatoria.',
                        'files.*.mimetypes' => 'Las imágenes tienen que ser formato JPEG/JPG o PNG.',
                    ],
                ],
            ],
        ];
    }