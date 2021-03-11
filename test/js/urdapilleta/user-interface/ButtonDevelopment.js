
import { BaseElement } from './BaseElement'

export class Button extends BaseElement {
    constructor(id, title, link, disable) {
        super();
        this._id = id;
        this.title = title;
        this.link = link;
        this.disable = (typeof disable === 'undefined') ? '' : disable;
    }

    getElementString() {

        // <button id="filter-nav" class="filter-search-btn close-panel">
        //         Buscar
        //         </button>

        return `<a class="casaroyal-btn" data-action="developments" data-page="${this.link}" ${this.disable} id="${this._id}"><i data-action="properties" data-page="${this.link}" class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span data-action="developments" data-page="${this.link}">${this.title}</span></a>`;

        //return `<button class="btn btn-primary centered justify-content-center" data-toggle="button" aria-pressed="false" autocomplete="off" type="button" data-action="properties" data-page="${this.link}" ${this.disable} id="${this._id}">${this.title}</button>`
    }



}
