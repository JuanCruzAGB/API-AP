<?php
  namespace App\Models;

  use App\Models\Property;
  use Cviebrock\EloquentSluggable\Sluggable;
  use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
  use Illuminate\Database\Eloquent\Model;

  class Location extends Model {
    use Sluggable, SluggableScopeHelpers;

    /**
     * * The table name.
     * @var string
     */
    protected $table = 'locations';
    
    /**
     * * The table primary key name.
     * @var string
     */
    protected $primaryKey = 'id_location';

    /**
     * * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
      'favorite',
      'id_created_by',
      'name',
      'slug',
    ];

    /**
     * * Get all of the Properties favorites for the Location.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorite_properties () {
      return $this->hasMany(Property::class, 'id_location', 'id_location')->where('favorite', '=', 1);
    }

    /**
     * * Get all of the Properties for the Location.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function properties () {
      return $this->hasMany(Property::class, 'id_location', 'id_location');
    }

    /**
     * * Purge the Model.
     * @return void
     */
    public function purge () {
      $this->delete();
    }

    /**
     * * Get the User that owns the Location.
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
     * * Returns all the favorite Locations.
     * @static
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeFavorites ($query) {
      return $query->where('favorite', 1);
    }

    /**
     * * Returns the Location by the slug.
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
      ], 'delete' => [
        'rules' => [
          'message' => 'required|regex:/^BORRAR$/',
        ], 'messages' => [
          'es' => [
            'message.required' => 'El Mensaje de confirmación es obligatorio.',
            'message.regex' => 'El Mensaje no es correcto.',
          ],
        ],
      ], 'fav' => [
        'rules' => [
          // ? Rules
        ], 'messages' => [
          'es' => [
            // ? Messages
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
      ],
    ];
  }