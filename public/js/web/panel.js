// ? External repositories
import { URLServiceProvider as URL } from "../../submodules/ProvidersJS/URLServiceProvider.js";
import { TabMenu as TabMenuJS } from "../../submodules/TabMenuJS/js/TabMenu.js";
import { HTMLCreator as HTMLCreatorJS } from "../../submodules/HTMLCreatorJS/js/HTMLCreator.js";

// ? Local repository
import { removeImages, confirmImage, cancelImage, deleteImage, showTrashBtn, hideTrashBtn } from "../gallery.js";
import { makeHTML as categoryGenerator, enableAdd as enableAddCategory, enableUpdate as enableUpdateCategory, enableDelete as enableDeleteCategory } from "../category/panel.js";
import { makeHTML as propertyGenerator, enableAdd as enableAddProperty, enableUpdate as enableUpdateProperty, enableDelete as enableDeleteProperty, disableAdd as disableAddProperty, disableUpdate as disableUpdateProperty, confirm as confirmProperty } from "../property/panel.js";
import { makeHTML as locationGenerator, enableAdd as enableAddLocation, enableUpdate as enableUpdateLocation, enableDelete as enableDeleteLocation } from "../location/panel.js";
import { View } from "../views.js";

let view;
let tables = {
    categorias: {
        table: undefined,
        cells: [{
            id: 'category-cell-1', type: 'td', name: '', innerHTML: 'id_category:html', tdClasses: ['td-id_category'],
        }, {
            id: 'category-cell-2', type: 'td', name: 'Nombre', innerHTML: 'name:html', tdClasses: ['td-name'],
        }, {
            id: 'category-cell-3', type: 'td', name: 'Última vez actualizado', innerHTML: 'updated_at:html', tdClasses: ['td-updated_at'],
        }, {
            id: 'category-cell-4', type: 'td', name: '', innerHTML: 'actions:html', tdClasses: ['actions', 'px-0'],
        }],
        data: categories,
    }, propiedades: {
        table: undefined,
        cells: [{
            id: 'property-cell-1', type: 'td', name: '', innerHTML: 'id_property:html', tdClasses: ['td-id_property'],
        }, {
            id: 'property-cell-2', type: 'td', name: 'Nombre', innerHTML: 'name:html', tdClasses: ['td-name'],
        }, {
            id: 'property-cell-3', type: 'td', name: 'Categoría', innerHTML: 'category:name:html', tdClasses: ['td-id_category'],
        }, {
            id: 'property-cell-4', type: 'td', name: 'Ubicación', innerHTML: 'location:name:html', tdClasses: ['td-id_location'],
        }, {
            id: 'property-cell-5', type: 'td', name: 'Última vez actualizada', innerHTML: 'updated_at:html', tdClasses: ['td-updated_at'],
        }, {
            id: 'property-cell-6', type: 'td', name: '', innerHTML: 'actions:html', tdClasses: ['actions', 'px-0'],
        }],
        data: properties,
    }, ubicaciones: {
        table: undefined,
        cells: [{
            id: 'location-cell-1', type: 'td', name: '', innerHTML: 'id_location:html', tdClasses: ['td-id_location'],
        }, {
            id: 'location-cell-2', type: 'td', name: 'Nombre', innerHTML: 'name:html', tdClasses: ['td-name'],
        }, {
            id: 'location-cell-3', type: 'td', name: 'Última vez actualizada', innerHTML: 'updated_at:html', tdClasses: ['td-updated_at'],
        }, {
            id: 'location-cell-4', type: 'td', name: '', innerHTML: 'actions:html', tdClasses: ['actions', 'px-0'],
        }],
        data: locations,
}, };

/**
 * * Open the details view.
 */
function seeMore(params) {
    removeImages();
    view.change({
        name: 'propiedades',
        type: 'details'
    })
    view.setDetailsData(properties, params.property);
    hideAddButton();
}

categoryGenerator(categories, tables.categorias.table);
tables.categorias.data = categories;

propertyGenerator(properties, tables.propiedades.table, seeMore);
tables.propiedades.data = properties;

locationGenerator(locations, tables.ubicaciones.table);
tables.ubicaciones.data = locations;

/**
 * * Show the add button
 */
function showAddButton(){
    document.querySelector('.add-data').classList.remove('d-none');
}

/**
 * * Hide the add button
 */
function hideAddButton(){
    document.querySelector('.add-data').classList.add('d-none');
}

/**
 * * Change the panel page section.
 * @export
 * @param {*} params
 */
export function changeSection(params){
    if (document.querySelector(`#${ params.tabmenu.getStates('open') } .adding`) || document.querySelector(`#${ params.tabmenu.getStates('open') } .table-data.hidden`)) {
        hideAddButton();
    } else {
        showAddButton();
    }
}

/**
 * * Removes the <tr> Validation Messages.
 * @param {HTMLElement[]} supports
 */
function removeValidationMessages(supports){
    for (const support of supports) {
        support.innerHTML = '';
        support.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function(e){
    if(document.querySelectorAll('.tab-menu').length){
        let tabmenus = [];
        for (const html of document.querySelectorAll('.tab-menu')) {
            let tabmenu = new TabMenuJS({
                id: html.id,
            }, {
                open: false,
                active: false,
            }, {
                function: changeSection,
                params: {
                    //
            }});
            if (URL.findHashParameter()) {
                let opened = [URL.findHashParameter()];
                tabmenu.open(opened);
            } else if (document.querySelectorAll('.tab-menu .opened').length) {
                let opened = [];
                for (const content of document.querySelectorAll('.tab-menu .opened')) {
                    opened.push(content.id);
                }

                tabmenu.open(opened);
            }
            tabmenus.push(tabmenu);
        }
    }

    for (const html of document.querySelectorAll('table')) {
        let element = tables[html.id.split('-table').shift()];
        element.table = new HTMLCreatorJS('table', {
            properties: {
                id: html.id,
                trClasses: {
                    thead: ['background', 'bg-one', 'color-white'],
                    tbody: [],
            }}, cells: element.cells,
            data: element.data,
        });
    }

    view = new View({
        name: 'propiedades',
        type: 'table',
    });
    view.change({
        name: 'ubicaciones',
        type: 'table',
    });
    view.change({
        name: 'categorias',
        type: 'table',
    });
    showAddButton();
    switch (URL.findHashParameter()) {
        case 'propiedades':
            if (URL.findGetParameter('name')) {
                let slug = URL.findGetParameter('name'),
                    key = 0;
                for (const property of properties) {
                    if (property.slug == slug) {
                        if (!URL.findGetParameter('deleting')) {
                            view.change({
                                name: 'propiedades',
                                type: 'details'
                            })
                            hideAddButton();
                            removeImages();
                            view.setDetailsData(properties, property);
                        }
                        key = property.id_property.text - 1;
                    }
                }
                if (URL.findGetParameter('updating')) {
                    enableUpdateProperty();
                } else if (URL.findGetParameter('deleting')) {
                    enableDeleteProperty(key);
                }
            } else if (URL.findGetParameter('adding')) {
                enableAddProperty({
                    view: view,
                    properties: properties,
                });
            }
            break;
        case 'ubicaciones':
            if (URL.findGetParameter('adding')) {
                enableAddLocation({
                    table: tables.ubicaciones.table,
                });
            } else {
                if (URL.findGetParameter('name')) {
                    let slug = URL.findGetParameter('name');
                    for (const key in locations) {
                        const location = locations[key];
                        if (location.slug == slug) {
                            if (URL.findGetParameter('updating')) {
                                enableUpdateLocation({
                                    key: key,
                                });
                            } else {
                                enableDeleteLocation({
                                    key: key,
                                });
                            }
                        }
                    }
                }
            }
        default:
            if (URL.findGetParameter('adding')) {
                enableAddCategory({
                    table: tables.categorias.table,
                });
            } else {
                if (URL.findGetParameter('name')) {
                    let slug = URL.findGetParameter('name');
                    for (const key in categories) {
                        const category = categories[key];
                        if (category.slug == slug) {
                            if (URL.findGetParameter('updating')) {
                                enableUpdateCategory({
                                    key: key,
                                });
                            } else {
                                enableDeleteCategory({
                                    key: key,
                                });
                            }
                        }
                    }
                }
            }
            break;
    }

    document.querySelector('.add-data').addEventListener('click', function(e){
        e.preventDefault();
        let section = URL.findHashParameter();
        window.location.href = `#${ section }?adding`;
        switch (section) {
            case 'propiedades':
                enableAddProperty({
                    view: view,
                    properties: properties,
                });
                break;
            case 'ubicaciones':
                enableAddLocation({
                    table: tables.ubicaciones.table,
                });
                break;
            default:
                enableAddCategory({
                    table: tables.categorias.table,
                });
                break;
        }
    });

    document.querySelector('.return-data').addEventListener('click', function(e){
        if (URL.findGetParameter().hasOwnProperty('adding')) {
            disableAddProperty(view);
        } else {
            disableUpdateProperty();
        }
        view.change({
            name: 'propiedades',
            type: 'table'
        })
        showAddButton();
        removeValidationMessages(document.querySelectorAll('#propiedades .details-data .support'));
    });

    document.querySelector('.details-data .edit-data').addEventListener('click', function(e){
        enableUpdateProperty();
    });

    document.querySelector('.details-data .confirm-data').addEventListener('click', function(e){
        e.preventDefault();
        if (document.querySelector('.details-data').classList.contains('adding')) {
            confirmProperty({
                mode: 'add'
            });
        } else {
            confirmProperty({
                mode: 'update'
            });
        }
    });

    document.querySelector('.details-data .cancel-data').addEventListener('click', function(e){
        if (document.querySelector('.details-data').classList.contains('adding')) {
            disableAddProperty(view);
            removeValidationMessages(document.querySelectorAll('#propiedades .details-data .support'));
        } else {
            disableUpdateProperty();
        }
    });

    document.querySelector('.confirm-image').addEventListener('click', function(e){
        e.preventDefault();
        confirmImage();
    });

    document.querySelector('.cancel-image').addEventListener('click', function(e){
        e.preventDefault();
        cancelImage();
    });

    document.querySelector('.delete-image').addEventListener('click', function(e){
        e.preventDefault();
        deleteImage();
    });

    document.querySelector('.gallery .selected:not(.gallery-button)').addEventListener('click', function(e){
        if (this.classList.contains('disabled')) {
            e.preventDefault();
        }
    });
});