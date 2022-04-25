<?php
    namespace App\Http\Controllers;

    use Auth;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;

    class CategoryController extends Controller {
        /**
         * * The Controller Model.
         * @var \App\Models\Category
         */
        protected $model = \App\Models\Category::class;

        /**
         * * Control the table page.
         * @return \Illuminate\Http\Response
         */
        public function table () {
            $categories = $this->model::orderBy('updated_at', 'desc')->get();

            return view('category.table', [
                'categories' => $categories,
            ]);
        }

        /**
         * * Control the "show create" page of Category.
         * @return \Illuminate\Http\Response
         */
        public function showCreate () {
            return view('category.create', [
                // ?
            ]);
        }

        /**
         * * Execute the Category creation.
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function doCreate (Request $request) {
            $input = (object) $request->all();
            
            $request->validate($this->model::$validation['create']['rules'], $this->model::$validation['create']['messages'][$this->lang]);
            
            $input->slug = SlugService::createSlug($this->model, 'slug', $input->name);

            $input->id_created_by = Auth::user()->id_user;

            $category = $this->model::create((array) $input);
            
            return redirect()->route('category.showUpdate', $category->slug)->with('status', [
                'code' => 200,
                'message' => "Categoría: \"$category->name\" creada correctamente.",
            ]);
        }

        /**
         * * Control the "show update" page of Category.
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function showUpdate (string $slug) {
            $category = $this->model::bySlug($slug)->first();

            return view('category.update', [
                'category' => $category,
            ]);
        }

        /**
         * * Execute the Category update.
         * @param \Illuminate\Http\Request $request
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function doUpdate (Request $request, string $slug) {
            $input = (object) $request->all();

            $request->validate($this->model::$validation['update']['rules'], $this->model::$validation['update']['messages'][$this->lang]);
            
            $category = $this->model::bySlug($slug)->first();
            
            $input->slug = SlugService::createSlug($this->model, 'slug', $input->name);

            $category->update((array) $input);
            
            return redirect()->route('category.showUpdate', $category->slug)->with('status', [
                'code' => 200,
                'message' => "Categoría: \"$category->name\" actualizada correctamente.",
            ]);
        }

        /**
         * * Execute the Category deletion.
         * @param \Illuminate\Http\Request $request
         * @param string $slug
         * @return \Illuminate\Http\Response
         */
        public function doDelete (Request $request, string $slug) {
            $input = (object) $request->all();

            $request->validate($this->model::$validation['delete']['rules'], $this->model::$validation['delete']['messages'][$this->lang]);

            $category = $this->model::bySlug($slug)->first();

            $category->delete();
            
            return redirect()->route('category.table')->with('status', [
                'code' => 200,
                'message' => 'Categoría eliminada correctamente.',
            ]);
        }
    }