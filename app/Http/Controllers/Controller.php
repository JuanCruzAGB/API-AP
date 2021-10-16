<?php
    namespace App\Http\Controllers;

    use App\Models\Location;
    use App\Models\Mail;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Illuminate\Foundation\Validation\ValidatesRequests;
    use Illuminate\Routing\Controller as BaseController;

    class Controller extends BaseController{
        use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        /**
         * * Control the index page.
         * @return \Illuminate\Http\Response
         */
        public function index () {
            $locations = Location::favorites()->get();

            return view('web.home', [
                'locations' => $locations,
                'validation' => (object) [
                    'mail' => Mail::$validation,
                ],
            ]);
        }
    }