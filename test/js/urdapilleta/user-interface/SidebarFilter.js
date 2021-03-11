import { BaseElement } from './BaseElement'

//@todo Checkbox create one

export default class SidebarFilter extends BaseElement {

    constructor (category, title, data) {
        super()
        this._id = category
        this.title = title
        this.data = data

    }

    getElementString () {
        let checkboxTags = ''
        for (let data of this.data) {
            //<input class="${this._id}-checkbox" type="checkbox" name="${data.name}" value="${data.id}" data-action="${this._id}" id="${data.name}${data.id}">
            checkboxTags += `<div class="af-estate-search-field">
                                
                                <label value="${data.id}" data-action="${this._id}" id="${data.name}${data.id}" for="${data.name}${data.id}">${data.name} <small>(${data.count})</small></label>
                             </div>`

        }
        return checkboxTags;
    }
}
