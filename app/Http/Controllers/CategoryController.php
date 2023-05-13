<?php
  namespace App\Http\Controllers\API;

  use Auth;
  use Cviebrock\EloquentSluggable\Services\SlugService;
  use Illuminate\Http\Request;

  class CategoryController extends Controller {
    /**
     * * The Controller Model.
     * @var \App\Models\Category
     */
    protected $model = \App\Models\Category::class;

    /**
     * * Create a new Model.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request) {
      $input = (object) $request->all();

      $request->validate($this->model::$validation['create']['rules'], $this->model::$validation['create']['messages'][config('app.locale')]);

      $input->slug = SlugService::createSlug($this->model, 'slug', $input->name);

      $input->id_created_by = Auth::user()->id_user;

      $category = $this->model::create((array) $input);

      return redirect()
        ->json([
          'category' => $category,
          'code' => 200,
          'message' => "Categoría: \"$category->name\" creada correctamente.",
        ]);
    }

    /**
     * * Delete the Model.
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function delete (Request $request, string $slug) {
      $input = (object) $request->all();

      $request->validate($this->model::$validation['delete']['rules'], $this->model::$validation['delete']['messages'][config('app.locale')]);

      $category = $this->model::bySlug($slug)->first();

      $category->purge();

      return response()
        ->json([
          'code' => 200,
          'message' => 'Categoría eliminada correctamente.',
        ]);
    }

    /**
     * * Returns the Model list.
     * @return \Illuminate\Http\Response
     */
    public function list () {
      $categories = $this->model::orderBy('updated_at', 'desc')
        ->get();

      return response()
        ->json([
          'categories' => $categories,
        ]);
    }

    /**
     * * Returns the model details.
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function read (string $slug) {
      $category = $this->model::bySlug($slug)
        ->first();

      return response()
        ->json([
          'category' => $category,
        ]);
    }

    /**
     * * Update a Model.
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, string $slug) {
      $input = (object) $request->all();

      $request->validate($this->model::$validation['update']['rules'], $this->model::$validation['update']['messages'][config('app.locale')]);

      $category = $this->model::bySlug($slug)->first();

      $input->slug = SlugService::createSlug($this->model, 'slug', $input->name);

      $category->update((array) $input);
      
      return response()
        ->json([
          'category' => $category,
          'code' => 200,
          'message' => "Categoría: \"$category->name\" actualizada correctamente.",
        ]);
    }
  }