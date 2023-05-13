<?php
  /** @var \Illuminate\Database\Eloquent\Factory $factory */

  use App\User;
  use Cviebrock\EloquentSluggable\Services\SlugService;
  use Faker\Generator as Faker;
  use Illuminate\Support\Facades\Hash;
  use Illuminate\Support\Str;

  /*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | This directory should contain each of the model factory definitions for
  | your application. Factories provide a convenient way to generate new
  | model instances for testing / seeding your application's database.
  |
  */

  $factory->define(User::class, function (Faker $faker) {
    $name = $faker->sentence(3, false);

    return [
      'name' => $name,
      'email' => $faker->unique()->safeEmail,
      'email_verified_at' => now(),
      'password' => Hash::make('password'),
      'slug' => SlugService::createSlug(Property::class, "slug", $name),
      'remember_token' => Str::random(10),
    ];
  });