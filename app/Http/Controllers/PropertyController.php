<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ForeignCategoryProperty;
use App\Models\Location;
use App\Models\Property;
use Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;

class PropertyController extends Controller
{
    /**
     * * The Controller Model.
     * @var Property
     */
    protected $model = Property::class;

    /**
     * * Create a new Model.
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $input = (object) $request->all();

        $request->validate($this->model::$validation['create']['rules'], $this->model::$validation['create']['messages'][config('app.locale')]);

        $input->slug = SlugService::createSlug($this->model, 'slug', $input->name);

        $input->folder = 0;

        $input->id_created_by = Auth::user()
            ->id_user;

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

        foreach ($input->categories as $id_category) {
            $categories[] = Category::find($id_category);
        }

        $property->foreign($categories);

        return response()
            ->json([
                'code' => 200,
                'message' => "Propiedad: \"$property->name\" creada correctamente.",
                'property' => $property,
            ]);
    }

    /**
     * * Delete a Model.
     * @param Request $request
     * @param string $slug
     * @return JsonResponse
     */
    public function delete(Request $request, string $slug): JsonResponse
    {
        $input = (object) $request->all();

        $request->validate($this->model::$validation['delete']['rules'], $this->model::$validation['delete']['messages'][config('app.locale')]);

        $property = $this->model::bySlug($slug)
            ->first();

        if (Storage::exists($property->folder)) {
            Storage::deleteDirectory($property->folder);
        }

        $property->purge();

        return response()
            ->json([
                'code' => 200,
                'message' => 'Propiedad eliminada correctamente.',
            ]);
    }

    /**
     * * Fav a Model.
     * @param Request $request
     * @param string $slug
     * @return JsonResponse
     */
    public function fav(Request $request, string $slug): JsonResponse
    {
        $input = (object) $request->all();

        $request->validate($this->model::$validation['fav']['rules'], $this->model::$validation['fav']['messages'][config('app.locale')]);

        $property = $this->model::bySlug($slug)
            ->first();

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

    /**
     * * Returns the Model list.
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $properties = $this->model::orderBy('updated_at', 'desc')
            ->filter($request)
            ->get();

        return response()
            ->json([
                'properties' => $properties,
            ]);
    }

    /**
     * * Returns the Model details.
     * @param string $slug
     * @return JsonResponse
     */
    public function read(string $slug): JsonResponse
    {
        $property = $this->model::bySlug($slug)
            ->with([ 'categories', 'location', ])
            ->first();

        return response()
            ->json([
                'property' => $property,
            ]);
    }

    /**
     * * Update a Model.
     * @param Request $request
     * @param string $slug
     * @return JsonResponse
     */
    public function update(Request $request, string $slug): JsonResponse
    {
        $input = (object) $request->all();

        $request->validate($this->model::$validation['update']['rules'], $this->model::$validation['update']['messages'][config('app.locale')]);

        $property = $this->model::bySlug($slug)
            ->first();

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
        //                 ->resize(500, 400, function ($constrait) {
        //                     $constrait->aspectRatio();
        //                     $constrait->upsize();
        //                 });

        //         Storage::put($filepath, (string) $file->encode());
        //     }
        // }

        $categories = [];

        foreach ($input->categories as $id_category) {
            $categories[] = Category::find($id_category);
        }

        $property->foreign($categories);

        return response()
            ->json([
                'code' => 200,
                'message' => "Propiedad: \"$property->name\" actualizada correctamente.",
                'property' => $property,
            ]);
    }
}