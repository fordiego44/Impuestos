import { BaseElement } from '../BaseElement'

//@todo Checkbox create one

export default class LiDevelopment extends BaseElement {

    constructor(category, title, data) {
        super()
        this._id = category
        this.title = title
        this.data = data

    }

    getElementString() {
        let liTag = ''
        liTag = `<li>
	            			<a href="#"><i class="fa fa-align-justify" aria-hidden="true"></i>Emprendimientos encontrados:</a>
	            		</li>`
        for (let data of this.data) {
            liTag += `<li class="li_location_mouse" data-id="${data.location_id}" data-fullname="${data.title}" data-name="${data.title}" data-search="development">
                        <a data-id="${data.location_id}" data-fullname="${data.title}" data-name="${data.title}" data-search="location">
                        <i data-search="development" class="fa fa-dot-circle-o" data-id="${data.location_id}" data-fullname="${data.title}" data-name="${data.title}" data-action="development" aria-hidden="true"></i>
                            ${data.title}  </a>
                      </li>`
        }
        return liTag;
    }
}
