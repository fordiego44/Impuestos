import {BaseElement} from "../../user-interface/BaseElement";

//@todo DataListLocation

export default class LiLocation extends BaseElement {

    constructor(category, title, data) {
        super()
        this._id = category
        this.title = title
        this.data = data

    }

    getElementString() {
        let liTag = ''
        for (let data of this.data) {

            liTag += `<li data-id="${data.location_id}" data-fullname="${data.short_name}" 
                        data-name="${data.location_name}" 
                        value="${data.short_name} ${data.type ? '(' + data.type + ')' : ''}">${data.short_name} ${data.type ? '(' + data.type + ')' : ''}</li>`;
            //<input class="${this._id}-checkbox" type="checkbox" name="${data.name}" value="${data.id}" data-action="${this._id}" id="${data.name}${data.id}">
            // liTag += `<li data-id="${data.location_id}" data-fullname="${data.short_name}" data-name="${data.location_name}" data-action="location">
            //             <a data-id="${data.location_id}" data-fullname="${data.short_name}" data-name="${data.location_name}" data-action="location">
            //             <i class="fa fa-dot-circle-o" data-id="${data.location_id}" data-fullname="${data.short_name}" data-name="${data.location_name}" data-action="location" aria-hidden="true"></i>
            //                 ${data.short_name}</a>
            //           </li>`
        }
        return liTag;
    }
}
