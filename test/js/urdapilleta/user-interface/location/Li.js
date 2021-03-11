import { BaseElement } from '../BaseElement'

//@todo Checkbox create one

export default class LiLocation extends BaseElement {

    constructor(category, title, data, development) {
        super()
        this._id = category
        this.title = title
        this.data = data
        this.development = development

    }
    /*
    <i data-search="location" class="fa fa-dot-circle-o" data-id="${data.location_id}" data-fullname="${data.short_name}" data-name="${data.location_name}" data-action="location" aria-hidden="true">
                    </i>*/
    getElementString() {
        let liTag = ''
        for (let data of this.data) {
            liTag += `<li class="li_location_mouse" data-id="${data.location_id}" data-fullname="${data.short_name}" data-name="${data.location_name}" data-type='location' data-search="location">
                    <a data-id="${data.location_id}" data-fullname="${data.short_name}" data-name="${data.location_name}" data-type='location' data-search="location">
                    
                        ${data.short_name} ${data.type_title ? '(' + data.type_title + ')' : ''}</a>
                  </li>`
        }
        liTag += `<li>
                        <a href="#"><i class="fa fa-align-justify" aria-hidden="true"></i>Emprendimientos encontrados:</a>
                  </li>`
        for (let data of this.development) {
            liTag += `<li class="li_location_mouse" data-id="${data.location_id}" data-fullname="${data.name}" data-name="${data.location_name}" data-type='development' data-search="location">
            <a data-id="${data.location_id}" data-fullname="${data.name}" data-name="${data.location_name}" data-type='development' data-search="location">
            
                ${data.name}  </a>
            </li>`
        }
        /*<i data-search="development" class="fa fa-dot-circle-o" data-id="${data.location_id}" data-fullname="${data.name}" data-name="${data.location_name}" data-action="development" aria-hidden="true">
                    </i> */
        return liTag;
    }

}
