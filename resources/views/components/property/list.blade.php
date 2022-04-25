<ul class="properties cards">
    @component("components.property.item", [
        "properties" => $properties,
    ])@endcomponent
</ul>

{{-- @if(Route::current()->getName() === "property.list")
    <ul class="filter-paginator d-flex justify-content-center align-items-center">
        <li>
            <a href="#" class="filter-page btn btn-uno-transparent mx-2">
                <i class="filter-icon fas fa-arrow-left"></i>
            </a>
        </li>
        <li>
            <a href="#" class="filter-page active btn btn-uno-transparent mx-2">
                <span class="filter-number">1</span>
            </a>
        </li>
        <li>
            <a href="#" class="filter-page btn btn-uno-transparent mx-2">
                <span class="filter-number">2</span>
            </a>
        </li>
        <li>
            <a href="#" class="filter-page btn btn-uno-transparent mx-2">
                <span class="filter-number">3</span>
            </a>
        </li>
        <li>
            <a href="#" class="filter-page btn btn-uno-transparent mx-2">
                <i class="filter-icon fas fa-arrow-right"></i>
            </a>
        </li>
    </ul>
@endif --}}