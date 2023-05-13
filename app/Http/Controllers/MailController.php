<?php
  namespace App\Http\Controllers;

  use App\Models\Property;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Validator;

  class MailController extends Controller {
    /**
     * * The Controller Model.
     * @var \App\Models\Mail
     */
    protected $model = \App\Models\Mail::class;

    /**
     * * Send a Contact Mail.
     * @param \Illuminate\Http\Request $request The request form.
     * @return \Illuminate\Http\Response
     */
    public function contact (Request $request) {
      $input = $request->input();

      $request->validate($this->model::$validation['contact']['rules'], $this->model::$validation['contact']['messages'][config('app.locale')]);

      $this->model::send('contact', [
        'from' => [
          'email' => $input['email'],
          'message' => (isset($input['message']) && $input['message'])
            ? $input['message']
            : 'No ha dejado un mensaje...',
          'name' => (isset($input['name']) && $input['name'])
            ? $input['name']
            : 'Alguien',
          'phone' => $input['phone'],
        ],
        'to' => [
          'email' => 'example@mail.com',
        ],
      ]);

      return redirect()
        ->json([
          'code' => 200,
          'message' => 'Mail de contacto enviado correctamente.'
        ]);
    }

    /**
     * * Send a Query Mail.
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function query (Request $request, string $slug) {
      $input = $request->input();

      $request->validate($this->model::$validation['query']['rules'], $this->model::$validation['query']['messages'][config('app.locale')]);

      $this->model::send('query', [
        'from' => [
          'email' => $input['email'],
          'message' => (isset($input['message']) && $input['message'])
            ? $input['message']
            : 'No ha dejado un mensaje...',
          'name' => (isset($input['name']) && $input['name'])
            ? $input['name']
            : 'Alguien',
          'phone' => $input['phone'],
        ],
        'to' => [
          'email' => 'example@mail.com',
        ],
        'property' => Property::bySlug($slug)->first(),
      ]);

      return response()
        ->json([
          'code' => 200,
          'message' => 'Mail de consulta enviado correctamente.'
        ]);
    }
  }