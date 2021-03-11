import {BaseElement} from './BaseElement'

export default class Item extends BaseElement {
    constructor(id, title, data) {
        super()
        this._id = id
        this.title = title
        this.data = data

    }

    createItem(property) {

        let imgTag = (property.photos != null) ? property.photos[0].image : 'images/properties/property-2.jpg';
        let hrefTag = `${document.location.origin}/emprendimiento/${property.title_href}`;

        // let icons = this.getIcons(this.data.type.id);
        //@todo Development Description
        let item = `<div class="col-md-12 property-list-item property-item-data clearfix"
                     data-lat="${property.geo_lat}"
                     data-long="${property.geo_long}"
                     data-title="${property.publication_title}"
                     data-thumb="${imgTag}"
                     data-pin="/images/svg/house-1.svg"
                     data-price=""
                     data-type=""
                     data-desc="${property.description.substr(0,50)}"
                     data-link="${hrefTag}"
                     data-id="${property.id}">

                        <div class="property-list-content">
                    
                    
                            <a href="${hrefTag}"
                               class="property-list-image"
                               style="background-image: url(${imgTag});">
                               <img src="${imgTag}">
                            </a>
                    
                            <div class="property-list-item-holder">
                    
                    
                                <a href="${hrefTag}">
                                    <h4 class="property-list-title">${property.publication_title}</h4>
                                </a>
                    
                                <div class="property-price">
                                    <span class="status-label">
                                        <span class="property-type">${property.description.substr(0,90)}..</span>
                                    </span>
                                </div>
                    
                                <div class="casaroyal-property-agent-name">
                                    <!-- <i class="fa fa-marker" aria-hidden="true"></i> -->
                                    <a href="/sucursales">${property.branch.name}</a>
                                </div>
                    
                    
                                <div class="property-meta">
                    
                                    <div class="property-meta-list">
                    
                    
                                        <div class="property-grid-price">
                                            <span class="price-prefix"></span>
                                            <span class="property-price-holder"><span
                                                    class="property-price-number"><a style="color: white;"
                                                                                     href="${hrefTag}">Ver Proyecto</a></span></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`


        return item;
    }

    getElementString() {
        let itemList = ''
        for (let data of this.data) {
            itemList += this.createItem(data);
        }
        return itemList;
    }
}
