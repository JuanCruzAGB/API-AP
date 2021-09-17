<?php
    namespace App\Models;

    use App\Models\Property;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Database\Eloquent\Model;

    class Location extends Model{
        use Sluggable, SluggableScopeHelpers;

        /**
         * * The table name.
         * @var string
         */
        protected $table = "locations";
        
        /**
         * * The table primary key name.
         * @var string
         */
        protected $primaryKey = "id_location";

        /**
         * * The attributes that are mass assignable.
         * @var array
         */
        protected $fillable = [
            "favorite", "name", "slug",
        ];

        /**
         * * Returns all the Location Properties.
         * @return [Property[]]
         */
        public function properties () {
            return $this->hasMany(Property::class, "id_location", "id_location");
        }
        
        /**
         * * The Sluggable configuration for the Model.
         * @return array
         */
        public function sluggable () {
            return [
                "slug" => [
                    "source"	=> "name",
                    "onUpdate"	=> true,
                ]
            ];
        }

        /**
         * * Returns all the favorite Locations.
         * @static
         * @return [Location[]]
         */
        public static function getFavorites () {
            return Location::where("favorite", "=", 1);
        }
        
        /**
         * * Validation messages and rules.
         * @var array
         */
        public static $validation = [
            "adding" => [
                "rules" => [
                    "name" => "required",
                ], "messages" => [
                    "es" => [
                        "name.required" => "El Nombre es obligatorio.",
                    ],
                ],
            ], "deleting" => [
                "rules" => [
                    "message" => "required|regex:/^BORRAR$/",
                ], "messages" => [
                    "es" => [
                        "message.required" => "El Mensaje de confirmación es obligatorio.",
                        "message.regex" => "El Mensaje no es correcto.",
                    ],
                ],
            ], "updating" => [
                "rules" => [
                    "name" => "required",
                ], "messages" => [
                    "es" => [
                        "name.required" => "El Nombre es obligatorio.",
                    ],
                ],
            ],
        ];
    }