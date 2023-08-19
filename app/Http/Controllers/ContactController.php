<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Providers\ContactServiceProvider;
use Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * * The Controller Model.
     * @var Contact
     */
    // protected $model = Contact::class;

    protected $contactServiceProvider;

    /**
     * * Creates an instance of a Controller.
     * @param ContactServiceProvider $contactServiceProvider
     */
    public function __construct(ContactServiceProvider $contactServiceProvider)
    {
        $this->contactServiceProvider = $contactServiceProvider;
    }

    /**
     * * Returns the Model details.
     * @return JsonResponse
     */
    public function read(): JsonResponse
    {
        // $location = $this->model::bySlug($slug)
        //   ->first();

        $params = $this->contactServiceProvider
            ->getData();

        return response()
            ->json($params);
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

        // $request->validate($this->model::$validation['update']['rules'], $this->model::$validation['update']['messages'][config('app.locale')]);

        // $location = $this->model::bySlug($slug)
        //     ->first();

        // $input->slug = SlugService::createSlug($this->model, 'slug', $input->name);

        // $location->update((array) $input);

        return response()
            ->json([
                'code' => 200,
                // 'contact' => $contact,
                'message' => "Datos de contacto actualizados correctamente.",
            ]);
    }
}