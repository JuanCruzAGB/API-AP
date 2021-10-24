// ? External repository
import Class from "../../JuanCruzAGB/js/Class.js";
import HTMLCreator from "../../HTMLCreatorJS/js/HTMLCreator.js";

/**
 * * Button controls the Gallery Buttons.
 * @export
 * @class Gallery
 * @author Juan Cruz Armentia <juancarmentia@gmail.com>
 */
export default class Button extends Class {
    /**
     * * Creates an instance of Button.
     * @param {object} [data]
     * @param {object} [data.props]
     * @param {string} [data.props.id] Button primary key.
     * @param {string} [data.props.source] Button Image source.
     * @param {object} [data.state] Button state:
     * @param {boolean} [data.state.active] If the Button should be active.
     * @param {HTMLElement} html Button HTML Element.
     * @param {Gallery} Gallery Button Gallery parent.
     * @memberof Button
     */
    constructor (data = {
        props: {
            id: "button-1",
            source: false,
        }, state: {
            active: false,
        }, html, Gallery
    }) {
        super({ ...Button.props, ...((data && data.hasOwnProperty("props")) ? data.props : {}) }, { ...Button.state, ...((data && data.hasOwnProperty("state")) ? data.state : {}) });
        this.setHTML(data.html);
        this.html.addEventListener("click", (e) => {
            e.preventDefault();
            data.Gallery.select(this.props.id);
        });
    }

    /**
     * * Active the Button.
     * @memberof Button
     */
    active () {
        this.setState("active", true);
        this.html.classList.add("active");
    }

    /**
     * * Inactive the Button.
     * @memberof Button
     */
    inactive () {
        this.setState("active", false);
        this.html.classList.remove("active");
    }

    /**
     * * Get all the Gallery Buttons.
     * @static
     * @param {Gallery} Gallery
     * @returns {Button[]}
     * @memberof Button
     */
    static generate (Gallery) {
        let buttons = [];
        let key = 0;
        for (const html of Button.querySelector(Gallery.props.id)) {
            buttons.push(new this({
                props: {
                    id: `button-${ key }`,
                    source: (() => {
                        for (const child of html.children) {
                            if (child.nodeName == "IMG") {
                                return child.src;
                            }
                        }
                        return false;
                    })(),
                }, state: {
                    active: html.classList.contains("active"),
                }, html: html,
                Gallery: Gallery,
            }));
            key++;
        }
        return buttons;
    }

    /**
     * * Returns all the Gallery Buttons HTMLElements.
     * @static
     * @param {string} id Gallery primary key.
     * @returns {HTMLElement[]}
     * @memberof Button
     */
    static querySelector (id = false) {
        if (id) {
            return document.querySelectorAll(`.${ id }.gallery-button`);
        }
        if (!id) {
            console.error("ID param is required to get the Gallery Buttons");
            return [];
        }
    }
    
    /**
     * @static
     * @var {object} props Default properties.
     * @memberof Button
     */
    static props = {
        id: "button-1",
        source: false,
    }
    
    /**
     * @static
     * @var {object} state Default state.
     * @memberof Button
     */
    static state = {
        active: false,
    }
}