<?php
  namespace App\Http\Controllers;

  use App\Models\Category;
  use App\Models\ForeignCategoryProperty;
  use App\Models\Location;
  use Auth;
  use Cviebrock\EloquentSluggable\Services\SlugService;
  use Illuminate\Http\Request;
  use Intervention\Image\ImageManagerStatic as Image;
  use Storage;

  class PropertyController extends Controller {
    /**
     * * The Controller Model.
     * @var \App\Models\Property
     */
    protected $model = \App\Models\Property::class;

    /**
     * * Returns the index page.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request) {
      $properties = $this->model::orderBy('updated_at', 'desc')->get();

      return response()
        ->json([
          'properties' => $properties,
        ]);
    }

    /**
     * * Returns the details page.
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function details (string $slug) {
      $property = $this->model::bySlug($slug)
        ->first();

      return response()
        ->json([
          'property' => $property,
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

      $input->folder = 0;

      $input->id_created_by = Auth::user()->id_user;

      $property = $this->model::create((array) $input);

      $property->update([
        'folder' => "property/$property->id_property",
      ]);

      foreach ($request->file('files') as $file) {
        $filepath = $file->hashName($property->folder);

        $file = Image::make($file)
          ->resize(500, 400, function ($constrait) {
            $constrait->aspectRatio();
            $constrait->upsize();
          });

        Storage::put($filepath, (string) $file->encode());
      }

      $categories = [];

      foreach ($input->categories as $id_category)
        $categories[] = Category::find($id_category);

      $property->foreign($categories);

      return response()
        ->json([
          'code' => 200,
          'message' => "Propiedad: \"$property->name\" creada correctamente.",
          'property' => $property,
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

      $property = $this->model::bySlug($slug)->first();

      $input->slug = SlugService::createSlug($this->model, 'slug', $input->name);

      $property->update((array) $input);

      // if (isset($input->list)) {
      //     foreach ($input->list as $key => $value) {
      //         if (isset($property->files[$key])) {
      //             Storage::delete($property->files[$key]);
      //         }
      //     }
      // }

      // if (isset($input->files)) {
      //     foreach ($request->file('files') as $file) {
      //         $filepath = $file->hashName($property->folder);

      //         $file = Image::make($file)
      //                 ->resize(500, 400, function($constrait) {
      //                     $constrait->aspectRatio();
      //                     $constrait->upsize();
      //                 });

      //         Storage::put($filepath, (string) $file->encode());
      //     }
      // }

      $categories = [];

      foreach ($input->categories as $id_category)
        $categories[] = Category::find($id_category);

      $property->foreign($categories);

      return response()
        ->json([
          'code' => 200,
          'message' => "Propiedad: \"$property->name\" actualizada correctamente.",
          'property' => $property,
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

      $property = $this->model::bySlug($slug)->first();

      if (Storage::exists($property->folder))
        Storage::deleteDirectory($property->folder);

      $property->purge();

      return response()
        ->json([
          'code' => 200,
          'message' => 'Propiedad eliminada correctamente.',
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

      $property = $this->model::bySlug($slug)->first();

      $property->update([
        'favorite' => !$property->favorite,
      ]);

      return response()
        ->json([
          'code' => 200,
          'message' => $property->favorite
            ? "$property->name se agregó de favoritos"
            : "$property->name se quitó de favoritos",
          'property' => $property,
        ]);
    }
  }