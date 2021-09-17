<?php
    namespace App\Http\Controllers;

    use App\Models\Category;
    use App\Models\Location;
    use App\Models\Mail;
    use App\Models\Property;
    use Auth;
    use Illuminate\Http\Request;

    class DefaultController extends Controller{
        /** @var string - The Controller language. */
        protected $lang = 'es';

        /**
         * * Control the web in maintenance.
         * @return [*]
         */
        public function comingSoon(){
            return view('web.coming_soon', [
                // ? Return variables.
            ]);
        }

        /**
         * * Control the home page.
         * @return [*]
         */
        public function home(){
            $locations = Location::getFavorites();
            $favorites = collect([]);
            
            foreach (Location::getFavorites() as $location) {
                $properties = Property::getByLocation($location->id_location);
    
                foreach ($properties as $property) {
                    $property->files();
                }
                
                $object = (object)[
                    'location' => $location,
                    'properties' => $properties,
                ];
                $favorites->push($object);
            }

            return view('web.home', [
                'favorites' => $favorites,
                'validation' => (object) [
                    'rules' => Mail::$validation['contact']['rules'],
                    'messages' => Mail::$validation['contact']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Control the panel page.
         * @return [*]
         */
        public function panel(){
            $categories = Category::all();
            $locations = Location::all();
            $properties = Property::all();

            foreach ($properties as $property) {
                $property->category;
                $property->location;
                $property->files();
            }

            return view('web.panel', [
                'categories' => $categories,
                'locations' => $locations,
                'properties' => $properties,
                'validation' => (object) [
                    'categories' => (object) [
                        'adding' => (object) [
                            'rules' => Category::$validation['adding']['rules'],
                            'messages' => Category::$validation['adding']['messages']['es'],
                        ], 'updating' => (object) [
                            'rules' => Category::$validation['updating']['rules'],
                            'messages' => Category::$validation['updating']['messages']['es'],
                        ], 'deleting' => (object) [
                            'rules' => Category::$validation['deleting']['rules'],
                            'messages' => Category::$validation['deleting']['messages']['es'],
                    ]], 'locations' => (object) [
                        'adding' => (object) [
                            'rules' => Location::$validation['adding']['rules'],
                            'messages' => Location::$validation['adding']['messages']['es'],
                        ], 'updating' => (object) [
                            'rules' => Location::$validation['updating']['rules'],
                            'messages' => Location::$validation['updating']['messages']['es'],
                        ], 'deleting' => (object) [
                            'rules' => Location::$validation['deleting']['rules'],
                            'messages' => Location::$validation['deleting']['messages']['es'],
                    ]], 'properties' => (object) [
                        'adding' => (object) [
                            'rules' => Property::$validation['adding']['rules'],
                            'messages' => Property::$validation['adding']['messages']['es'],
                        ], 'updating' => (object) [
                            'rules' => Property::$validation['updating']['rules'],
                            'messages' => Property::$validation['updating']['messages']['es'],
                        ], 'deleting' => (object) [
                            'rules' => Property::$validation['deleting']['rules'],
                            'messages' => Property::$validation['deleting']['messages']['es'],
                ]]],
            ]);
        }

        /**
         * * Control the "thank you" page.
         * @return [*]
         */
        public function thanks(){
            return view('mail.thanks');
        }
    }