/**
 * * Asset transform the route.
 * @export
 * @class Asset
 */
export default class Asset {
    /**
     * * Creates an instance of Asset.
     * @param {string} route
     * @memberof Asset
     */
    constructor (route) {
        this.route = document.querySelector("meta[name=asset]").content + route;
    }
}