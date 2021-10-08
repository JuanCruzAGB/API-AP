import { HTMLCreator as HTMLCreatorJS } from "../submodules/HTMLCreatorJS/js/HTMLCreator.js";
import { InputFileMaker as InputFileMakerJS } from "../submodules/InputFileMakerJS/js/InputFileMaker.js";
import { Gallery as GalleryJS } from "../../submodules/GalleryJS/js/Gallery.js";

let gallery, inputFile;

export function loadImages(files = []){
    let link = document.querySelector('.gallery .selected:not(.gallery-button)');
    if (files.length) {
        for (const key in files) {
            const image = files[key];
            addDomImage(key, image);
        }
        if (link.classList.contains('disabled')) {
            link.classList.remove('disabled');
        }
    } else {
        link.classList.add('disabled');
        hideTrashBtn(document.querySelector('.gallery .selected:not(.gallery-button) .buttons'));
    }
    gallery = new GalleryJS({
        id: 'panel-gallery',
        selected: 0,
    }, {}, {
        function: selectImage,
        params: {
            //
        }
    });
    if (!document.querySelector('#input-file-1')) {
        createButton();
    }
}

export function removeImages(files = []){
    document.querySelector('.gallery .selected:not(.gallery-button) figure img').src = `data:image/jpeg;base64,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`;
    document.querySelector('.files').innerHTML = '';
}

function selectImage(params){
    if (document.querySelector('#propiedades .details-data.updating')) {
        showTrashBtn(document.querySelector('.gallery .selected:not(.gallery-button) .buttons'));
    }
    let link = document.querySelector('.gallery .selected:not(.gallery-button)');
    if (params.gallery.getButtons().length && /http/.exec(params.gallery.getButtons()[params.gallery.getStates('selected')].getProperties('source'))) {
        link.href = params.gallery.getButtons()[params.gallery.getStates('selected')].getProperties('source');
        if (link.classList.contains('disabled')) {
            link.classList.remove('disabled');
        }
    } else {
        link.classList.add('disabled');
        link.href = '#';
    }
    if (!params.gallery.getButtons().length) {
        hideTrashBtn(document.querySelector('.gallery .selected:not(.gallery-button) .buttons'));
    }
}

export function addImage(params){
    let key = document.querySelectorAll('.gallery .files .gallery-button img').length;
    removeDomImage();
    console.log(params.inputfilemaker.getFiles());
    for (const file of params.inputfilemaker.getFiles()) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function(){
            addDomImage(key, reader.result, false);
            gallery.reloadButton();
            if (gallery.getButtons().length == 1) {
                gallery.select(gallery.getButtons()[0].getProperties('id'));
            }
        }
    }
}

export function confirmImage(){
    let source = document.querySelector('.gallery .selected:not(.gallery-button) figure img').src;
    inputFile.removeFile(source);
    let regexp = new RegExp(document.querySelector('[name=asset]').content);
    if (regexp.exec(source)) {
        let input = document.querySelector(`.gallery .files .gallery-button img[src="${ source }"]`).previousElementSibling;
        input.checked = true;
        removeADomImage(source);
    } else {
        deleteADomImage(source);
    }
    gallery.reloadButton();
    let none = true, selected;
    for (const btn of gallery.getButtons()) {
        if (!btn.getHTML().classList.contains('hidden')) {
            none = false;
            selected = btn;
            break;
        }
    }
    hideConfirmBtns(document.querySelector('.gallery .selected:not(.gallery-button) .buttons'));
    if (none) {
        gallery.select();
        hideTrashBtn(document.querySelector('.gallery .selected:not(.gallery-button) .buttons'));
    } else {
        gallery.select(selected.getProperties('id'));
    }
}

export function cancelImage(){
    hideConfirmBtns(document.querySelector('.gallery .selected:not(.gallery-button) .buttons'));
}

export function deleteImage(){
    showConfirmBtns(document.querySelector('.gallery .selected:not(.gallery-button) .buttons'));
}

/**
 * * Add the <img> HTML Element to the gallery.
 * @param {Number} key <img> key.
 * @param {String} route <img> source.
 */
function addDomImage(key, route, asset = true){
    let label = createLabel(key, route);
    let img = createImage(key, route, asset);
    if (key == 0 && asset) {
        document.querySelector('.gallery .selected:not(.gallery-button) figure img').src = `${ document.querySelector('[name=asset]').content }/${ route }`;
        document.querySelector('.gallery .selected:not(.gallery-button)').href = `${ document.querySelector('[name=asset]').content }/${ route }`;
    }
    label.appendChild(img);
    document.querySelector('.files').appendChild(label);
}

/**
 * * Remove the <img> HTML Element to the gallery.
 * @param {String} route <img> source.
 */
function removeDomImage(){
    document.querySelector('.gallery .selected:not(.gallery-button) figure img').src = `data:image/jpeg;base64,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`;
    let childrens = document.querySelectorAll('.files label.generated');
    for (const child of childrens) {
        child.parentNode.removeChild(child);
    }
}

/**
 * * Remove a <img> HTML Element to the gallery.
 * @param {String} route <img> source.
 */
function removeADomImage(route){
    for (const img of document.querySelectorAll('.gallery .files .gallery-button img')) {
        if (img.src == route) {
            img.parentNode.classList.add('hidden');
        }
    }
}

/**
 * * Delete a <img> HTML Element to the gallery.
 * @param {String} route <img> source.
 */
function deleteADomImage(route){
    for (const img of document.querySelectorAll('.gallery .files .gallery-button img')) {
        if (img.src == route) {
            img.parentNode.parentNode.removeChild(img.parentNode);
        }
    }
}

/**
 * * Creates the add image Button.
 */
function createButton(){
    let div = document.createElement('div');
    inputFile = new InputFileMakerJS({
        name: "files[]",
        notFoundMessage: 'No se eligío archivo',
        accept: ['image/jpeg', 'image/png'],
        classes: ['form-input'],
    }, {
        disabled: true,
        generate: true,
        multiple: true,
    }, {
        function: addImage,
        params: {
            //
        },
    }, {
        properties: {
            title: 'Subir imagenes',
            classes: ['add-image', 'mb-3'],
        }, innerHTML: new HTMLCreatorJS('icon', {
            properties: {
                classes: ['fas', 'fa-plus'],
        }}).getHTML(),
    });
    div.appendChild(inputFile.getInputs()[0].getHTML());
    div.appendChild(inputFile.getButton().getHTML());
    div.appendChild(inputFile.getSpan().getHTML());
    document.querySelector('.files').insertBefore(div, document.querySelector('.files').children[0]);
}

/**
 * * Creates the add image Label.
 * @param {Number} key <label> key.
 * @param {String} route <input> value.
 * @returns {HTMLElement}
 */
function createLabel(key, route){
    let label = new HTMLCreatorJS('label', {
        properties: {
            id: `label-${ key }`,
            classes: ((key == 0) ? ['gallery-button', 'mb-3', ((!/property/.exec(route)) ? 'generated' : 'mb-3'), 'selected'] : ['gallery-button', ((!/property/.exec(route)) ? 'generated' : 'mb-3'), 'mb-3']),
        }, input: {
            properties: {
                id: `input-${ key }`,
                name: `deleted_files[${ key }]`,
                defaultValue: route,
                type: 'checkbox',
                classes: ['form-input'],
    }}});
    return label.getHTML();
}

/**
 * * Creates the add image Image.
 * @param {Number} key <img> key.
 * @param {String} route <img> source.
 * @returns {HTMLElement}
 */
function createImage(key, route, asset = true){
    let img = new HTMLCreatorJS('img', {
        properties: {
            id: `img-${ key }`,
            url: ((asset) ? `${ document.querySelector('[name=asset]').content }/${ route }` : route),
            name: `Property image ${ key + 1 }`,
            classes: ['gallery-image', 'm-0'],
    }});
    return img.getHTML();
}

/**
 * * Show the confirm & cancel buttons from the details.
 * @param {HTMLElement} html HTML Element to get buttons.
 */
function showConfirmBtns(html){
    for (const btn of html.children) {
        if (btn.nodeName == 'BUTTON') {
            if (btn.classList.contains('confirm-image') || btn.classList.contains('cancel-image')) {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        }
    }
}

/**
 * * Hide the confirm & cancel buttons from the details.
 * @param {HTMLElement} html HTML Element to get buttons.
 */
function hideConfirmBtns(html){
    for (const btn of html.children) {
        if (btn.nodeName == 'BUTTON') {
            if (btn.classList.contains('confirm-image') || btn.classList.contains('cancel-image')) {
                btn.disabled = true;
            } else {
                btn.disabled = false;
            }
        }
    }
}

/**
 * * Show the trash button from the details.
 * @param {HTMLElement} html HTML Element to get buttons.
 */
export function showTrashBtn(html){
    for (const btn of html.children) {
        if (btn.nodeName == 'BUTTON') {
            if (btn.classList.contains('delete-image')) {
                btn.disabled = false;
            }
        }
    }
}

/**
 * * Hide the trash button from the details.
 * @param {HTMLElement} html HTML Element to get buttons.
 */
export function hideTrashBtn(html){
    for (const btn of html.children) {
        if (btn.nodeName == 'BUTTON') {
            if (btn.classList.contains('delete-image')) {
                btn.disabled = true;
            }
        }
    }
}