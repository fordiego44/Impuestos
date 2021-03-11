import {BaseElement} from './BaseElement'
import {getParams} from "../actions/UrlQuery";
import {DEVELOPMENTS_STATUS} from '../services/codeTokko'

export default class DevelopmentFilterActive extends BaseElement {

    constructor(id, title) {

        super()
        this._id = id
        this.title = title

    }

    createLiString(type, title, value) {

        return `<div class="property-grid-price remove-filter" data-query="${type}" data-value="${value}" data-action="remove" style="cursor: pointer">
                                <span class="price-prefix"></span>
                                <span class="property-price-holder"  data-query="${type}" data-value="${value}" data-action="remove"><i class="fa fa-remove" aria-hidden="true"></i> <span class="property-price-number" data-query="${type}" data-value="${value}" data-action="remove">${title}</span></span>
                            </div>`

        // return `<li data-query="${type}" data-value="${value}" data-action="remove" style="cursor: pointer" class="breadcrumb-item remove-filter">${title}
        //             <i data-query="${type}" data-value="${value}" data-action="remove" class="fa fa-close remove-filter"></i>
        //         </li>`
    }

    getElementString() {

        let liTags = ''
        const {location, page, branch, status} = getParams();
        if (status) {

            const statusList = document.querySelectorAll('.development-status');
            Array.from(statusList).map(value => {
                if(value.dataset.statusId == status) {
                    liTags += this.createLiString('status', value.textContent, value.dataset.statusId);
                    value.remove();
                }
            })
        }

        // if (page) {
        //     page.split(',').map((valueQuery) => {
        //         liTags += this.createLiString('page', `Pagina ${valueQuery}`,valueQuery)
        //
        //     })
        // }

        if (branch) {

            const branches = document.querySelectorAll('.development-branch');
            Array.from(branches).map(value => {
                if(value.dataset.branchId == branch) {
                    liTags += this.createLiString('branch', value.textContent, value.dataset.branchId);
                    value.remove();
                }
            })

        }

        if (location) {
            const locations = document.querySelectorAll('.development-location');
            Array.from(locations).map(value => {
                if(value.dataset.locationId == location) {
                    liTags += this.createLiString('location', value.textContent, value.dataset.locationId);
                    value.remove();
                }
            })
        }

        return liTags;

    }
}
