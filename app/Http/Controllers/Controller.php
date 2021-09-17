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
         * @return [*]
         */
        public function index () {
            $locations = Location::getFavorites()->with("properties")->get();

            return view("web.home", [
                "locations" => $locations,
                "validation" => (object) [
                    "rules" => Mail::$validation["contact"]["rules"],
                    "messages" => Mail::$validation["contact"]["messages"]["es"],
                ],
            ]);
        }
    }