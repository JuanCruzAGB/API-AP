<?php

namespace App\Models;

use App\Models\Category;
use App\Models\File;
use App\Models\ForeignCategoryProperty;
use App\Models\Location;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Storage;

class Property extends Model
{
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
        'enabled',
        'favorite',
        'folder',
        'id_created_by',
        'id_location',
        'name',
        'slug',
    ];

    /**
     * * Get the files from the folder.
     * @return ?Collection
     */
    public function getFilesAttribute(): ?Collection
    {
        if ($this->original['folder']) {
            return File::all($this->original['folder']);
        }

        return null;
    }

    /**
     * * Get all of the categories for the Property.
     * @return HasManyThrough
     */
    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(Category::class, ForeignCategoryProperty::class, 'id_property', 'id_category', 'id_property', 'id_category');
    }

    /**
     * * Foreign the Model.
     * @param array [$categories=[]]
     * @return void
     */
    public function foreign(array $categories = []): void
    {
        foreach ($this->foreign_categories as $foreign) {
            $foreign->purge();
        }

        foreach ($categories as $category) {
            if ($category) {
                ForeignCategoryProperty::create([
                    'id_category' => $category->id_category,
                    'id_property' => $this->original['id_property'],
                ]);
            }
        }
    }

    /**
     * * Get the ForeignCategory that owns the Property.
     * @return HasMany
     */
    public function foreign_categories(): HasMany
    {
        return $this->hasMany(ForeignCategoryProperty::class, 'id_property', 'id_property');
    }

    /**
     * * Get the Location that owns the Property.
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'id_location', 'id_location');
    }

    /**
     * * Purge the Model.
     * @return void
     */
    public function purge(): void
    {
        foreach ($this->foreign_categories as $foreign) {
            $foreign->purge();
        }

        $this->delete();
    }

    /**
     * * Get the User that owns the Property.
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
     * * Returns the Properties by the Category foreign key.
     * @static
     * @param  Builder  $query
     * @param  int $id_category
     * @return Builder
     */
    public static function scopeByCategory(Builder $query, int $id_category): Builder
    {
        return $query->where('id_category', $id_category);
    }

    /**
     * * Returns the Properties by the Location foreign key.
     * @static
     * @param  Builder  $query
     * @param  int $id_location
     * @return Builder
     */
    public static function scopeByLocation(Builder $query, int $id_location): Builder
    {
        return $query->where('id_location', $id_location);
    }

    /**
     * * Returns the Property by the slug.
     * @static
     * @param  Builder  $query
     * @param  string $slug
     * @return Builder
     */
    public static function scopeBySlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    /**
     * * Returns the Properties filtered by a Request.
     * @param Builder  $query
     * @param Request $request
     * @return Builder
     */
    public static function scopeFilter(Builder $query, Request $request): Builder
    {
        $input = (object) $request->all();

        if (isset($input->id_category)) {
            $query = $query->whereHas('foreign_categories.category', function ($query) use ($input) {
                $query->where('id_category', $input->id_category);
            });
        }

        if (isset($input->id_location)) {
            $query = $query->where('id_location', $input->id_location);
        }

        if (isset($input->search)) {
            $query = $query->where('name', 'LIKE', "%$input->search%");
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