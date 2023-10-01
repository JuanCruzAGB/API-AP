<?php
  namespace Database\Factories;

  use App\Models\User;
  use Cviebrock\EloquentSluggable\Services\SlugService;
  use Illuminate\Database\Eloquent\Factories\Factory;
  use Illuminate\Support\Facades\Hash;
  use Illuminate\Support\Str;

  class UserFactory extends Factory
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
        'email' => $this->faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'slug' => SlugService::createSlug(Property::class, "slug", $name),
        'remember_token' => Str::random(10),
      ];
    }
  }