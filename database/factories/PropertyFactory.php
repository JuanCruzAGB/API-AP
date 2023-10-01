<?php
  namespace Database\Factories;

  use App\Models\Category;
  use App\Models\Property;
  use App\Models\Location;
  use Cviebrock\EloquentSluggable\Services\SlugService;
  use Illuminate\Database\Eloquent\Factories\Factory;
  use Illuminate\Support\Str;

  class PropertyFactory extends Factory
  {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $name = $this->faker->sentence(3, false);

      return [
        'name' => $name,
        'description' => $this->faker->text,
        'id_category' => Category::all()->random()->id_category,
        'id_location' => Location::all()->random()->id_location,
        'favorite' => $this->faker->randomElement([0, 1]),
        'enabled' => $this->faker->randomElement([0, 1]),
        'slug' => SlugService::createSlug(Property::class, "slug", $name),
        'id_created_by' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }
  }