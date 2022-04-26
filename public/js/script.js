// ? External repository
import Dropdown from "../submodules/DropdownJS/js/Dropdown.js";
import NavMenu from "../submodules/NavMenuJS/js/NavMenu.js";

document.addEventListener("keypress", function (e) {
    if (e.keyCode == 80 && e.shiftKey) {
        window.location = "/panel";
    }
});

document.addEventListener('DOMContentLoaded', e => {
    if (document.querySelector('#nav-global')) {
        new NavMenu({
            props: {
                id: 'nav-global',
                sidebar: {
                    props: {
                        id: 'sidebar-menu'
                    }, state: {
                        open: false,
                    },
                },
            }, state: {
                current: false,
            },
        });
    }

    // TODO: Dropdown
    if (document.querySelectorAll('.dropdown').length) {
        for (const html of document.querySelectorAll('.dropdown')) {
            new Dropdown({
                id: html.id,
            }, {
                open: false,
            });
        }
    }
});