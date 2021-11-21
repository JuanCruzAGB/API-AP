// ? JuanCruzAGB repository
import Class from '../../JuanCruzAGB/js/Class.js';

/**
 * * Image controls the Gallery selected Image.
 * @export
 * @class Gallery
 * @author Juan Cruz Armentia <juan.cruz.armentia@gmail.com>
 * @extends Class
 */
export default class Image extends Class {
    /**
     * * Creates an instance of Image.
     * @param {object} [data]
     * @param {object} [data.props]
     * @param {string} [data.props.id] Image primary key.
     * @param {string} [data.props.source] Image source.
     * @param {HTMLElement} html Image HTML Element.
     * @memberof Image
     */
    constructor (data = {
        props: {
            id: 'image-1',
            source: false,
        }, html,
    }) {
        super({
            props: {
                ...Image.props,
                ...(data && data.hasOwnProperty("props")) ? data.props : {},
            }, state: {
                ...Image.state,
                ...(data && data.hasOwnProperty("state")) ? data.state : {},
            },
        });
        this.setHTML(data.html);
    }

    /**
     * * Change the Image source.
     * @param {string} source
     * @memberof Image
     */
    change (source) {
        this.setProps('source', source);
        this.html.src = source;
    }

    /**
     * * Get the Gallery Image.
     * @static
     * @param {Gallery} Gallery
     * @returns {Image}
     * @memberof Image
     */
    static generate (Gallery) {
        let html = Image.querySelector(Gallery.props.id);
        return new this({
            props: {
                id: 'image-1',
                source: html.src,
            }, html: html,
        });
    }

    /**
     * * Returns the Gallery Image HTMLElements.
     * @static
     * @param {string} id Gallery primary key.
     * @returns {HTMLElement}
     * @memberof Image
     */
    static querySelector (id = false) {
        if (id) {
            return document.querySelector(`.${ id }.gallery-image`);
        }
        if (!id) {
            console.error('ID param is required to get the Gallery Image');
            return false;
        }
    }
    
    /**
     * @static
     * @var {object} props Default properties.
     * @memberof Image
     */
    static props = {
        id: 'image-1',
        source: undefined,
    }
    
    /**
     * @static
     * @var {object} state Default state.
     */
    static state = {
        // 
    }
}