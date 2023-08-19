<?php

namespace App\Http\Controllers;

use Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * * The Controller Model.
     * @var \App\Models\Category
     */
    protected $model = \App\Models\Category::class;

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

        $input->id_created_by = Auth::user()
            ->id_user;

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
     * @param Request $request
     * @param string $slug
     * @return JsonResponse
     */
    public function delete(Request $request, string $slug): JsonResponse
    {
        $input = (object) $request->all();

        $request->validate($this->model::$validation['delete']['rules'], $this->model::$validation['delete']['messages'][config('app.locale')]);

        $category = $this->model::bySlug($slug)
            ->first();

        $category->purge();

        return response()
            ->json([
                'code' => 200,
                'message' => 'Categoría eliminada correctamente.',
            ]);
    }

    /**
     * * Returns the Model list.
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
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
     * @return JsonResponse
     */
    public function read(string $slug): JsonResponse
    {
        $category = $this->model::bySlug($slug)
            ->first();

        return response()
            ->json([
                'category' => $category,
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

        $category = $this->model::bySlug($slug)
            ->first();

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