<?php
  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Support\Facades\Mail as Mailer;
  use Storage;

  class Mail extends Model {
    /**
     * * Sends a Mail.
     * @static
     * @param string $type
     * @param array $data
     * @return void
     */
    public static function send (string $type, array $data) {
      switch ($type) {
        case 'contact':
          Mailer::to($data['to']['email'])
            ->send(new \App\Mail\Contact($data));
          break;

        case 'query':
          Mailer::to($data['to']['email'])
            ->send(new \App\Mail\Query($data));
          break;
      }
    }

    /**
     * * Validation messages and rules.
     * @static
     * @var array
     */
    public static $validation = [
      'contact' => [
        'rules' => [
          'name' => 'nullable|min:2',
          'email' => 'required|email',
          'phone' => 'required',
          // 'g-recaptcha-response' => 'required',
        ], 'messages' => [
          'es' => [
              'name.min' => 'El nombre no puede tener menos de :min caracteres', 
            'email.required' => 'El correo es obligatorio',
            'email.required' => 'El correo debe ser formato mail (ejemplo@corro.com)', 
            'phone.required' => 'El teléfono es obligatorio',
            'g-recaptcha-response.required' => 'Verifica que eres un humano.',
          ],
        ],
      ], 'query' => [
        'rules' => [
          'name' => 'nullable|min:2',
          'email' => 'required|email',
          'phone' => 'required',
          'message' => 'required',
        ], 'messages' => [
          'es' => [
            'name.min' => 'El nombre no puede tener menos de :min caracteres', 
            'email.required' => 'El correo es obligatorio',
            'email.required' => 'El correo debe ser formato mail (ejemplo@corro.com)', 
            'phone.required' => 'El teléfono es obligatorio',
            'message.required' => 'El consulta es obligatorio',
          ],
        ],
      ],
    ];
  }