<?php
  namespace App\Http\Controllers;

  use Auth;
  use Cviebrock\EloquentSluggable\Services\SlugService;
  use Illuminate\Http\Request;

  class ContactController extends Controller {
    /**
     * * The Controller Model.
     * @var \App\Models\Contact
     */
    // protected $model = \App\Models\Contact::class;

    /**
     * * Returns the Model details.
     * @return \Illuminate\Http\Response
     */
    public function read () {
      // $location = $this->model::bySlug($slug)
      //   ->first();

      return response()
        ->json([
          'contact' => [
            'address' => "Pedro N. Carrera 961",
            'email' => "jmarmentia2010@hotmail.com",
            'phone' => "5492983649476",
          ],
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

      // $request->validate($this->model::$validation['update']['rules'], $this->model::$validation['update']['messages'][config('app.locale')]);

      // $location = $this->model::bySlug($slug)->first();

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