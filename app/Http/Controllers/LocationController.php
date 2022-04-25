<?php
    namespace App\Http\Controllers;

    use Auth;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;

    class LocationController extends Controller{
        /**
         * * The Controller Model.
         * @var \App\Models\Location
         */
        protected $model = \App\Models\Location::class;

        /**
         * * Control the table page.
         * @return \Illuminate\Http\Response
         */
        public function table () {
            $locations = $this->model::orderBy('updated_at', 'desc')->get();

            return view('location.table', [
                'locations' => $locations,
            ]);
        }

        /**
         * * Control the "show create" page of Location.
         * @return \Illuminate\Http\Response
         */
        public function showCreate () {
            return view('location.create', [
                // ?
            ]);
        }

        /**
         * * Execute the Location creation.
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function doCreate (Request $request) {
            $input = (object) $request->all();
            
            $request->validate($this->model::$validation['create']['rules'], $this->model::$validation['create']['messages'][$this->lang]);
            
            $input->slug = SlugService::createSlug($this->model, 'slug', $input->name);

            $input->id_created_by = Auth::user()->id_user;

            $location = $this->model::create((array) $input);
            
            return redirect()->route('location.showUpdate', $location->slug)->with('status', [
                'code' => 200,
                'message' => "Ubicación: \"$location->name\" creada correctamente.",
            ]);
        }

        /**
         * * Control the "show update" page of Location.
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function showUpdate (string $slug) {
            $location = $this->model::bySlug($slug)->first();

            return view('location.update', [
                'location' => $location,
            ]);
        }

        /**
         * * Execute the Location update.
         * @param \Illuminate\Http\Request $request
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function doUpdate (Request $request, string $slug) {
            $input = (object) $request->all();

            $request->validate($this->model::$validation['update']['rules'], $this->model::$validation['update']['messages'][$this->lang]);
            
            $location = $this->model::bySlug($slug)->first();
            
            $input->slug = SlugService::createSlug($this->model, 'slug', $input->name);
            
            $location->update((array) $input);
            
            return redirect()->route('location.showUpdate', $location->slug)->with('status', [
                'code' => 200,
                'message' => "Ubicación: \"$location->name\" actualizada correctamente.",
            ]);
        }

        /**
         * * Execute the Location deletion.
         * @param \Illuminate\Http\Request $request
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function doDelete (Request $request, string $slug) {
            $input = (object) $request->all();

            $request->validate($this->model::$validation['delete']['rules'], $this->model::$validation['delete']['messages'][$this->lang]);

            $location = $this->model::bySlug($slug)->first();

            $location->delete();
            
            return redirect()->route('location.table')->with('status', [
                'code' => 200,
                'message' => 'Ubicación eliminada correctamente.',
            ]);
        }

        /**
         * * Execute the add Location to favorite.
         * @param \Illuminate\Http\Request $request
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function doFav (Request $request, string $slug) {
            $input = (object) $request->all();

            $request->validate($this->model::$validation['fav']['rules'], $this->model::$validation['fav']['messages'][$this->lang]);

            $location = $this->model::bySlug($slug)->first();

            $location->update([
                'favorite' => !$location->favorite,
            ]);
            
            return redirect()->route('location.table')->with('status', [
                'code' => 200,
                'message' => $location->favorite ? "$location->name se agrego de favoritos" : "$location->name se quito de favoritos",
            ]);
        }
    }