<?php
  namespace Database\Factories;

  use App\Models\Category;
  use Cviebrock\EloquentSluggable\Services\SlugService;
  use Illuminate\Database\Eloquent\Factories\Factory;

  class CategoryFactory extends Factory
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
        'slug' => SlugService::createSlug(Category::class, "slug", $name),
        'id_created_by' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }
  }