// ? External repository
import NavMenu from "../../submodules/NavMenuJS/js/NavMenu.js";

document.addEventListener("DOMContentLoaded", (e) => {
    if (document.querySelector("#nav-filter")) {
        new NavMenu({
            props: {
                id: "nav-filter",
                sidebar: [
                    {
                        props: {
                            id: "sidebar-filters",
                        }, state: {
                            open: false,
                        },
                    }, {
                        props: {
                            id: "sidebar-menu",
                        }, state: {
                            open: false,
                        },
                    },
                ],
            }, state: {
                current: false,
            },
        });
    }
});