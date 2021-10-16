<?php
    namespace App\Http\Controllers;

    use App\Models\Category;
    use App\Models\File as FileModel;
    use App\Models\Location;
    use App\Models\Property;
    use App\Models\Mail;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Facades\Validator;
    use Intervention\Image\ImageManagerStatic as Image;
    use Storage;

    class PropertyController extends Controller {
        /**
         * * Control the list page of Properties.
         * @return \Illuminate\Http\Response
         */
        public function list () {
            $categories = Category::all();
            $locations = Location::all();
            $properties = Property::all();

            return view('property.list', [
                'categories' => $categories,
                'locations' => $locations,
                'properties' => $properties,
            ]);
        }

        /**
         * * Control the detail page of Property.
         * @param mixed $slug
         * @return \Illuminate\Http\Response
         */
        public function item ($slug) {
            $property = Property::bySlug($slug);
            if (!$property) {
                abort(404, 'Property does not exist.');
            }

            return view('property.item', [
                'property' => $property,
                'validation' => (object) [
                    'rules' => Mail::$validation['query']['rules'],
                    'messages' => Mail::$validation['query']['messages']['es'],
                ],
            ]);
        }

        /**
         * * Control the Property creation.
         * @param Request $request
         * @return \Illuminate\Http\Response
         */
        public function doCreate (Request $request) {
            $input = (object) $request->all();
            
            $validator = Validator::make($request->all(), Property::$validation['adding']['rules'], Property::$validation['adding']['messages']['es']);
            if ($validator->fails()) {
                dd($validator);
                return redirect('/panel#propiedades?adding')->withErrors($validator)->withInput();
            }
            
            $input->slug = SlugService::createSlug(Property::class, 'slug', $input->name);
            $input->folder = 0;

            if ($request->hasFile('files')) {
                $property = Property::create((array) $input);
                $property->update(['folder' => $property->id_property]);

                foreach ($request->file('files') as $file) {
                    $filepath = $file->hashName('property/$property->folder');
                    $file = Image::make($file)
                            ->resize(500, 400, function($constrait) {
                                $constrait->aspectRatio();
                                $constrait->upsize();
                            });
    
                    Storage::put($filepath, (string) $file->encode());
                }
            } else {
                return redirect('/panel#propiedades?adding')->withInput()->with('status', [
                    'code' => 404,
                    'message' => 'No se adjuntaron imagenes.',
                ]);
            }
            
            return redirect('/panel#propiedades')->with('status', [
                'code' => 200,
                'message' => 'Propiedad: \'$property->name\' creada correctamente.',
            ]);
        }

        /**
         * * Control the Property updating.
         * @param Request $request
         * @param string $slug Property slug.
         * @return \Illuminate\Http\Response
         */
        public function doUpdate (Request $request, $slug) {
            $input = (object) $request->all();
            $property = Property::where('slug', '=', $slug)->get()[0];
            
            $validator = Validator::make($request->all(), Property::$validation['updating']['rules'], Property::$validation['updating']['messages']['es']);
            if ($validator->fails()) {
                return redirect('/panel#propiedades?name=$slug&updating')->withErrors($validator)->withInput();
            }

            if (isset($input->deleted_files) && count($input->deleted_files)) {
                if (count($input->deleted_files) == count(FileModel::getAll('property/$property->folder'))) {
                    if (!$request->hasFile('files') || !count($request->file('files'))) {
                        return redirect('/panel#propiedades?name=$slug&updating')->with('status', [
                            'code' => 404,
                            'message' => 'No se cargaron nuevas imagenes.',
                        ]);
                    }
                }
            }
            
            if ($input->name != $property->name) {
                $input->slug = SlugService::createSlug(Property::class, 'slug', $input->name);
            } else {
                $input->slug = $property->slug;
            }
            $input->folder = $property->folder;

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $filepath = $file->hashName('property/$property->folder');
                    $file = Image::make($file)
                            ->resize(500, 400, function($constrait) {
                                $constrait->aspectRatio();
                                $constrait->upsize();
                            });
    
                    Storage::put($filepath, (string) $file->encode());
                }

                if (isset($input->deleted_files) && count($input->deleted_files)) {
                    foreach ($input->deleted_files as $file) {
                        if (Storage::has($file)) {
                            Storage::delete($file);
                        }
                    }
                }
            }

            $property->update((array) $input);
            
            return redirect('/panel#propiedades')->with('status', [
                'code' => 200,
                'message' => 'Propiedad: \'$property->name\' actualizada correctamente.',
            ]);
        }

        /**
         * * Control the Property deletion.
         * @param Request $request
         * @param string $slug Property slug.
         * @return \Illuminate\Http\Response
         */
        public function doDelete (Request $request, $slug) {
            $input = (object) $request->all();
            $property = Property::where('slug', '=', $slug)->get()[0];

            if (Storage::exists('property/$property->folder')) {
                Storage::deleteDirectory('property/$property->folder');
            }

            $property->delete();
            
            return redirect('/panel#propiedades')->with('status', [
                'code' => 200,
                'message' => 'Propiedad eliminada correctamente.',
            ]);
        }
    }