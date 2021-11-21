// ? External repositories
import Gallery from '../../submodules/GalleryJS/js/Gallery.js';
import Filter from '../../submodules/FilterJS/js/Filter.js';
import { default as Html } from '../../submodules/HTMLCreatorJS/js/HTMLCreator.js';
import Sidebar from '../../submodules/SidebarJS/js/Sidebar.js';
import TabMenu from '../../submodules/TabMenuJS/js/TabMenu.js';
import { default as URL } from '../../submodules/JuanCruzAGB/js/providers/URLServiceProvider.js';

// ? Local repository
import Asset from '../components/Asset.js';

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
 * * Change the Gallery items index.
 * @param {object} params
 */
function changeIndex (params = {}) {
    for (const key in params.property.items) {
        if (Object.hasOwnProperty.call(params.property.items, key)) {
            const item = params.property.items[key];
            const input = item.children[1].children[0];
            if (params.Html.props.id == input.props.id) {
                item.style = { 'order': input.html.value };
            } else {
                if (params.Html.props.prevValue < params.Html.html.value) {
                    if (input.html.value <= params.Html.html.value && input.html.value >= params.Html.props.prevValue) {
                        input.value = parseInt(input.html.value) - 1;
                        item.style = { 'order': input.html.value };
                    }
                }
                if (params.Html.props.prevValue > params.Html.html.value) {
                    if (input.html.value <= params.Html.props.prevValue && input.html.value >= params.Html.html.value) {
                        input.value = parseInt(input.html.value) + 1;
                        item.style = { 'order': input.html.value };
                    }
                }
            }
        }
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
                document.querySelector('#propiedad .title a').href = `/properties/${ property.slug }/details`;
                changeFormData('#propiedad form', {
                    'action': `/properties/${ property.slug }/update`,
                    '_method': 'PUT',
                    'name': property.name,
                    'description': property.description,
                    'id_category': property.id_category,
                    'id_location': property.id_location,
                });
                // createPropertyGalleryInputs(property);
                for (const key in property.files) {
                    if (Object.hasOwnProperty.call(property.files, key)) {
                        property.files[key] = new Asset(`storage/${ property.files[key] }`).route;
                    }
                }
                property.gallery = new Html('gallery', {
                    props: {
                        id: 'gallery-item',
                        images: property.files,
                        nodeName: 'DIV',
                    }, state: {
                        inputs: true,
                        preventDefault: false,
                    }, parentNode: document.querySelector('#propiedad form main .property-gallery'),
                });
            }
        }
    }
    if (!slug) {
        document.querySelector('#propiedad .title a').href = `#propiedad`;
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

/**
 * * Creates the Property Gallery.
 * @param {Property} property
 */
function createPropertyGalleryInputs (property) {
    let list = document.querySelector('#propiedad ul.gallery-menu-list');
    list.innerHTML = '';
    property.items = [];
    for (const key in property.files) {
        if (Object.hasOwnProperty.call(property.files, key)) {
            createPropertyGalleryItem(property, key);
        }
    }
    // createPropertyGalleryItemInputFile(property);
}

/**
 * * Creates a Property Gallery item.
 * @param {Property} property
 * @param {number} key
 */
function createPropertyGalleryItem (property, key = 1) {
    let item = new Html('li', {
        props: {
            id: `li-${ parseInt(key) + 1 }`,
            classList: ['grid', 'grid-cols-2'],
            style: { 'order': parseInt(key) + 1, },
        }, children: (() => {
            return createPropertyGalleryItemChildren(property, key);
        })(), parentNode: document.querySelector('#propiedad ul.gallery-menu-list'),
    });
    property.items.push(item);
}

/**
 * * Creates the Property Gallery item children.
 * @param {*} property
 * @param {number} key
 * @returns {array}
 */
function createPropertyGalleryItemChildren (property, key = 1) {
    return [
        createPropertyGalleryItemChildrenButton(property, key),
        createPropertyGalleryItemChildrenPositionInput(property, key),
        ...createPropertyGalleryItemChildrenTrashInput(property, key),
    ];
}

/**
 * * Creates the Property Gallery item Button children.
 * @param {*} property
 * @param {number} key
 * @returns {array}
 */
function createPropertyGalleryItemChildrenButton (property, key = 1) {
    return ['button', {
        props: {
            classList: (() => {
                let classList = ['gallery-item', 'gallery-button', 'col-span-2'];
                if (key == 0) {
                    classList.push('active');
                }
                return classList
            })(),
        }, children: [
            ['img', {
                props: {
                    src: new Asset('storage/' + property.files[key]).route,
                    name: 'Gallery image',
                },
            }],
        ],
    }];
}

/**
 * * Creates the Property Gallery item position input children.
 * @param {*} property
 * @param {number} key
 * @returns {array}
 */
function createPropertyGalleryItemChildrenPositionInput (property, key = 1) {
    return ['label', {
        props: {
            classList: ['field'],
        }, children: [
            ['input', {
                props: {
                    name: `position[${ key }]`,
                    type: 'number',
                    defaultValue: parseInt(key) + 1,
                    classList: [],
                }, state: {
                    checked: true,
                }, callbacks: {
                    change: {
                        function: changeIndex,
                        params: {
                            property: property,
                        },
                    },
                }, 
            }],
        ],
    }];
}

/**
 * * Creates the Property Gallery item trash input children.
 * @param {*} property
 * @param {number} key
 * @returns {array}
 */
function createPropertyGalleryItemChildrenTrashInput (property, key = 1) {
    return [
        ['input', {
            props: {
                id: `remove-${ parseInt(key) + 1 }`,
                name: `remove[${ property.files[key] }]`,
                type: 'checkbox',
                defaultValue: property.files[key],
                classList: ['hidden'],
            }, state: {
                id: true,
            },
        }], ['label', {
            props: {
                for: `remove-${ parseInt(key) + 1 }`,
                classList: ['btn', 'btn-icon-bg', 'btn-red'],
            }, children: [
                ['icon', {
                    props: {
                        classList: ['fas', 'fa-trash'],
                    },
                }],
            ],
        }],
    ];
}

/**
 * * Creates a Property Gallery item.
 * @param {Property} property
 * @param {number} key
 */
function createPropertyGalleryItemInputFile (property) {
    let item = new Html('li', {
        props: {
            classList: ['grid', 'grid-cols-2'],
            id: `li-custom`,
            style: { 'order': 0, },
        }, children: [
            ['custominput', {
                state: {
                    hidden: true,
                }, callbacks: {
                    change: {
                        function: (params) => { console.log(params); },
                        params: {
                            property: property,
                        },
                    },
                }, button: {
                    props: {
                        classList: ['btn', 'btn-icon-bg', 'btn-red', 'col-span-2'],
                    }, children: [
                        ['icon', {
                            props: {
                                classList: ['fas', 'fa-plus'],
                            },
                        }],
                    ],
                }, image: {
                    // parentNode: createPropertyGalleryItemInputImage(),
                },
                // <li class="grid grid-cols-2" style="order: 2;">
                //     <button class="gallery-item gallery-button col-span-2">
                //         <img src="http://localhost:8000/storage/property/2/02.jpg" alt="Gallery image">
                //     </button>
                //     <label class="field">
                //         <input name="position[1]" type="number" value="2" placeholder="" checked="">
                //     </label>
                //     <input id="remove-2" class="hidden" name="remove[property/2/02.jpg]" type="checkbox" value="property/2/02.jpg" placeholder="">
                //     <label class="btn btn-icon-bg btn-red" for="remove-2">
                //         <i class="fas fa-trash"></i>
                //     </label>
                // </li>
            }],
        ], parentNode: document.querySelector('#propiedad ul.gallery-menu-list'),
    });
}

function createPropertyGalleryItemInputImage () {
    return ['li', {
        
    }];
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

var panel = {};

document.addEventListener('DOMContentLoaded', async function (e) {
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
});