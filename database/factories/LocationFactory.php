<?php
  /** @var \Illuminate\Database\Eloquent\Factory $factory */

  use App\Models\Location;
  use Cviebrock\EloquentSluggable\Services\SlugService;
  use Faker\Generator as Faker;

  $factory->define(Location::class, function (Faker $faker) {
    $name = $faker->sentence(3);

    return [
      'name' => $name,
      'favorite' => $faker->randomElement([0, 1]),
      'slug' => SlugService::createSlug(Location::class, "slug", $name),
      'id_created_by' => 1,
      'created_at' => now(),
      'updated_at' => now(),
    ];
  });