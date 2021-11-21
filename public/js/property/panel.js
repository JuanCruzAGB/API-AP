// ? External repositories
import { HTMLCreator as HTMLCreatorJS } from "../../submodules/HTMLCreatorJS/js/HTMLCreator.js";
import { URLServiceProvider as URL } from "../../submodules/ProvidersJS/URLServiceProvider.js";
import { Validation as ValidationJS } from "../../submodules/ValidationJS/js/Validation.js";

// ? Local reposiroty
import { removeImages, showTrashBtn, hideTrashBtn } from "../gallery.js";

/**
 * * Generate the date correctly.
 * @param {String} dateToParse Date to correct.
 * @returns {String}
 */
function parseDate(dateToParse){
    let daysOfTheMonths = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]; 
    let date = dateToParse.split('T')[0],
        time = dateToParse.split('T')[1].split('.')[0];
    let years, months, days;
    if(/-/.exec(date)){
        years = parseInt(date.split('-')[0]);
        months = parseInt(date.split('-')[1]);
        days = parseInt(date.split('-')[2]);
    }else if(/\//.exec(date)){
        years = parseInt(date.split('/')[0]);
        months = parseInt(date.split('/')[1]);
        days = parseInt(date.split('/')[2]);
    }
    let hours = parseInt(time.split(':')[0]),
        minutes = parseInt(time.split(':')[1]),
        seconds = parseInt(time.split(':')[2]);
    let length;
    if(length = parseInt(seconds / 60)){
        seconds = seconds - (60 * length);
        for (let i=1; i <= length; i++) { 
            minutes++;
        }
    }
    if(seconds < 10){
        seconds = `0${ seconds }`;
    }
    if(length = parseInt(minutes / 60)){
        minutes = minutes - (60 * length);
        for (let i=1; i <= length; i++) { 
            hours++;
        }
    }
    if(minutes < 10){
        minutes = `0${ minutes }`;
    }
    if(length = parseInt(hours / 24)){
        hours = hours - (24 * length);
        for (let i=1; i <= length; i++) { 
            days++;
        }
    }
    if(hours < 10){
        hours = `0${ hours }`;
    }
    if(length = parseInt(months / 12)){
        months = months - (12 * length);
        for (let i=1; i <= length; i++) { 
            years++;
        }
    }
    if(length = parseInt(days / daysOfTheMonths[months])){
        days = days - (daysOfTheMonths[months] * length);
        for (let i=1; i <= length; i++) { 
            months++;
        }
    }
    if(days < 10){
        days = `0${ days }`;
    }
    if(length = parseInt(months / 12)){
        months = months - (12 * length);
        for (let i=1; i <= length; i++) { 
            years++;
        }
    }
    if(months < 10){
        months = `0${ months }`;
    }

    return `${ years }-${ months }-${ days } ${ hours }:${ minutes }:${ seconds }`;
}

/**
 * * Enable the Property addion.
 * @param {Object} params
 */
export function enableAdd(params){
    hideTrashBtn(document.querySelector('.gallery .selected:not(.gallery-button) .buttons'));
    document.querySelector('.details-data .cancel-data').href = `#propiedades`;
    params.view.change({
        name: 'propiedades',
        type: 'details'
    })
    hideAddButton();
    removeImages();
    params.view.setDetailsData(params.properties);
    let inputs = document.querySelectorAll('.details-data textarea, .details-data select, .property .gallery .files button');
    for (const input of inputs) {
        input.disabled = false;
    }
    document.querySelector(`#propiedades .details-data`).classList.add('adding');
    showConfirmBtns(document.querySelector(`#propiedades .details-data .floating-menu.right`));
}

/**
 * * Enable the Property updation.
 */
export function enableUpdate(){
    showTrashBtn(document.querySelector('.gallery .selected:not(.gallery-button) .buttons'));
    document.querySelector('.details-data .cancel-data').href = `#${ URL.findHashParameter().split('&')[0] }`;
    let inputs = document.querySelectorAll('.details-data textarea, .details-data select, .property .gallery .files button');
    for (const input of inputs) {
        input.disabled = false;
    }
    document.querySelector(`#propiedades .details-data`).classList.add('updating');
    showConfirmBtns(document.querySelector(`#propiedades .details-data .floating-menu.right`));
}

/**
 * * Enable the Property deletion.
 * @param {Object} params
 */
export function enableDelete(params){
    document.querySelector(`#propiedades tbody tr#tr-${ params.key }`).classList.add('deleting');
    showConfirmBtns(document.querySelector(`#propiedades tbody tr#tr-${ params.key } td:last-child div`));
    showConfirmForm(document.querySelector(`#propiedades tbody tr#tr-${ params.key } td:last-child div`));
}

/**
 * * Disable the add from a section.
 * @param {View} view
 */
export function disableAdd(view){
    hideTrashBtn(document.querySelector('.gallery .selected:not(.gallery-button) .buttons'));
    let inputs = document.querySelectorAll('.details-data textarea, .details-data select, .property .gallery .files button');
    for (const input of inputs) {
        input.disabled = true;
    }
    document.querySelector(`#propiedades .details-data`).classList.remove('adding');
    hideConfirmBtns(document.querySelector(`#propiedades .details-data .floating-menu.right`));
    view.change({
        name: 'propiedades',
        type: 'table'
    })
    showAddButton();
}

/**
 * * Disable the update.
 */
export function disableUpdate(){
    hideTrashBtn(document.querySelector('.gallery .selected:not(.gallery-button) .buttons'));
    let inputs = document.querySelectorAll('.details-data textarea, .details-data select, .property .gallery .files button');
    for (const input of inputs) {
        input.disabled = true;
        switch (input.nodeName) {
            case 'TEXTAREA':
                input.innerHTML = input.dataset.defaultValue;
                input.value = input.dataset.defaultValue;
                break;
            case 'SELECT':
                for (const option of input.options) {
                    option.selected = false;
                    if (option.value == input.dataset.defaultValue) {
                        option.selected = true;
                    }
                }
                break;
            default:
                input.value = input.dataset.defaultValue;
                break;
        }
    }
    document.querySelector(`#propiedades .details-data`).classList.remove('updating');
    hideConfirmBtns(document.querySelector(`#propiedades .details-data .floating-menu.right`));
    removeValidationMessages(document.querySelectorAll('#propiedades .details-data .support'));
}

/**
 * * Disable the delete from a section.
 * @param {Object} params
 */
function disableDelete(params){
    document.querySelector(`#propiedades #tr-${ params.key } .actions [name=message]`).value = '';
    document.querySelector(`#propiedades tbody tr#tr-${ params.key }`).classList.remove('deleting');
    hideConfirmBtns(document.querySelector(`#propiedades tbody tr#tr-${ params.key } td:last-child div`));
    hideConfirmForm(document.querySelector(`#propiedades tbody tr#tr-${ params.key } td:last-child div`));
    removeValidationMessages(document.querySelectorAll(`#propiedades tbody tr#tr-${ params.key } .support`));
}

/**
 * * Show the confirm & cancel buttons from a <tr>.
 * @param {HTMLElement} html HTML Element to get buttons.
 */
function showConfirmBtns(html){
    for (const btn of html.children) {
        if (btn.nodeName == 'A') {
            if (btn.classList.contains('confirm-button') || btn.classList.contains('cancel-button') || btn.classList.contains('confirm-data') || btn.classList.contains('cancel-data')) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        }
    }
}

/**
 * * Hide the confirm & cancel buttons from a <tr>.
 * @param {HTMLElement} html HTML Element to get buttons.
 */
function hideConfirmBtns(html){
    for (const btn of html.children) {
        if (btn.nodeName == 'A') {
            if (btn.classList.contains('confirm-button') || btn.classList.contains('cancel-button') || btn.classList.contains('confirm-data') || btn.classList.contains('cancel-data')) {
                btn.classList.add('hidden');
            } else {
                btn.classList.remove('hidden');
            }
        }
    }
}

/**
 * * Show the add button
 */
function showAddButton(){
    document.querySelector('.add-data').classList.remove('hidden');
}

/**
 * * Hide the add button
 */
function hideAddButton(){
    document.querySelector('.add-data').classList.add('hidden');
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

/**
 * * Just the confirm function callback.
 */
export function confirm(params) {
    let form, input, Validation;
    switch (params.mode) {
        case 'update':
            form = document.querySelector('#propiedades > form');
            input = document.querySelector('#propiedades > form [name=_method]');
            let slug = URL.findGetParameter('name');
            form.action = `/properties/${ slug }/update`;
            input.value = "PUT";
            Validation = new ValidationJS({
                id: form.id,
            }, {}, validation.properties.updating.rules, validation.properties.updating.messages);
            ValidationJS.validate(Validation.getForm());
            if (Validation.getValid()) {
                form.submit();
            }
            break;
        case 'delete':
            form = document.querySelector(`#property-confirm-form-${ params.key }`);
            form.nextElementSibling.classList.remove(`property-form-${ params.key }`);
            form.nextElementSibling.classList.add(`property-confirm-form-${ params.key }`);
            Validation = new ValidationJS({
                id: form.id,
            }, {}, validation.properties.deleting.rules, validation.properties.deleting.messages);
            ValidationJS.validate(Validation.getForm());
            if (Validation.getValid()) {
                form.submit();
            }
            break;
        default:
            form = document.querySelector('#propiedades > form');
            input = document.querySelector('#propiedades > form [name=_method]');
            form.action = '/properties/create';
            input.value = "POST";
            Validation = new ValidationJS({
                id: form.id,
            }, {}, validation.properties.adding.rules, validation.properties.adding.messages);
            ValidationJS.validate(Validation.getForm());
            if (Validation.getValid()) {
                form.submit();
            }
            break;
    }
}

/**
 * * Just the cancel function callback.
 */
function cancel(params) {
    disableDelete(params);
}

/**
 * * Show the confirm form from a <tr>.
 * @param {HTMLElement} html HTML Element form.
 */
function showConfirmForm(html){
    for (const btn of html.children) {
        if (btn.nodeName == 'FORM') {
            if (btn.classList.contains('confirm-form')) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        }
    }
}

/**
 * * Hide the confirm form from a <tr>.
 * @param {HTMLElement} html HTML Element form.
 */
function hideConfirmForm(html){
    for (const btn of html.children) {
        if (btn.nodeName == 'FORM') {
            if (btn.classList.contains('confirm-form')) {
                btn.classList.add('hidden');
            } else {
                btn.classList.remove('hidden');
            }
        }
    }
}

/**
 * * Creates the Property name Form.
 * @param {Object} properties Properties:
 * @param {Number} properties.key
 * @param {String} properties.id Form ID.
 * @param {String} properties.action Form action.
 * @param {String} properties.method Form method.
 * @param {String[]} properties.classes Form class names.
 * @param {Object[]} properties.inputs Form inputs.
 * @returns
 */
function createForm(properties = {
    key: '',
    id: '',
    action: '',
    method: '',
    classes: [],
    inputs: [],
}){
    properties.inputs.push({
        properties: {
            id: `property-token-${ properties.key }`,
            name: `_token`,
            type: 'hidden',
            defaultValue: document.querySelector('meta[name=csrf_token]').content,
            placeholder: `_token`,
            classes: [],
        }, states: {
            //
    }});
    properties.inputs.push({
        properties: {
            id: `property-method-${ properties.key }`,
            name: `_method`,
            type: 'hidden',
            defaultValue: properties.method,
            placeholder: `_method`,
            classes: [],
        }, states: {
            //
    }});
    let form = new HTMLCreatorJS('form', {
        properties: {
            id: properties.id,
            action: properties.action,
            method: 'POST',
            classes: properties.classes,
        }, inputs: properties.inputs,
    });
    form.appendChild(new HTMLCreatorJS('span', {
        properties: {
            id: `property-name-support-box-${ properties.key }`,
            classes: ['Work-Sans', 'support', 'support-box', `support-${ properties.inputs[0].properties.name }`, 'hidden'],
        }, innerHTML: false,
    }).getHTML());
    return form;
}

/**
 * * Creates the "see more" action button.
 * @param {Object} properties Properties:
 * @param {Property} properties.property
 * @param {String} properties.key
 * @param {String} properties.href Button href.
 * @param {View} properties.view Current View
 * @param {function} properties.seeMoreFunction
 * @returns
 */
function createSeeMoreActionBtn(properties = {
    property: property,
    key: '',
    href: '',
    seeMore: '',
}){
    return new HTMLCreatorJS('a', {
        properties: {
            id: `property-${ properties.key }-button`,
            href: properties.href,
            title: 'Ver más',
            classes: ['see-button', 'btn', 'btn-uno-transparent', 'btn-icon', 'mr-md-1'],
        }, states: { }, callback: {
            function: properties.seeMore,
            params: {
                property: properties.property
        }}, innerHTML: new HTMLCreatorJS('icon', {
            properties: {
                classes: ['icon', 'fas', 'fa-eye'],
        }}).getHTML()
    }).getHTML();
}

/**
 * * Creates the delete action button.
 * @param {Object} properties Properties:
 * @param {String} properties.key
 * @param {String} properties.href Button href.
 * @returns
 */
function createDeleteActionBtn(properties = {
    key: '',
    href: '',
}){
    return new HTMLCreatorJS('a', {
        properties: {
            id: `property-${ properties.key }-button`,
            title: 'Borrar',
            href: properties.href,
            classes: ['delete-button', 'btn', 'btn-uno-transparent', 'btn-icon', 'mr-md-1'],
        }, states: {}, callback: {
            function: enableDelete,
            params: {
                key: properties.key,
        }}, innerHTML: new HTMLCreatorJS('icon', {
            properties: {
                classes: ['icon', 'fas', 'fa-trash'],
        }}).getHTML()
    }).getHTML();
}

/**
 * * Creates a confirm action button.
 * @param {Object} properties Properties:
 * @param {String} properties.key
 * @returns
 */
function createConfirmActionBtn(properties = {
    key: '',
}){
    return new HTMLCreatorJS('a', {
            properties: {
            id: `property-${ properties.key }-button`,
            title: 'Confirmar',
            classes: ['form-submit', `property-form-${ properties.key }`, 'confirm-button', 'btn', 'btn-uno-transparent', 'btn-icon', 'mr-md-1', 'hidden'],
        }, states: {
            preventDefault: true,
        }, callback: {
            function: confirm,
            params: {
                key: properties.key,
                mode: 'delete',
        }}, innerHTML: new HTMLCreatorJS('icon', {
            properties: {
                classes: ['icon', 'fas', 'fa-check'],
        }}).getHTML()
    });
}

/**
 * * Creates a cancel action button.
 * @param {Object} properties Properties:
 * @param {String} properties.key
 * @returns
 */
function createCancelActionBtn(properties = {
    key: '',
}){
    return new HTMLCreatorJS('a', {
        properties: {
            id: `property-${ properties.key }-button`,
            title: 'Cancelar',
            href: `#propiedades`,
            classes: ['cancel-button', 'btn', 'btn-uno-transparent', 'btn-icon', 'mr-md-1', 'hidden'],
        }, states: {}, callback: {
            function: cancel,
            params: {
                key: properties.key,
                table: properties.table,
        }}, innerHTML: new HTMLCreatorJS('icon', {
            properties: {
                classes: ['icon', 'fas', 'fa-times'],
        }}).getHTML()
    });
}

/**
 * * Makes the Property ID HTML Element.
 * @param {Property} property
 */
function makeIDPropertyHTML(property) {
    let span = document.createElement('span');
    span.innerHTML = property.id_property;
    property.id_property = {
        text: property.id_property,
        html: span,
    };
}

/**
 * * Makes the Property name HTML Element.
 * @param {Property} property
 */
function makeNameHTML(property) {
    let span = document.createElement('span');
    span.innerHTML = property.name;
    property.name = {
        text: property.name,
        html: span,
    };
}

/**
 * * Makes the Property category name HTML Element.
 * @param {Property} property
 */
function makeCategoryHTML(property) {
    let span = document.createElement('span');
    span.innerHTML = property.category.name;
    property.category.name = {
        text: property.category.name,
        html: span,
    };
}

/**
 * * Makes the Property location name HTML Element.
 * @param {Property} property
 */
function makeLocationHTML(property) {
    let span = document.createElement('span');
    span.innerHTML = property.location.name;
    property.location.name = {
        text: property.location.name,
        html: span,
    };
}

/**
 * * Makes the Property updated at HTML Element.
 * @param {Property} property
 */
function makeUpdatedAtHTML(property) {
    let span = document.createElement('span');
    span.innerHTML = parseDate(property.updated_at);
    property.updated_at = {
        text: property.updated_at,
        html: span,
    };
}

/**
 * * Makes the Property actions.
 * @param {Property} property
 * @param {Number} key
 * @param {Object} table
 * @param {function} seeMoreFunction
 */
function makeActions(property, key, table, seeMoreFunction) {
    let div = document.createElement('div');
    div.appendChild(createSeeMoreActionBtn({
        property: property,
        key: key,
        href: `#propiedades?name=${ property.slug }`,
        seeMore: seeMoreFunction,
    }));
    div.appendChild(createDeleteActionBtn({
        key: key,
        href: `#propiedades?name=${ property.slug }&deleting`
    }));
    div.appendChild(createForm({
        key: key,
        id: `property-confirm-form-${ key }`,
        action: `/properties/${ property.slug }/delete`,
        method: 'DELETE',
        classes: ['confirm-form', 'hidden', 'mr-md-1'],
        inputs: [{
            properties: {
                id: `property-message-${ key }`,
                name: `message`,
                type: 'text',
                classes: ['form-input', 'p-2'],
                placeholder: 'BORRAR',
    }}]}).getHTML());
    div.appendChild(createConfirmActionBtn({
        key: key,
    }).getHTML());
    div.appendChild(createCancelActionBtn({
        key: key,
        table: table,
    }).getHTML());
    property.actions = {
        html: div,
    };
}

/**
 * * Makes the Propertys HTML Elements.
 * @export
 * @param {Property[]} properties
 * @param {Object} table
 * @param {function} seeMoreFunction
 */
export function makeHTML(properties, table, seeMoreFunction){
    for (const key in properties) {
        const property = properties[key];
        makeIDPropertyHTML(property);
        makeNameHTML(property);
        makeCategoryHTML(property);
        makeLocationHTML(property);
        makeUpdatedAtHTML(property);
        makeActions(property, key, table, seeMoreFunction);
    }
}