<?php
  use App\Models\Category;
  use Illuminate\Database\Seeder;

  class CategorySeeder extends Seeder {
    /**
     * * The Seeder Model.
     * @var \App\Models\Category
     */
    protected $model = \App\Models\Category::class;

    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run () {
      // factory($this->model, 10)->create();

      $this->model::create([
        'name' => 'Casa',
        'slug' => 'casa',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'Departamento',
        'slug' => 'departamento',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'Terreno',
        'slug' => 'terreno',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'Campo',
        'slug' => 'campo',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'Local',
        'slug' => 'local',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'Quinta',
        'slug' => 'quinta',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'Chalet',
        'slug' => 'chalet',
        'id_created_by' => 1,
      ]);

      $this->model::create([
        'name' => 'Galpón',
        'slug' => 'galpon',
        'id_created_by' => 1,
      ]);
    }
  }