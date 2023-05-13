<?php
  namespace App\Models;

  use App\Models\Category;
  use App\Models\File;
  use App\Models\ForeignCategoryProperty;
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
      'description',
      'favorite',
      'folder',
      'id_created_by',
      'id_location',
      'name',
      'slug',
    ];
    
    /**
     * * Get the files from the folder.
     * @return \Illuminate\Support\Collection|null
     */
    public function getFilesAttribute () {
      if ($this->original['folder'])
        return File::all($this->original['folder']);

      return null;
    }

    /**
     * * Get all of the categories for the Property.
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function categories () {
      return $this->hasManyThrough(Category::class, ForeignCategoryProperty::class, 'id_property', 'id_category', 'id_property', 'id_category');
    }

    /**
     * * Foreign the Model.
     * @param array [$categories=[]]
     * @return void
     */
    public function foreign (array $categories = []) {
      foreach ($this->foreign_categories as $foreign)
        $foreign->purge();

      foreach ($categories as $category) {
        if ($category)
          ForeignCategoryProperty::create([
            'id_category' => $category->id_category,
            'id_property' => $this->original['id_property'],
          ]);
      }
    }

    /**
     * * Get the ForeignCategory that owns the Property.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foreign_categories () {
      return $this->hasMany(ForeignCategoryProperty::class, 'id_property', 'id_property');
    }

    /**
     * * Get the Location that owns the Property.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location () {
      return $this->belongsTo(Location::class, 'id_location', 'id_location');
    }

    /**
     * * Purge the Model.
     * @return void
     */
    public function purge () {
      foreach ($this->foreign_categories as $foreign)
        $foreign->purge();

      $this->delete();
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
          'onUpdate' => true,
          'source' => 'name',
        ],
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
          'categories' => 'required',
          'files' => 'required',
          'files.*' => 'mimetypes:image/jpeg,image/png',
        ], 'messages' => [
          'es' => [
            'name.required' => 'El Nombre es obligatorio.',
            'description.required' => 'La Descripción es obligatoria.',
            'categories.required' => 'Al menos una Categoría es obligatoria.',
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
          'categories' => 'required',
        ], 'messages' => [
          'es' => [
            'name.required' => 'El Nombre es obligatorio.',
            'description.required' => 'La Descripción es obligatoria.',
            'categories.required' => 'Al menos una Categoría es obligatoria.',
          ],
        ],
      ], 'folder' => [
        'rules' => [
          'files' => 'nullable',
          'files.*' => 'mimetypes:image/jpeg,image/png',
        ], 'messages' => [
          'es' => [
            'files.*.mimetypes' => 'Las imágenes tienen que ser formato JPEG/JPG o PNG.',
          ],
        ],
      ],
    ];
  }