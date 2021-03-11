import { BaseElement } from './BaseElement'


export default class Li extends BaseElement {

    constructor(category, title, data) {
        super()
        this._id = category
        this.title = title
        this.data = data
    }

    getElementString() {
        let liTag = ''
        if (this.data.length == 0) {
            liTag += `<li class="li_location_mouse" data-id="" data-fullname="" data-name="" data-type="" data-type_filter="" data-search="location">
                            <a data-id="" data-fullname="" data-name="" data-type="" data-type_filter="" data-search="location">
                                 
                            <i class="fa fa-times" aria-hidden="true"></i>
                            No se encontraron resultados 
                            </a>
                        </li>`
        } else {

            for (let data of this.data) {
                liTag += `<li class="li_location_mouse" data-id="${data.id}" data-fullname="${data.filter_name}" data-name="${data.filter_name}" data-type="${data.type}" data-type_filter="${data.type_filter}" data-search="location">
                            <a data-id="${data.id}" data-fullname="${data.filter_name}" data-name="${data.filter_name}" data-type="${data.type}" data-type_filter="${data.type_filter}" data-search="location">
                            ${data.filter_name} ${data.type ? '(' + data.type + ')' : ''}</a>
                          </li>`
            }
        }


        return liTag;
    }

}
