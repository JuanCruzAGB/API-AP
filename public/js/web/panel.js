// ? External repositories
import Gallery from "../../submodules/GalleryJS/js/Gallery.js";
import Filter from "../../submodules/FilterJS/js/Filter.js";
import { default as Html } from '../../submodules/HTMLCreatorJS/js/HTMLCreator.js';
import Sidebar from '../../submodules/SidebarJS/js/Sidebar.js';
import TabMenu from '../../submodules/TabMenuJS/js/TabMenu.js';
import { default as URL } from '../../submodules/JuanCruzAGB/js/providers/URLServiceProvider.js';

// ? Local repository
import Asset from "../components/Asset.js";
// import { removeImages, confirmImage, cancelImage, deleteImage, showTrashBtn, hideTrashBtn } from '../gallery.js';
// import { makeHTML as categoryGenerator, enableAdd as enableAddCategory, enableUpdate as enableUpdateCategory, enableDelete as enableDeleteCategory } from '../category/panel.js';
// import { makeHTML as propertyGenerator, enableAdd as enableAddProperty, enableUpdate as enableUpdateProperty, enableDelete as enableDeleteProperty, disableAdd as disableAddProperty, disableUpdate as disableUpdateProperty, confirm as confirmProperty } from '../property/panel.js';
// import { makeHTML as locationGenerator, enableAdd as enableAddLocation, enableUpdate as enableUpdateLocation, enableDelete as enableDeleteLocation } from '../location/panel.js';
// import { View } from '../views.js';

// let view;
// let tables = {
//     categorias: {
//         table: undefined,
//         cells: [{
//             id: 'category-cell-1', type: 'td', name: '', innerHTML: 'id_category:html', tdClasses: ['td-id_category'],
//         }, {
//             id: 'category-cell-2', type: 'td', name: 'Nombre', innerHTML: 'name:html', tdClasses: ['td-name'],
//         }, {
//             id: 'category-cell-3', type: 'td', name: 'Última vez actualizado', innerHTML: 'updated_at:html', tdClasses: ['td-updated_at'],
//         }, {
//             id: 'category-cell-4', type: 'td', name: '', innerHTML: 'actions:html', tdClasses: ['actions', 'px-0'],
//         }],
//         data: categories,
//     }, propiedades: {
//         table: undefined,
//         cells: [{
//             id: 'property-cell-1', type: 'td', name: '', innerHTML: 'id_property:html', tdClasses: ['td-id_property'],
//         }, {
//             id: 'property-cell-2', type: 'td', name: 'Nombre', innerHTML: 'name:html', tdClasses: ['td-name'],
//         }, {
//             id: 'property-cell-3', type: 'td', name: 'Categoría', innerHTML: 'category:name:html', tdClasses: ['td-id_category'],
//         }, {
//             id: 'property-cell-4', type: 'td', name: 'Ubicación', innerHTML: 'location:name:html', tdClasses: ['td-id_location'],
//         }, {
//             id: 'property-cell-5', type: 'td', name: 'Última vez actualizada', innerHTML: 'updated_at:html', tdClasses: ['td-updated_at'],
//         }, {
//             id: 'property-cell-6', type: 'td', name: '', innerHTML: 'actions:html', tdClasses: ['actions', 'px-0'],
//         }],
//         data: properties,
//     }, ubicaciones: {
//         table: undefined,
//         cells: [{
//             id: 'location-cell-1', type: 'td', name: '', innerHTML: 'id_location:html', tdClasses: ['td-id_location'],
//         }, {
//             id: 'location-cell-2', type: 'td', name: 'Nombre', innerHTML: 'name:html', tdClasses: ['td-name'],
//         }, {
//             id: 'location-cell-3', type: 'td', name: 'Última vez actualizada', innerHTML: 'updated_at:html', tdClasses: ['td-updated_at'],
//         }, {
//             id: 'location-cell-4', type: 'td', name: '', innerHTML: 'actions:html', tdClasses: ['actions', 'px-0'],
//         }],
//         data: locations,
// }, };

// /**
//  * * Open the details view.
//  */
// function seeMore(params) {
//     removeImages();
//     view.change({
//         name: 'propiedades',
//         type: 'details'
//     })
//     view.setDetailsData(properties, params.property);
//     hideAddButton();
// }

// categoryGenerator(categories, tables.categorias.table);
// tables.categorias.data = categories;

// propertyGenerator(properties, tables.propiedades.table, seeMore);
// tables.propiedades.data = properties;

// locationGenerator(locations, tables.ubicaciones.table);
// tables.ubicaciones.data = locations;

/**
 * * Change the Category form data.
 * @param {boolean} [slug=false]
 */
function changeCategoryData (slug = false) {
    if (slug) {
        for (const category of categories) {
            if (category.slug == slug) {
                document.querySelector('#categoria form').action = `/categories/${ category.slug }/update`;
                document.querySelector('#categoria form input[name=_method]').value = 'PUT';
                document.querySelector('#categoria form input[name=name]').value = category.name;
            }
        }
    }
    if (!slug) {
        document.querySelector('#categoria form').action = `/categories/create`;
        document.querySelector('#categoria form input[name=_method]').value = 'POST';
        document.querySelector('#categoria form input[name=name]').value = '';
    }
}

/**
 * * Change the <form> <inputs> value data.
 * @param {string} query
 * @param {object} data
 */
function changeFormData (query, data) {
    for (const key in data) {
        if (Object.hasOwnProperty.call(data, key)) {
            if (key == 'action') {
                document.querySelector(query).action = data[key];
            } else {
                let input = document.querySelector(`${ query } [name=${ key }]`);
                switch (input.nodeName) {
                    case 'SELECT':
                        for (const option of input.options) {
                            if (option.value && option.value == data[key]) {
                                option.selected = true;
                            }
                        }
                        break;
                    default:
                        input.value = data[key];
                        break;
                }
            }
        }
    }
}

/**
 * * Change the Location form data.
 * @param {boolean} [slug=false]
 */
function changeLocationData (slug = false) {
    if (slug) {
        for (const location of locations) {
            if (location.slug == slug) {
                document.querySelector('#ubicacion form').action = `/locations/${ location.slug }/update`;
                document.querySelector('#ubicacion form input[name=_method]').value = 'PUT';
                document.querySelector('#ubicacion form input[name=name]').value = location.name;
            }
        }
    }
    if (!slug) {
        document.querySelector('#ubicacion form').action = `/locations/create`;
        document.querySelector('#ubicacion form input[name=_method]').value = 'POST';
        document.querySelector('#ubicacion form input[name=name]').value = '';
    }
}

/**
 * * Change the Property form data.
 * @param {boolean} [slug=false]
 */
function changePropertyData (slug = false) {
    if (slug) {
        for (const property of properties) {
            if (property.slug == slug) {
                changeFormData('#propiedad form', {
                    'action': `/properties/${ property.slug }/update`,
                    '_method': 'PUT',
                    'name': property.name,
                    'description': property.description,
                    'id_category': property.id_category,
                    'id_location': property.id_location,
                });
                for (const key in property.files) {
                    if (Object.hasOwnProperty.call(property.files, key)) {
                        property.files[key] = new Asset('storage/' + property.files[key]).route;
                    }
                }
                createGalleryInputs(property.files);
                new Gallery({
                    props: {
                        id: "gallery-item",
                        images: property.files,
                        classes: {
                            button: ['gallery-item', 'gallery-button'],
                        },
                    }, state: {
                        selected: 'button-0',
                    },
                });
                // <nav class="gallery-menu-list">
                //     <ul>
                //         @foreach ($property->files as $key => $image)
                //             <li>
                //                 @if ($key == 0)
                //                     <button class="gallery-item gallery-button active">
                //                 @else
                //                     <button class="gallery-item gallery-button">
                //                 @endif
                //                     <img src="{{ asset("storage/$image") }}" alt="{{ $property->name }} - Image {{ $key }}">
                //                 </button>
                //             </li>
                //         @endforeach
                //     </ul>
                // </nav>
                // <img class="gallery-item gallery-image md:mr-4 xl:mr-0" src="{{ asset("storage/" . $property->files[0]) }}" alt="{{ $property->name }} - Image selected">
            }
        }
    }
    if (!slug) {
        document.querySelector('#propiedad form').action = `/properties/create`;
        document.querySelector('#propiedad form input[name=_method]').value = 'POST';
        document.querySelector('#propiedad form input[name=name]').value = '';
        document.querySelector('#propiedad form textarea[name=description]').value = '';
        for (const option of document.querySelector('#propiedad form select[name=id_category]').options) {
            option.selected = false;
        }
        for (const option of document.querySelector('#propiedad form select[name=id_location]').options) {
            option.selected = false;
        }
    }
}

/**
 * * Change the panel TabMenu page section.
 * @param {*} params
 */
function changeSection (params) {
    if (['categoria', 'propiedad', 'ubicacion'].indexOf(params.open) >= 0) {
        let slug = URL.params('slug');
        if (params.Tab.state.hasOwnProperty('clicked')) {
            slug = URL.params('slug', params.Tab.state.clicked.href);
        }
        switch (params.open) {
            case 'categoria':
                changeCategoryData(slug);
                break;
            case 'propiedad':
                changePropertyData(slug);
                break;
            case 'ubicacion':
                changeLocationData(slug);
                break;
        }
        hideAddButton();
    }
    if (['categorias', 'propiedades', 'ubicaciones'].indexOf(params.open) >= 0) {
        let section = 'categoria';
        switch (params.open) {
            case 'categorias':
                section = 'categoria';
                break;
            case 'propiedades':
                section = 'propiedad';
                break;
            case 'ubicaciones':
                section = 'ubicacion';
                break;
        }
        [...panel.tabmenu.tabs].pop().setProps('target', section);
        document.querySelector('.add-data').href = `#${ section }`;
        showAddButton();
    }
}

function createGalleryInputs (files) {
    let list = document.querySelector('#propiedad ul.gallery-menu-list');
    console.log(list);
    for (const file of files) {
        let item = new Html('aside', {
            children: [],
        });
        // <li>
        //     @if ($key == 0)
        //         <button class="gallery-item gallery-button active">
        //     @else
        //         <button class="gallery-item gallery-button">
        //     @endif
        //         <img src="{{ asset("storage/$image") }}" alt="{{ $property->name }} - Image {{ $key }}">
        //     </button>
        // </li>
    }
}

/**
 * * Hide the add button
 */
function hideAddButton () {
    document.querySelector('.add-data').classList.add('hidden');
}

/**
 * * Show the add button
 */
function showAddButton () {
    document.querySelector('.add-data').classList.remove('hidden');
}

/**
 * * Removes the <tr> Validation Messages.
 * @param {HTMLElement[]} supports
 */
// function removeValidationMessages(supports) {
//     for (const support of supports) {
//         support.innerHTML = '';
//         support.classList.add('hidden');
//     }
// }

var panel = {};

document.addEventListener('DOMContentLoaded', function (e) {
    new Sidebar({
        props: {
           id: 'panel-sidebar', 
        }, state: {
            open: false,
            viewport: {
                '1024': true,
            },
        },
    });

    panel.tabmenu = new TabMenu({
        props: {
            id: 'panel-tab-menu',
        }, state: {
            open: false,
        }, callbacks: {
            open: {
                function: changeSection,
            },
        },
    });
    panel.tabmenu.open(['categorias', 'categoria', 'propiedades', 'propiedad', 'ubicaciones', 'ubicacion'].indexOf(URL.hash()) >= 0 ? URL.hash() : 'categorias');

    document.querySelector('.add-data').addEventListener('click', function (e) {
        changeCategoryData();
        changePropertyData();
    });

    // for (const html of document.querySelectorAll('table')) {
    //     let element = tables[html.id.split('-table').shift()];
    //     element.table = new Html('table', {
    //         props: {
    //             id: html.id,
    //             classes: [],
    //         }, structure: element.cells,
    //     });
    // }

    // view = new View({
    //     name: 'propiedades',
    //     type: 'table',
    // });
    // view.change({
    //     name: 'ubicaciones',
    //     type: 'table',
    // });
    // view.change({
    //     name: 'categorias',
    //     type: 'table',
    // });
    // showAddButton();
    // switch (URL.hash()) {
    //     case 'propiedades':
    //         if (URL.findGetParameter('name')) {
    //             let slug = URL.findGetParameter('name'),
    //                 key = 0;
    //             for (const property of properties) {
    //                 if (property.slug == slug) {
    //                     if (!URL.findGetParameter('deleting')) {
    //                         view.change({
    //                             name: 'propiedades',
    //                             type: 'details'
    //                         })
    //                         hideAddButton();
    //                         removeImages();
    //                         view.setDetailsData(properties, property);
    //                     }
    //                     key = property.id_property.text - 1;
    //                 }
    //             }
    //             if (URL.findGetParameter('updating')) {
    //                 enableUpdateProperty();
    //             } else if (URL.findGetParameter('deleting')) {
    //                 enableDeleteProperty(key);
    //             }
    //         } else if (URL.findGetParameter('adding')) {
    //             enableAddProperty({
    //                 view: view,
    //                 properties: properties,
    //             });
    //         }
    //         break;
    //     case 'ubicaciones':
    //         if (URL.findGetParameter('adding')) {
    //             enableAddLocation({
    //                 table: tables.ubicaciones.table,
    //             });
    //         } else {
    //             if (URL.findGetParameter('name')) {
    //                 let slug = URL.findGetParameter('name');
    //                 for (const key in locations) {
    //                     const location = locations[key];
    //                     if (location.slug == slug) {
    //                         if (URL.findGetParameter('updating')) {
    //                             enableUpdateLocation({
    //                                 key: key,
    //                             });
    //                         } else {
    //                             enableDeleteLocation({
    //                                 key: key,
    //                             });
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     default:
    //         if (URL.findGetParameter('adding')) {
    //             enableAddCategory({
    //                 table: tables.categorias.table,
    //             });
    //         } else {
    //             if (URL.findGetParameter('name')) {
    //                 let slug = URL.findGetParameter('name');
    //                 for (const key in categories) {
    //                     const category = categories[key];
    //                     if (category.slug == slug) {
    //                         if (URL.findGetParameter('updating')) {
    //                             enableUpdateCategory({
    //                                 key: key,
    //                             });
    //                         } else {
    //                             enableDeleteCategory({
    //                                 key: key,
    //                             });
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //         break;
    // }

    // document.querySelector('.add-data').addEventListener('click', function(e) {
    //     e.preventDefault();
    //     let section = URL.hash();
    //     window.location.href = `#${ section }?adding`;
    //     switch (section) {
    //         case 'propiedades':
    //             enableAddProperty({
    //                 view: view,
    //                 properties: properties,
    //             });
    //             break;
    //         case 'ubicaciones':
    //             enableAddLocation({
    //                 table: tables.ubicaciones.table,
    //             });
    //             break;
    //         default:
    //             enableAddCategory({
    //                 table: tables.categorias.table,
    //             });
    //             break;
    //     }
    // });

    // document.querySelector('.return-data').addEventListener('click', function(e) {
    //     if (URL.findGetParameter().hasOwnProperty('adding')) {
    //         disableAddProperty(view);
    //     } else {
    //         disableUpdateProperty();
    //     }
    //     view.change({
    //         name: 'propiedades',
    //         type: 'table'
    //     })
    //     showAddButton();
    //     removeValidationMessages(document.querySelectorAll('#propiedades .details-data .support'));
    // });

    // document.querySelector('.details-data .edit-data').addEventListener('click', function(e) {
    //     enableUpdateProperty();
    // });

    // document.querySelector('.details-data .confirm-data').addEventListener('click', function(e) {
    //     e.preventDefault();
    //     if (document.querySelector('.details-data').classList.contains('adding')) {
    //         confirmProperty({
    //             mode: 'add'
    //         });
    //     } else {
    //         confirmProperty({
    //             mode: 'update'
    //         });
    //     }
    // });

    // document.querySelector('.details-data .cancel-data').addEventListener('click', function(e) {
    //     if (document.querySelector('.details-data').classList.contains('adding')) {
    //         disableAddProperty(view);
    //         removeValidationMessages(document.querySelectorAll('#propiedades .details-data .support'));
    //     } else {
    //         disableUpdateProperty();
    //     }
    // });

    // document.querySelector('.confirm-image').addEventListener('click', function(e) {
    //     e.preventDefault();
    //     confirmImage();
    // });

    // document.querySelector('.cancel-image').addEventListener('click', function(e) {
    //     e.preventDefault();
    //     cancelImage();
    // });

    // document.querySelector('.delete-image').addEventListener('click', function(e) {
    //     e.preventDefault();
    //     deleteImage();
    // });

    // document.querySelector('.gallery .selected:not(.gallery-button)').addEventListener('click', function(e) {
    //     if (this.classList.contains('disabled')) {
    //         e.preventDefault();
    //     }
    // });
});