<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
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
        'id_created_by',
        'name',
        'slug',
    ];

    /**
     * * Get all of the properties for the Property.
     * @return HasManyThrough
     */
    public function properties(): HasManyThrough
    {
        return $this->hasManyThrough(Property::class, ForeignCategoryProperty::class, 'id_category', 'id_property', 'id_category', 'id_property');
    }

    /**
     * * Get the ForeignCategory that owns the Property.
     * @return HasMany
     */
    public function foreign_properties(): HasMany
    {
        return $this->hasMany(ForeignCategoryProperty::class, 'id_category', 'id_category');
    }

    /**
     * * Purge the Model.
     * @return void
     */
    public function purge(): void
    {
        foreach ($this->foreign_properties as $foreign) {
            $foreign->purge();
        }

        $this->delete();
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
     * * Get the User that owns the Category.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_created_by', 'id_user');
    }

    /**
     * * Returns the Category by the slug.
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