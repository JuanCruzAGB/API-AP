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

            try {
                $request->validate($this->model::$validation['contact']['rules'], $this->model::$validation['contact']['messages'][$this->lang]);
            } catch (\Throwable $th) {
                return redirect('/home#contact')->withInput($request->except('key'));
            }

            $this->model::send('contact', [
                'from' => [
                    'email' => $input['email'],
                    'name' => (isset($input['name']) && $input['name']) ? $input['name'] : 'Alguien',
                    'phone' => $input['phone'],
                    'message' => (isset($input['message']) && $input['message']) ? $input['message'] : 'No ha dejado un mensaje...',
                ], 'to' => [
                    'email' => 'example@mail.com',
                ],
            ]);

            return redirect()->route('web.thanks')->with('status', [
                'code' => 200, 
                'message' => 'Gracias por contactarte, te responderemos en la brevedad.'
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
            
            $request->validate($this->model::$validation['query']['rules'], $this->model::$validation['query']['messages'][$this->lang]);

            $this->model::send('query', [
                'from' => [
                    'name' => (isset($input['name']) && $input['name']) ? $input['name'] : 'Alguien',
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                    'message' => (isset($input['message']) && $input['message']) ? $input['message'] : 'No ha dejado un mensaje...',
                ], 'to' => [
                    'email' => 'example@mail.com',
                ], 'property' => Property::bySlug($slug)->first(),
            ]);

            return redirect()->route('web.thanks')->with('status', [
                'code' => 200, 
                'message' => 'Gracias por contactarte, te responderemos en la brevedad.'
            ]);
        }
    }