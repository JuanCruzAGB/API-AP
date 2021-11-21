// ? External repositories
import Class from '../../JuanCruzAGB/js/Class.js';

// ? GalleryJS repository
import Button from './Button.js';
import Image from './Image.js';

/**
 * * Gallery makes an excellent gallery of files.
 * @export
 * @class Gallery
 * @author Juan Cruz Armentia <juan.cruz.armentia@gmail.com>
 * @extends Class
 */
export default class Gallery extends Class {
    /**
     * * Creates an instance of Gallery.
     * @param {object} [data]
     * @param {object} [data.props]
     * @param {string} [data.props.id] Gallery primary key.
     * @param {object} [data.props.classList]
     * @param {string[]} [data.props.classList.button]
     * @param {string[]} [data.props.images]
     * @param {object} [data.state]
     * @param {string} [data.state.generate] If the Gallery Images should be generated.
     * @param {string} [data.state.selected] What Gallery Image is selected.
     * @param {boolean} [data.state.preventDefault=true] If the Button click event should execut prevent default.
     * @param {object} [data.callbacks]
     * @param {object} [data.callbacks.select]
     * @param {function} [data.callbacks.select.function]
     * @param {object} [data.callbacks.select.params]
     * @memberof Gallery
     */
    constructor (data = {
        props: {
            id: 'gallery-1',
            classList: {
                button: [],
            }, images: [],
        }, state: {
            generate: false,
            selected: false,
            preventDefault: true,
        }, callbacks: {
            select: {
                function: (params) => { /* console.log(params) */ },
                params: {},
            },
        },
    }) {
        super({
            props: {
                ...Gallery.props,
                ...(data && data.hasOwnProperty("props")) ? data.props : {},
            }, state: {
                ...Gallery.state,
                ...(data && data.hasOwnProperty("state")) ? data.state : {},
            },
        });
        this.setCallbacks({ ...Gallery.callbacks, ...((data && data.hasOwnProperty('callbacks')) ? data.callbacks : {}) });
        this.setHTML(`#${ this.props.id }.gallery`);
        this.setButtons();
        this.setImage();
        this.checkState();
        console.log(this);
    }

    /**
     * * Set the Gallery Buttons.
     * @memberof Gallery
     */
    setButtons () {
        this.buttons = Button.generate(this);
    }

    /**
     * * Set the Gallery Image.
     * @memberof Gallery
     */
    setImage () {
        this.image = Image.generate(this);
        console.log(this.image);
    }

    /**
     * * Check the Gallery state values.
     * @memberof Gallery
     */
    checkState () {
        this.checkSelectedState();
    }

    /**
     * * Check the Gallery selected state values.
     * @memberof Gallery
     */
    checkSelectedState () {
        if (this.state.selected) {
            this.select(this.state.selected);
        }
    }

    /**
     * * Select a new Image.
     * @param {string} id
     * @memberof Gallery
     */
    select (id = false, params = {}) {
        let found = false;
        if (id) {
            for (const btn of this.buttons) {
                btn.inactive();
                if (btn.props.id == id) {
                    found = btn;
                }
            }
            if (found) {
                found.active();
                this.image.change(found.props.source);
                return true;
            }
        }
        this.execute('select', {
            ...params,
            ...this.callbacks.select.params,
            selected: found,
            Gallery: this,
        });
        return false;
    }

    /**
     * * Return the Gallery menu.
     * @static
     * @param {string} id Gallery primary key.
     * @returns {HTMLElement}
     * @memberof Gallery
     */
    static menuQuerySelector (id = false) {
        if (id) {
            return document.querySelector(`#${ id }.gallery .gallery-menu-list`);
        } else {
            console.error('ID param is required to get the Gallery menu');
            return false;
        }
    }
    
    /**
     * @static
     * @var {object} props Default properties.
     * @memberof Gallery
     */
    static props = {
        id: 'gallery-1',
        classList: {
            button: [],
        }, images: [],
    }
    
    /**
     * @static
     * @var {object} state Default state.
     * @memberof Gallery
     */
    static state = {
        selected: false,
        generate: false,
        preventDefault: true,
    }
    
    /**
     * @static
     * @var {object} callbacks Default callbacks.
     * @memberof Gallery
     */
    static callbacks = {
        select: {
            function: (params) => { /* console.log(params) */ },
            params: {},
        },
    }
}