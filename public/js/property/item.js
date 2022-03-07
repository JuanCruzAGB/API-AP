// ? External repository
// import Gallery from "../../submodules/GalleryJS/js/Gallery.js";
import Validation from "../../submodules/ValidationJS/js/Validation.js";

function selectImage (params) {
    document.querySelector(`#property-gallery.gallery .selected:not(.gallery-button)`).href = params.gallery.getImage().getProperties("source");
}

document.addEventListener("DOMContentLoaded", e => {
    // TODO: Gallery
    // new Gallery({
    //     props: {
    //         id: "gallery-item",
    //     }, callbacks: {
    //         function: selectImage,
    //     },
    // });
    
    // TODO: Query form validation
    // new Validation({
    //     props: {
    //         id: "query-form",
    //         ...validation,
    //     },
    // });
});