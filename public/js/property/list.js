// import { Filter as FilterJS } from "../../submodules/FilterJS/js/Filter.js";
// import { HTMLCreator as HTMLCreatorJS } from "../../submodules/HTMLCreatorJS/js/HTMLCreator.js";

// function generateItems(data){
//     let array = [];
//     for (const property of data) {
//         let header = new HTMLCreatorJS('header', {
//             properties: {
//                 id: `property-${ property.id_property }-header`,
//                 classes: ['card-title', 'col-12', 'm-0', 'p-0'],
//             }, title: {
//                 properties: {
//                     id: `property-${ property.id_property }-title`,
//                     type: 'h3',
//                     classes: ['h6', 'text-center', 'mb-0', 'p-3'],
//                 }, innerHTML: property.name,
//         }});
//         let div = new HTMLCreatorJS('div', {
//             properties: {
//                 id: `property-${ property.id_property }-div`,
//                 classes: ['card-icon', 'col-12'],
//             }, innerHTML: new HTMLCreatorJS('icon', {
//                 properties: {
//                     id: `property-${ property.id_property }-icon`,
//                     classes: ['icon', 'fas', 'fa-sign-in-alt'],
//             }}).getHTML(),
//         });
//         let link = new HTMLCreatorJS('a', {
//             properties: {
//                 id: `property-${ property.id_property }`,
//                 href: `/propiedad/${ property.slug }/detalles`,
//                 title: false,
//                 classes: ['card-body', 'row', 'p-0'],
//             }, states: {}, callback: {}, innerHTML: new HTMLCreatorJS('figure', {
//                 properties: {
//                     id: `property-${ property.id_property }-figure`,
//                     classes: ['card-image', 'col-12', 'mb-0', 'p-0'],
//                 }, image: {
//                     properties: {
//                         id: `property-${ property.id_property }-image`,
//                         url: `${ document.querySelector('[name=asset]').content }/${ property.files[0] }`,
//                         name: `${ property.name }: Image`,
//                         classes: [],
//                 }}}).getHTML()
//         });
//         link.appendChild(header.getHTML());
//         link.appendChild(div.getHTML());
//         array.push({
//             properties: {
//                 id: `property-${ property.id_property }-item`,
//                 classes: ['property', 'card', 'col-11', 'col-md-5', 'col-xl-3', 'col-md-3'],
//             }, innerHTML: link.getHTML(),
//         });
//     }
//     return array;
// }

// function changeContent(params){
//     console.log(params);
// }

// document.addEventListener('DOMContentLoaded', function(e){
//     let list = new HTMLCreatorJS('ul', {
//         properties: {
//             id: 'properties',
//             classes: ['cards', 'row'],
//         }, items: generateItems(properties),
//     });

//     // let filter = new FilterJS({
//     //     id: 'properties',
//     //     order: {
//     //         by: 'name',
//     //         btn: true,
//     //     }, event: {
//     //         function: changeContent,
//     //         params: {
//     //             list: list
//     //         },
//     //     },
//     // }, {}, [{
//     //     type: 'select',
//     //     target: 'id_category',
//     // }, {
//     //     type: 'select',
//     //     target: 'id_location',
//     // }], properties);

//     document.querySelector('#favorites main').appendChild(list.getHTML());
// });