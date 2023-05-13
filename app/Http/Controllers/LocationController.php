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
     * * Create a new Model.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request) {
      $input = (object) $request->all();

      $request->validate($this->model::$validation['create']['rules'], $this->model::$validation['create']['messages'][config('app.locale')]);

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
     * * Delete a Model.
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function delete (Request $request, string $slug) {
      $input = (object) $request->all();

      $request->validate($this->model::$validation['delete']['rules'], $this->model::$validation['delete']['messages'][config('app.locale')]);

      $location = $this->model::bySlug($slug)->first();

      $location->purge();

      return response()
        ->json([
          'code' => 200,
          'message' => 'Ubicación eliminada correctamente.',
        ]);
    }

    /**
     * * Fav a Model.
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function fav (Request $request, string $slug) {
      $input = (object) $request->all();

      $request->validate($this->model::$validation['fav']['rules'], $this->model::$validation['fav']['messages'][config('app.locale')]);

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

    /**
     * * Returns the Model list.
     * @return \Illuminate\Http\Response
     */
    public function list () {
      $locations = $this->model::orderBy('updated_at', 'desc')
        ->get();

      return response()
        ->json([
          'locations' => $locations,
        ]);
    }

    /**
     * * Returns the Model details.
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function read (string $slug) {
      $location = $this->model::bySlug($slug)
        ->first();

      return response()
        ->json([
          'location' => $location,
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
  }