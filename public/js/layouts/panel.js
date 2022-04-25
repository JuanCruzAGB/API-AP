// ? External repositories
import Sidebar from '../../submodules/SidebarJS/js/Sidebar.js';

document.addEventListener('DOMContentLoaded', async function (e) {
    new Sidebar({
        props: {
           id: 'panel-sidebar', 
        }, state: {
            open: false,
            viewport: {
                '1024': true,
            },
        },
    });
});