<?php

namespace App\Models;

use App\Models\Property;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
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
     * @return HasMany
     */
    public function favorite_properties(): HasMany
    {
        return $this->hasMany(Property::class, 'id_location', 'id_location')
            ->where('favorite', '=', 1);
    }

    /**
     * * Get all of the Properties for the Location.
     * @return HasMany
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'id_location', 'id_location');
    }

    /**
     * * Purge the Model.
     * @return void
     */
    public function purge(): void
    {
        $this->delete();
    }

    /**
     * * Get the User that owns the Location.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_created_by', 'id_user');
    }

    /**
     * * The Sluggable configuration for the Model.
     * @return array
     */
    public function sluggable(): array
    {
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
     * @param  Builder  $query
     * @return Builder
     */
    public static function scopeFavorites($query): Builder
    {
        return $query->where('favorite', 1);
    }

    /**
     * * Returns the Location by the slug.
     * @static
     * @param  Builder  $query
     * @param  string $slug
     * @return Builder
     */
    public static function scopeBySlug($query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    /**
     * * Returns the Locations filtered.
     * @param  Builder  $query
     * @param  object $filters
     * @return Builder
     */
    public static function scopeFilter ($query, object $filters): Builder
    {
        if (isset($filters->favorite) && $filters->favorite) {
            return $query->where('favorite', $filters->favorite);
        }

        return $query;
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