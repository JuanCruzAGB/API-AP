<?php
    namespace App\Http\Controllers;

    use App\Models\Mail as MailModel;
    use App\Models\Property;
    use App\Mail\Contact;
    use App\Mail\Query;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Validator;

    class MailController extends Controller{
        /** @var string The Controller language. */
        protected $lang = 'es';

        /**
         * * Send a Contact Mail.
         * @param Request $request The request form.
         */
        public function contact(Request $request){
            $input = $request->input();
            
            $validator = Validator::make($request->all(), MailModel::$validation['contact']['rules'], MailModel::$validation['contact']['messages']['es']);
            if($validator->fails()){
                return redirect('/#contacto')->withErrors($validator)->withInput();
            }

            $objDemo = new \stdClass();
            $objDemo->name = ((isset($input['name']) && $input['name']) ? $input['name'] : 'Alguien');
            $objDemo->email = $input['email'];
            $objDemo->phone = $input['phone'];
            $objDemo->message = ((isset($input['message']) && $input['message']) ? $input['message'] : 'No ha dejado un mensaje...');

            Mail::to('example@gmail.com')->send(new Contact($objDemo));

            return redirect()->route('web.thanks')->with('status', [
                'code' => 200, 
                'message' => 'Gracias por contactarte, te responderemos en la brevedad.'
            ]);
        }

        /**
         * * Send a Query Mail.
         * @param Request $request The request form.
         * @param String $slug Property ID.
         */
        public function query(Request $request, $slug){
            $input = $request->input();
            
            $validator = Validator::make($request->all(), MailModel::$validation['query']['rules'], MailModel::$validation['query']['messages']['es']);
            if($validator->fails()){
                return redirect("/propiedad/$slug/detalles#consultar")->withErrors($validator)->withInput();
            }

            $objDemo = new \stdClass();
            $objDemo->name = ((isset($input['name']) && $input['name']) ? $input['name'] : 'Alguien');
            $objDemo->email = $input['email'];
            $objDemo->phone = $input['phone'];
            $objDemo->message = ((isset($input['message']) && $input['message']) ? $input['message'] : 'No ha dejado un mensaje...');
            $objDemo->property = Property::bySlug($slug);

            Mail::to('example@mail.com')->send(new Query($objDemo));

            return redirect()->route('web.thanks')->with('status', [
                'code' => 200, 
                'message' => 'Gracias por contactarte, te responderemos en la brevedad.'
            ]);
        }
    }