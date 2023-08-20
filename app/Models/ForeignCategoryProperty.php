<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForeignCategoryProperty extends Model
{
    /**
     * * The table name.
     * @var string
     */
    protected $table = 'foreign_table_category_property';

    /**
     * * The table primary key name.
     * @var string
     */
    protected $primaryKey = 'id_foreign';

    /**
     * * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'id_category',
        'id_property',
    ];
    
    /**
     * * Get the Category that owns the Property.
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    /**
     * * Get the Property that owns the Property.
     * @return BelongsTo
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'id_property', 'id_property');
    }

    /**
     * * Purge the Model.
     * @return void
     */
    public function purge(): void
    {
        $this->delete();
    }
}