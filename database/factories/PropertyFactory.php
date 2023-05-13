<?php
  /** @var \Illuminate\Database\Eloquent\Factory $factory */

  use App\Models\Property;
  use Cviebrock\EloquentSluggable\Services\SlugService;
  use Faker\Generator as Faker;

  $factory->define(Property::class, function (Faker $faker) {
    $name = $faker->sentence(3, false);

    return [
      'name' => $name,
      'description' => $faker->text,
      'id_category' => App\Models\Category::all()->random()->id_category,
      'id_location' => App\Models\Location::all()->random()->id_location,
      'favorite' => $faker->randomElement([0, 1]),
      'slug' => SlugService::createSlug(Property::class, "slug", $name),
      'id_created_by' => 1,
      'created_at' => now(),
      'updated_at' => now(),
    ];
  });