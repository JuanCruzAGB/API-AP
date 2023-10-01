<?php
  namespace Database\Factories;

  use App\Models\Location;
  use Cviebrock\EloquentSluggable\Services\SlugService;
  use Illuminate\Database\Eloquent\Factories\Factory;

  class LocationFactory extends Factory
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
        'favorite' => $this->faker->randomElement([0, 1]),
        'slug' => SlugService::createSlug(Location::class, "slug", $name),
        'id_created_by' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }
  }