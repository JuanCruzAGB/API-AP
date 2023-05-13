<?php
  /** @var \Illuminate\Database\Eloquent\Factory $factory */

  use App\Models\Category;
  use Cviebrock\EloquentSluggable\Services\SlugService;
  use Faker\Generator as Faker;

  $factory->define(Category::class, function (Faker $faker) {
    $name = $faker->sentence(3);

    return [
      'name' => $name,
      'slug' => SlugService::createSlug(Category::class, "slug", $name),
      'id_created_by' => 1,
      'created_at' => now(),
      'updated_at' => now(),
    ];
  });