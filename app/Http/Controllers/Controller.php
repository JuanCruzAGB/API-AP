<?php
    namespace App\Http\Controllers;

    use App\Models\Location;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Illuminate\Foundation\Validation\ValidatesRequests;
    use Illuminate\Routing\Controller as BaseController;

    class Controller extends BaseController {
        use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        /**
         * * The Controller language.
         * @var string
         */
        protected $lang = 'es';

        /**
         * * Control the web in maintenance.
         * @return \Illuminate\Http\Response
         */
        public function comingSoon () {
            return view('web.coming_soon', [
                // ? Return variables.
            ]);
        }

        /**
         * * Control the home page.
         * @return \Illuminate\Http\Response
         */
        public function home () {
            $locations = Location::favorites()->get();

            return view('web.home', [
                'locations' => $locations,
            ]);
        }

        /**
         * * Control the index page.
         * @return \Illuminate\Http\Response
         */
        public function index () {
            $locations = Location::favorites()->get();

            return view('web.home', [
                'locations' => $locations,
            ]);
        }

        /**
         * * Control the "thank you" page.
         * @return \Illuminate\Http\Response
         */
        public function thanks () {
            return view('mail.thanks', [
                // ? Return variables.
            ]);
        }
    }