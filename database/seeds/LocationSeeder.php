<?php
  use App\Models\Location;
  use Illuminate\Database\Seeder;

  class LocationSeeder extends Seeder {
    /**
     * * The Seeder Model.
     * @var \App\Models\Location
     */
    protected $model = \App\Models\Location::class;

    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run () {
      // factory($this->model, 10)->create();

      $this->model::create([
        'name' => 'Mar del Plata',
        'favorite' => 0,
        'slug' => 'mar-del-plata',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'Necochea',
        'favorite' => 0,
        'slug' => 'necochea',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'San Cayetano',
        'favorite' => 1,
        'slug' => 'san-cayetano',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'Buenos Aires',
        'favorite' => 0,
        'slug' => 'buenos-aires',
        'id_created_by' => 1,
      ]);

      $this->model::create([
          'name' => 'Benito Juarez',
          'favorite' => 0,
          'slug' => 'benito-juarez',
          'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'Bahía Blanca',
        'favorite' => 0,
        'slug' => 'bahia-blanca',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'Balneario San Cayetano',
        'favorite' => 0,
        'slug' => 'balneario-san-cayetano',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'La Dulce',
        'favorite' => 0,
        'slug' => 'la-dulce',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'Adolfo González Chavez',
        'favorite' => 0,
        'slug' => 'adolfo-gonzalez-chavez',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'Energía',
        'favorite' => 0,
        'slug' => 'energia',
        'id_created_by' => 1,
      ]);
    }
  }