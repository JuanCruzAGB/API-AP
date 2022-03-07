<?php
    namespace App\Http\Controllers;

    use App\Models\Category;
    use App\Models\Location;
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
         * @return \Illuminate\Http\Response
         */
        public function list () {
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
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function item (string $slug) {
            $property = $this->model::bySlug($slug)->first();

            return view('property.item', [
                'property' => $property,
            ]);
        }

        /**
         * * Control the "show create" page of Property.
         * @return \Illuminate\Http\Response
         */
        public function showCreate () {
            return view('property.create', [
                // ?
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

            ddd('check files');

            $property = $this->model::create((array) $input);

            $property->update([
                'folder' => "property/$property->id_property",
            ]);

            foreach ($request->file('files') as $file) {
                $filepath = $file->hashName('property/$property->folder');

                $file = Image::make($file)
                        ->resize(500, 400, function($constrait) {
                            $constrait->aspectRatio();
                            $constrait->upsize();
                        });

                Storage::put($filepath, (string) $file->encode());
            }
            
            return redirect('/panel#propiedades')->with('status', [
                'code' => 200,
                'message' => "Propiedad: \"$property->name\" creada correctamente.",
            ]);
        }

        /**
         * * Control the "show update" page of Property.
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function showUpdate (string $slug) {
            $property = $this->model::bySlug($slug)->first();

            return view('property.update', [
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
            
            $property = Property::bySlug($slug)->first();

            ddd($input);

            foreach ($property->files as $file) {
                ddd($file);

                Storage::delete($file);
            }

            foreach ($request->file('files') as $file) {
                $filepath = $file->hashName('property/$property->folder');

                $file = Image::make($file)
                        ->resize(500, 400, function($constrait) {
                            $constrait->aspectRatio();
                            $constrait->upsize();
                        });

                Storage::put($filepath, (string) $file->encode());
            }

            $input->slug = SlugService::createSlug($this->model, 'slug', $input->name);

            $property->update((array) $input);
            
            return redirect('/panel#propiedades')->with('status', [
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

            $property = Property::bySlug($slug)->first();

            if (Storage::exists("property/$property->folder")) {
                Storage::deleteDirectory("property/$property->folder");
            }

            $property->delete();
            
            return redirect('/panel#propiedades')->with('status', [
                'code' => 200,
                'message' => 'Propiedad eliminada correctamente.',
            ]);
        }

        /**
         * * Control the table page.
         * @return \Illuminate\Http\Response
         */
        public function table () {
            $properties = $this->model::orderBy('name')->get();

            foreach ($properties as $property) {
                $property->files;
            }

            return view('property.table', [
                'properties' => $properties,
            ]);
        }
    }