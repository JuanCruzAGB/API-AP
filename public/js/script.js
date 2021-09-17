// ? External repository
import { NavMenu as NavMenuJS} from '../../submodules/NavMenuJS/js/NavMenu.js';
import { Dropdown as DropdownJS } from "../../submodules/DropdownJS/js/Dropdown.js";

document.addEventListener('DOMContentLoaded', (e) => {
    if(document.querySelector('#nav-global')){
        let navmenu = new NavMenuJS({
            id: 'nav-global',
            sidebar: {
                id: ['menu'],
                position: ['left'],
            }, dropdown:{
                //
            },
        }, {
            fixed: true,
            hideOnScrollDown: true,
            current: false,
        });
    }
    if(document.querySelectorAll('.dropdown').length){
        let dropdowns = [];
        for (const html of document.querySelectorAll('.dropdown')) {
            dropdowns.push(new DropdownJS({
                id: html.id,
            }, {
                open: false,
            }));
        }
    }
});