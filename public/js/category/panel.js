// ? External repositories
import { HTMLCreator as HTMLCreatorJS } from "../../submodules/HTMLCreatorJS/js/HTMLCreator.js";
import { Validation as ValidationJS } from "../../submodules/ValidationJS/js/Validation.js";

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
 * * Enable the Category addion.
 * @param {Object} params
 */
export function enableAdd(params){
    let form = createForm({
        key: params.table.getData().length + 1,
        id: `category-form-${ params.table.getData().length }`,
        action: `/category/create`,
        method: 'POST',
        classes: [],
        inputs: [{
            properties: {
                id: `category-name-${ params.table.getData().length + 1 }`,
                name: `name`,
                type: 'text',
                defaultValue: '',
                placeholder: `Nombre`,
                classes: ['form-input', 'p-2'],
            }, states: {
                //
    }}]});

    let div = document.createElement('div');
    div.appendChild(createConfirmActionBtn({
        key: params.table.getData().length,
    }).getHTML());
    div.appendChild(createCancelActionBtn({
        key: params.table.getData().length,
        table: params.table,
    }).getHTML());

    let category = {
        id_category: {
            text: params.table.getData().length,
            html: document.createElement('span'),
        }, name: {
            text: '',
            form: form,
            html: form.getHTML(),
        }, updated_at: {
            text: '',
            html: document.createElement('span'),
        }, actions: {
            html: div,
        }
    };
    
    params.table.addData([category]);
    params.table.addTr(params.table.getData().length - 1, [], 'before');
    document.querySelector(`#categorias tbody tr#tr-${ params.table.getData().length - 1 }`).classList.add('adding');
    showConfirmBtns(div);
    hideAddButton();
}

/**
 * * Enable the Category updation.
 * @param {Object} params
 */
export function enableUpdate(params){
    document.querySelector(`#categorias tbody tr#tr-${ params.key }`).classList.add('updating');
    document.querySelector(`#categorias tbody tr#tr-${ params.key } [name=name]`).disabled = false;
    showConfirmBtns(document.querySelector(`#categorias tbody tr#tr-${ params.key } td:last-child div`));
}

/**
 * * Enable the Category deletion.
 * @param {Object} params
 */
export function enableDelete(params){
    document.querySelector(`#categorias tbody tr#tr-${ params.key }`).classList.add('deleting');
    showConfirmBtns(document.querySelector(`#categorias tbody tr#tr-${ params.key } td:last-child div`));
    showConfirmForm(document.querySelector(`#categorias tbody tr#tr-${ params.key } td:last-child div`));
}

/**
 * * Disable the add from a section.
 * @param {Object} params
 */
function disableAdd(params){
    params.table.removeTr(`tr-${ params.key }`);
    params.table.removeData(params.key);
    showAddButton();
}

/**
 * * Disable the update.
 * @param {Object} params
 */
function disableUpdate(params){
    document.querySelector(`#categorias tbody tr#tr-${ params.key }`).classList.remove('updating');
    let input = document.querySelector(`#categorias tbody tr#tr-${ params.key } [name=name]`);
    input.disabled = true;
    input.value = categories[params.key].name.form.getInputs()[0].getDefaultValueProperty();
    hideConfirmBtns(document.querySelector(`#categorias tbody tr#tr-${ params.key } td:last-child div`));
    removeValidationMessages(document.querySelectorAll(`#categorias tbody tr#tr-${ params.key } .support`));
}

/**
 * * Disable the delete from a section.
 * @param {Object} params
 */
function disableDelete(params){
    document.querySelector(`#categorias #tr-${ params.key } .actions [name=message]`).value = '';
    document.querySelector(`#categorias tbody tr#tr-${ params.key }`).classList.remove('deleting');
    let form = document.querySelector(`#category-confirm-form-${ params.key }`);
    form.nextElementSibling.classList.add(`category-form-${ params.key }`);
    form.nextElementSibling.classList.remove(`category-confirm-form-${ params.key }`);
    hideConfirmBtns(document.querySelector(`#categorias tbody tr#tr-${ params.key } td:last-child div`));
    hideConfirmForm(document.querySelector(`#categorias tbody tr#tr-${ params.key } td:last-child div`));
    removeValidationMessages(document.querySelectorAll(`#categorias tbody tr#tr-${ params.key } .support`));
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
function confirm(params) {
    let tr = document.querySelector(`#categorias #tr-${ params.key }`);
    let form;
    if (tr.classList.contains('adding')) {
        form = document.querySelector(`#categorias #tr-${ params.key } form`);
        let Validation = new ValidationJS({
            id: form.id,
        }, {}, validation.categories.adding.rules, validation.categories.adding.messages);
        ValidationJS.validate(Validation.getForm());
        if (Validation.getValid()) {
            form.submit();
        }
    } else if (tr.classList.contains('updating')) {
        form = document.querySelector(`#categorias #tr-${ params.key } form`);
        let Validation = new ValidationJS({
            id: form.id,
        }, {}, validation.categories.updating.rules, validation.categories.updating.messages);
        ValidationJS.validate(Validation.getForm());
    } else {
        form = document.querySelector(`#category-confirm-form-${ params.key }`);
        form.nextElementSibling.classList.remove(`category-form-${ params.key }`);
        form.nextElementSibling.classList.add(`category-confirm-form-${ params.key }`);
        let Validation = new ValidationJS({
            id: form.id,
        }, {}, validation.categories.deleting.rules, validation.categories.deleting.messages);
        ValidationJS.validate(Validation.getForm());
        if (Validation.getValid()) {
            form.submit();
        }
    }
}

/**
 * * Just the cancel function callback.
 */
function cancel(params) {
    let tr = document.querySelector(`#categorias #tr-${ params.key }`);
    if (tr.classList.contains('adding')) {
        disableAdd(params);
    } else if (tr.classList.contains('updating')) {
        disableUpdate(params);
    } else {
        disableDelete(params);
    }
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
 * * Creates the Category name Form.
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
            id: `category-token-${ properties.key }`,
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
            id: `category-method-${ properties.key }`,
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
            id: `category-name-support-box-${ properties.key }`,
            classes: ['Work-Sans', 'support', 'support-box', `support-${ properties.inputs[0].properties.name }`, 'hidden'],
        }, innerHTML: false,
    }).getHTML());
    return form;
}

/**
 * * Creates the update action button.
 * @param {Object} properties Properties:
 * @param {String} properties.key
 * @param {String} properties.href Button href.
 * @returns
 */
function createUpdateActionBtn(properties = {
    key: '',
    href: '',
}){
    return new HTMLCreatorJS('a', {
        properties: {
            id: `category-${ properties.key }-button`,
            title: 'Actualizar',
            href: properties.href,
            classes: ['update-button', 'btn', 'btn-uno-transparent', 'btn-icon', 'mr-md-1'],
        }, states: { }, callback: {
            function: enableUpdate,
            params: {
                key: properties.key,
        }}, innerHTML: new HTMLCreatorJS('icon', {
            properties: {
                classes: ['icon', 'fas', 'fa-pen'],
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
            id: `category-${ properties.key }-button`,
            title: 'Borrar',
            href: properties.href,
            classes: ['delete-button', 'btn', 'btn-uno-transparent', 'btn-icon', 'mr-md-1'],
        }, states: { }, callback: {
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
            id: `category-${ properties.key }-button`,
            title: 'Confirmar',
            classes: ['form-submit', `category-form-${ properties.key }`, 'confirm-button', 'btn', 'btn-uno-transparent', 'btn-icon', 'mr-md-1', 'hidden'],
        }, states: {
            preventDefault: true,
        }, callback: {
            function: confirm,
            params: {
                key: properties.key,
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
            id: `category-${ properties.key }-button`,
            title: 'Cancelar',
            href: `#categorias`,
            classes: ['cancel-button', 'btn', 'btn-uno-transparent', 'btn-icon', 'mr-md-1', 'hidden'],
        }, states: { }, callback: {
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
 * * Makes the Category ID HTML Element.
 * @param {Category} category
 */
function makeIDCategoryHTML(category) {
    let span = document.createElement('span');
    span.innerHTML = category.id_category;
    category.id_category = {
        text: category.id_category,
        html: span,
    };
}

/**
 * * Makes the Category name HTML Element.
 * @param {Category} category
 */
function makeNameHTML(category, key) {
    let form = createForm({
        key: key,
        id: `category-form-${ key }`,
        action: `/category/${ category.slug }/update`,
        method: 'PUT',
        classes: [],
        inputs: [{
            properties: {
                id: `category-name-${ properties.key }`,
                name: `name`,
                type: 'text',
                defaultValue: category.name,
                placeholder: `Nombre`,
                classes: ['form-input', 'p-2'],
            }, states: {
                disabled: true,
    }}]});
    category.name = {
        text: category.name,
        form: form,
        html: form.getHTML(),
    };
}

/**
 * * Makes the Category updated at HTML Element.
 * @param {Category} category
 */
function makeUpdatedAtHTML(category) {
    let span = document.createElement('span');
    span.innerHTML = parseDate(category.updated_at);
    category.updated_at = {
        text: category.updated_at,
        html: span,
    };
}

/**
 * * Makes the Category actions.
 * @param {Category} category
 * @param {Number} key
 * @param {Object} table
 */
function makeActions(category, key, table) {
    let div = document.createElement('div');
    div.appendChild(createUpdateActionBtn({
        key: key,
        href: `#categorias?name=${ category.slug }&updating`,
    }));
    div.appendChild(createDeleteActionBtn({
        key: key,
        href: `#categorias?name=${ category.slug }&deleting`
    }));
    div.appendChild(createForm({
        key: key,
        id: `category-confirm-form-${ key }`,
        action: `/category/${ category.slug }/delete`,
        method: 'DELETE',
        classes: ['confirm-form', 'hidden', 'mr-md-1'],
        inputs: [{
            properties: {
                id: `category-message-${ key }`,
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
    category.actions = {
        html: div,
    };
}

/**
 * * Makes the Categories HTML Elements.
 * @export
 * @param {Category[]} categories
 * @param {Object} table
 */
export function makeHTML(categories, table){
    for (const key in categories) {
        const category = categories[key];
        makeIDCategoryHTML(category);
        makeNameHTML(category, key);
        makeUpdatedAtHTML(category);
        makeActions(category, key, table);
    }
}