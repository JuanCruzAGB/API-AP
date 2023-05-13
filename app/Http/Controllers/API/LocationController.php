<?php
  namespace App\Http\Controllers\API;

  use Auth;
  use Cviebrock\EloquentSluggable\Services\SlugService;
  use Illuminate\Http\Request;

  class LocationController extends Controller {
    /**
     * * The Controller Model.
     * @var \App\Models\Location
     */
    protected $model = \App\Models\Location::class;

    /**
     * * Returns the index page.
     * @return \Illuminate\Http\Response
     */
    public function index () {
      $locations = $this->model::orderBy('updated_at', 'desc')
        ->get();

      return response()
        ->json([
          'locations' => $locations,
        ]);
    }

    /**
     * * Returns the details page.
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function details (string $slug) {
      $location = $this->model::bySlug($slug)
        ->first();

      return response()
        ->json([
          'location' => $location,
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

      $location = $this->model::create((array) $input);

      return response()
        ->json([
          'code' => 200,
          'location' => $location,
          'message' => "Ubicación: \"$location->name\" creada correctamente.",
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

      $location = $this->model::bySlug($slug)->first();

      $input->slug = SlugService::createSlug($this->model, 'slug', $input->name);

      $location->update((array) $input);

      return response()
        ->json([
          'code' => 200,
          'location' => $location,
          'message' => "Ubicación: \"$location->name\" actualizada correctamente.",
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

      $location = $this->model::bySlug($slug)->first();

      $location->purge();

      return response()
        ->json([
          'code' => 200,
          'message' => 'Ubicación eliminada correctamente.',
        ]);
    }

    /**
     * * Execute the Model "add to favorite".
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function doFav (Request $request, string $slug) {
      $input = (object) $request->all();

      $request->validate($this->model::$validation['fav']['rules'], $this->model::$validation['fav']['messages'][$this->lang]);

      $location = $this->model::bySlug($slug)->first();

      $location->update([
        'favorite' => !$location->favorite,
      ]);

      return response()
        ->json([
          'code' => 200,
          'location' => $location,
          'message' => $location->favorite
            ? "$location->name se agregó de favoritos"
            : "$location->name se quitó de favoritos",
        ]);
    }
  }