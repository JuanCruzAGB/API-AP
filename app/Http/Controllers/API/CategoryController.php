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
     * * Returns the index page.
     * @return \Illuminate\Http\Response
     */
    public function index () {
      $categories = $this->model::orderBy('updated_at', 'desc')
        ->get();

      return response()
        ->json([
          'categories' => $categories,
        ]);
    }

    /**
     * * Returns the details page.
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function details (string $slug) {
      $category = $this->model::bySlug($slug)
        ->first();

      return response()
        ->json([
          'category' => $category,
        ]);
    }

    /**
     * * Execute the Model creation.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function doCreate (Request $request) {
      $input = (object) $request->all();

      $request->validate($this->model::$validation['create']['rules'], $this->model::$validation['create']['messages'][$this->lang]);

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
     * * Execute the Model updation.
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function doUpdate (Request $request, string $slug) {
      $input = (object) $request->all();

      $request->validate($this->model::$validation['update']['rules'], $this->model::$validation['update']['messages'][$this->lang]);

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

    /**
     * * Execute the Model deletion.
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function doDelete (Request $request, string $slug) {
      $input = (object) $request->all();

      $request->validate($this->model::$validation['delete']['rules'], $this->model::$validation['delete']['messages'][$this->lang]);

      $category = $this->model::bySlug($slug)->first();

      $category->purge();

      return response()
        ->json([
          'code' => 200,
          'message' => 'Categoría eliminada correctamente.',
        ]);
    }
  }