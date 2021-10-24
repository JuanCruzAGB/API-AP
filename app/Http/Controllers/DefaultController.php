<?php
    namespace App\Http\Controllers;

    use App\Models\Category;
    use App\Models\Location;
    use App\Models\Mail;
    use App\Models\Property;
    use Auth;
    use Illuminate\Http\Request;

    class DefaultController extends Controller {
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
                'validation' => (object) [
                    'mail' => Mail::$validation,
                ],
            ]);
        }

        /**
         * * Control the panel page.
         * @return \Illuminate\Http\Response
         */
        public function panel () {
            $categories = Category::orderBy('name')->get();
            $locations = Location::orderBy('name')->get();
            $properties = Property::orderBy('name')->get();

            foreach ($properties as $property) {
                $property->files;
            }

            return view('web.panel', [
                'categories' => $categories,
                'locations' => $locations,
                'properties' => $properties,
                'validation' => (object) [
                    'categories' => Category::$validation,
                    'locations' => Location::$validation,
                    'properties' => Property::$validation,
                ],
            ]);
        }

        /**
         * * Control the "thank you" page.
         * @return \Illuminate\Http\Response
         */
        public function thanks () {
            return view('mail.thanks');
        }
    }