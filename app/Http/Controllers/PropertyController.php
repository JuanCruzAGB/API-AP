<?php
    namespace App\Http\Controllers;

    use App\Models\Category;
    use App\Models\Location;
    use Auth;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;
    use Intervention\Image\ImageManagerStatic as Image;
    use Storage;

    class PropertyController extends Controller {
        /**
         * * The Controller Model.
         * @var \App\Models\Property
         */
        protected $model = \App\Models\Property::class;

        /**
         * * Control the list page of Properties.
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function list (Request $request) {
            $categories = Category::all();
            $locations = Location::all();
            $properties = $this->model::all();

            return view('property.list', [
                'categories' => $categories,
                'locations' => $locations,
                'properties' => $properties,
            ]);
        }

        /**
         * * Control the detail page of Property.
         * @param \Illuminate\Http\Request $request
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function item (Request $request, string $slug) {
            $property = $this->model::bySlug($slug)->first();

            return view('property.item', [
                'property' => $property,
            ]);
        }

        /**
         * * Control the table page.
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function table (Request $request) {
            $properties = $this->model::orderBy('updated_at', 'desc')->get();

            foreach ($properties as $property) {
                $property->files;
            }

            return view('property.table', [
                'properties' => $properties,
            ]);
        }

        /**
         * * Control the "show create" page of Property.
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function showCreate (Request $request) {
            $categories = Category::all();
            $locations = Location::all();

            return view('property.create', [
                'categories' => $categories,
                'locations' => $locations,
            ]);
        }

        /**
         * * Execute the Property creation.
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function doCreate (Request $request) {
            $input = (object) $request->all();
            
            $request->validate($this->model::$validation['create']['rules'], $this->model::$validation['create']['messages'][$this->lang]);
            
            $input->slug = SlugService::createSlug($this->model, 'slug', $input->name);

            $input->folder = 0;

            $input->id_created_by = Auth::user()->id_user;

            $property = $this->model::create((array) $input);

            $property->update([
                'folder' => "property/$property->id_property",
            ]);

            foreach ($request->file('files') as $file) {
                $filepath = $file->hashName($property->folder);

                $file = Image::make($file)
                        ->resize(500, 400, function($constrait) {
                            $constrait->aspectRatio();
                            $constrait->upsize();
                        });

                Storage::put($filepath, (string) $file->encode());
            }
            
            return redirect()->route('property.showUpdate', $property->slug)->with('status', [
                'code' => 200,
                'message' => "Propiedad: \"$property->name\" creada correctamente.",
            ]);
        }

        /**
         * * Control the "show update" page of Property.
         * @param \Illuminate\Http\Request $request
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function showUpdate (Request $request, string $slug) {
            $categories = Category::all();
            $locations = Location::all();
            $property = $this->model::bySlug($slug)->first();

            return view('property.update', [
                'categories' => $categories,
                'locations' => $locations,
                'property' => $property,
            ]);
        }

        /**
         * * Execute the Property update.
         * @param \Illuminate\Http\Request $request
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function doUpdate (Request $request, string $slug) {
            $input = (object) $request->all();

            $request->validate($this->model::$validation['update']['rules'], $this->model::$validation['update']['messages'][$this->lang]);
            
            $property = $this->model::bySlug($slug)->first();

            $input->slug = SlugService::createSlug($this->model, 'slug', $input->name);

            $property->update((array) $input);
            
            return redirect()->route('property.showUpdate', $property->slug)->with('status', [
                'code' => 200,
                'message' => "Propiedad: \"$property->name\" actualizada correctamente.",
            ]);
        }

        /**
         * * Execute the Property deletion.
         * @param \Illuminate\Http\Request $request
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function doDelete (Request $request, string $slug) {
            $input = (object) $request->all();

            $request->validate($this->model::$validation['delete']['rules'], $this->model::$validation['delete']['messages'][$this->lang]);

            $property = $this->model::bySlug($slug)->first();

            if (Storage::exists($property->folder)) {
                Storage::deleteDirectory($property->folder);
            }

            $property->delete();
            
            return redirect()->route('property.table')->with('status', [
                'code' => 200,
                'message' => 'Propiedad eliminada correctamente.',
            ]);
        }

        /**
         * * Control the "show folder" page of Property.
         * @param \Illuminate\Http\Request $request
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function showFolder (Request $request, string $slug) {
            $property = $this->model::bySlug($slug)->first();

            return view('property.folder', [
                'property' => $property,
            ]);
        }

        /**
         * * Executes the Property update folder.
         * @param \Illuminate\Http\Request $request
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function doFolder (Request $request, string $slug) {
            $input = (object) $request->all();

            $request->validate($this->model::$validation['folder']['rules'], $this->model::$validation['folder']['messages'][$this->lang]);
            
            $property = $this->model::bySlug($slug)->first();

            if (isset($input->list)) {
                foreach ($input->list as $key => $value) {
                    if (isset($property->files[$key])) {
                        Storage::delete($property->files[$key]);
                    }
                }
            }

            if (isset($input->files)) {
                foreach ($request->file('files') as $file) {
                    $filepath = $file->hashName($property->folder);
    
                    $file = Image::make($file)
                            ->resize(500, 400, function($constrait) {
                                $constrait->aspectRatio();
                                $constrait->upsize();
                            });
    
                    Storage::put($filepath, (string) $file->encode());
                }
            }
            
            return redirect()->route('property.showFolder', $property->slug)->with('status', [
                'code' => 200,
                'message' => "Propiedad: \"$property->name\" archivos actualizados correctamente.",
            ]);
        }
    }