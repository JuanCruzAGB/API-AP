// ? External repository
import NavMenu from "../../submodules/NavMenuJS/js/NavMenu.js";
import { Dropdown as DropdownJS } from "../../submodules/DropdownJS/js/Dropdown.js";

document.addEventListener("DOMContentLoaded", (e) => {
    if (document.querySelector("#nav-global")) {
        new NavMenu({
            props: {
                id: "nav-global",
                sidebar: {
                    props: {
                        id: "sidebar-menu"
                    }, state: {
                        open: false,
                    },
                },
            }, state: {
                current: false,
            },
        });
    }
    if (document.querySelectorAll(".dropdown").length) {
        for (const html of document.querySelectorAll(".dropdown")) {
            new DropdownJS({
                id: html.id,
            }, {
                open: false,
            });
        }
    }
});