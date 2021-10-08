// ? External repository
import Gallery from "../../submodules/GalleryJS/js/Gallery.js";
import Validation from "../../submodules/ValidationJS/js/Validation.js";

function selectImage (params) {
    document.querySelector(`#property-gallery.gallery .selected:not(.gallery-button)`).href = params.gallery.getImage().getProperties("source");
}

document.addEventListener("DOMContentLoaded", function(e){
    new Gallery({
        props: {
            id: "gallery-item",
            selected: 0,
        }, callbacks: {
            function: selectImage,
        },
    });

    // new Validation({
    //     props: {
    //         id: "query-form",
    //         ...validation,
    //     },
    // });
});