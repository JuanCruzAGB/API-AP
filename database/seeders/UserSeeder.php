<?php
  namespace Database\Seeders;

  use App\Models\User;
  use Illuminate\Database\Seeder;
  use Illuminate\Support\Facades\Hash;

  class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run () {
      User::create([
        'name' => 'Juan Cruz Armentia',
        'email' => 'juan.cruz.armentia@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('AP40538177'),
        'slug' => 'juan-cruz-armentia',
      ]);

      User::create([
        'name' => 'Juan Manuel Armentia',
        'email' => 'jmarmentia2010@hotmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('infiernorojo'),
        'slug' => 'juan-manuel-armentia',
      ]);
    }
  }