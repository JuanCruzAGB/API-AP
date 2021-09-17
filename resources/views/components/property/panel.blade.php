<section id="propiedades" class="tab-content closed px-3">
    <main class="table-data row relative mx-md-0 hidden">
        <header class="content-header col-12 mx-lg-0 p-md-0">
            <h2 class="MontereyFLF title text-uppercase text-left mt-4 mb-3 mt-md-0 px-2">Propiedades</h2>
        </header>
        <main class="content-table col-12 p-md-0">
            <table id="propiedades-table" class="table"></table>
        </main>
    </main>
    <form id="property-form" action="#" method="post" enctype="multipart/form-data" class="property details-data row relative mx-md-0 hidden">
        <aside class="panel floating-menu top left">
            <a href="#propiedades" class="return-data floating-button btn btn-uno">
                <i class="icon fas fa-angle-left mr-2"></i>
                <span>Regresar</span>
            </a>
        </aside>
        <aside class="panel floating-menu top right d-flex">
            <a href="#propiedades?" title="Editar" class="edit-data floating-button btn btn-uno-transparent btn-icon">
                <i class="icon fas fa-pen"></i>
            </a>
            <a href="#propiedades?" title="Aceptar" class="form-submit property-form confirm-data d-none floating-button btn btn-uno-transparent btn-icon">
                <i class="icon fas fa-check"></i>
            </a>
            <a href="#propiedades?" title="Cancelar" class="cancel-data d-none floating-button btn btn-uno-transparent btn-icon">
                <i class="icon fas fa-times"></i>
            </a>
        </aside>
        @csrf
        @method('PUT')
        <header class="content-header col-12 mx-lg-0 p-md-0">
            <textarea rows="1" disabled type="text" name="name" Placeholder="Nombre de la Propiedad" class="form-input MontereyFLF title text-uppercase text-left mt-4 mt-md-0 px-2"></textarea>
            <span class="Work-Sans support support-box support-name hidden"></span>
        </header>
        <main class="content-data col-12 p-md-0">
            <div class="row">
                <section id="panel-gallery" class="gallery col-12 col-md-6 px-3">
                    <div class="row justify-content-between px-3 pr-md-0">
                        <div class="files p-0">
                            <button disabled class="add-image mb-3">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <a target="_blank" href="#" class="selected overflow-hidden p-0">
                            <figure class="m-0">
                                <img class="gallery-image zoom" src="" alt="Property 1 - Image 1">
                                <span class="not-found hidden">
                                    <img class="gallery-image zoom" src="data:image/jpeg;base64,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" alt="Image not found">
                                </span>
                            </figure>
                            <div class="buttons">
                                <button disabled class="confirm-image btn btn-uno btn-icon">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button disabled class="cancel-image btn btn-uno btn-icon">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button disabled class="delete-image btn btn-uno btn-icon">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </a>
                        <span class="Work-Sans support support-box support-files hidden"></span>
                    </div>
                </section>
                <section class="details col-12 col-md-6 px-3">
                    <header class="header mb-3">
                        <div class="h5 text-left MontereyFLF mb-0 mt-4 mt-md-0">
                            <select name="id_category" disabled class="form-input category d-block color-red">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id_category }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="Work-Sans support support-box support-id_category hidden"></span>
                            <select name="id_location" disabled class="form-input location d-block color-grey">
                                @foreach ($locations as $location)
                                <option value="{{ $location->id_location }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                            <span class="Work-Sans support support-box support-id_location hidden"></span>
                        </div>
                    </header>
                    <main>
                        <textarea name="description" class="form-input description" disabled placeholder="Description"></textarea>
                        <span class="Work-Sans support support-box support-description hidden"></span>
                    </main>
                </section>
            </div>
        </main>
    </form>
</section>