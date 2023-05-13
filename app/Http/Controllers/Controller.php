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
     * * Returns the index page.
     * @return \Illuminate\Http\Response
     */
    public function index () {
      return view('catalog', [
        // ? Return variables.
      ]);
    }

    /**
     * * Returns the panel page.
     * @return \Illuminate\Http\Response
     */
    public function panel () {
      return view('panel', [
        // ? Return variables.
      ]);
    }
  }