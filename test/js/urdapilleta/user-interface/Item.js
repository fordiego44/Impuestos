import { BaseElement } from './BaseElement'

export default class Item extends BaseElement {
    constructor(id, title, data) {
        super()
        this._id = id
        this.title = title
        this.data = data

    }

    getIcons(property) {
        let icons = '';
        switch (property.type.id) {
            case 2:
                icons = ` <span>|</span> <span> ${([2, 3, 4, 5, 6, 7, 8, 11, 20].includes(property.type.id)) ? property.roofed_surface : property.surface} m²</span>
                        <!-- Cochera --> 
                        <span>|</span> ${property.parking_lot_amount} <i class="fa fa-car"></i> 
                        <!-- Banio --> 
                        <span> | </span> ${property.bathroom_amount} <i class="fa fa-bath"></i>  
                        <!-- habitaciones -->  
                        </span> | <span>${property.room_amount} <i class="fa fa-bed"></i>`;
                break;
            case 3:
                icons = `    <span>|</span> <span> ${([2, 3, 4, 5, 6, 7, 8, 11, 20].includes(property.type.id)) ? property.roofed_surface : property.surface} m²</span>
                            <!-- Cochera -->
                            <span>|</span> ${property.parking_lot_amount} <i class="fa fa-car"></i> 
                            <!-- Banio -->
                            <span> | </span> ${property.bathroom_amount} <i class="fa fa-bath"></i> 
                            <!-- habitaciones --> 
                            </span> | <span>${property.suite_amount} <i class="fa fa-bed"></i>`;
                break;
            case 8, 1:
                icons = `<span>|</span> <span> ${([2, 3, 4, 5, 6, 7, 8, 11, 20].includes(property.type.id)) ? property.roofed_surface : property.surface} m²</span> `;
                break;
            case 10:
                icons = `<span>|</span> ${property.parking_lot_amount} <i class="fa fa-car"></i>`;
                break;
            case 5:
                icons = `  <span>|</span>  <span>${([2, 3, 4, 5, 6, 7, 8, 11, 20].includes(property.type.id)) ? property.roofed_surface : property.surface} m²</span>
                        <!-- Banio -->
                        <span> | </span> ${property.bathroom_amount} <i class="fa fa-bath"></i> 
                        <!-- habitaciones --> 
                        </span> | <span>${property.suite_amount} <i class="fa fa-bed"></i>`;
                break;
            case 7:
                icons = ` <span>|</span> <span> ${([2, 3, 4, 5, 6, 7, 8, 11, 20].includes(property.type.id)) ? property.roofed_surface : property.surface} m²</span>
                            <!-- Cochera -->
                            <span>|</span> ${property.parking_lot_amount} <i class="fa fa-car"></i> 
                            `;
                break;
            case 14:
                icons = ` <span>|</span> <span> ${([2, 3, 4, 5, 6, 7, 8, 11, 20].includes(property.type.id)) ? property.roofed_surface : property.surface} m²</span>
                            <!-- Cochera -->
                            <span>|</span> ${property.parking_lot_amount} <i class="fa fa-car"></i>`;
                break;
            default:
                icons = `  <span>|</span> <span> ${([2, 3, 4, 5, 6, 7, 8, 11, 20].includes(property.type.id)) ? property.roofed_surface : property.surface} m²</span>
                        <!-- Cochera --> 
                        <span>|</span> ${property.parking_lot_amount} <i class="fa fa-car"></i> 
                        <!-- Banio --> 
                        <span> | </span> ${property.bathroom_amount} <i class="fa fa-bath"></i>  
                        <!-- habitaciones -->  
                        </span> | <span>${property.room_amount} <i class="fa fa-bed"></i> 
                        <!-- ambientes -->   
                        </span> | <span>${property.suite_amount} <i class="fa fa-bed"></i>`;
                break;
        }

        return icons;
    }

    createItem(property) {

        let imgTag = (property.photos != null) ? property.photos[0].image : 'images/properties/property-2.jpg';
        let hrefTag = `${document.location.origin}/propiedad/${property.id}-${property.title_href} `;
        let price = '';
        let expenses = ''
        let currency = (property.operations[0].prices[0].currency == "USD") ? "U\$S" : property.operations[0].prices[0].currency;
        if (property.operations[0].prices[0].price == "1") {
            price = '<span class="property-price-number">CONSULTAR</span>';
        } else {
            price = `${currency} <span class="property-price-number">  ${property.operations[0].prices[0].price} ${property.operations[0].operation_type}</span>`;
        }
        if (property.producer == null) {
            property.producer = {};
        }
        if ((property.operations[0].operation_type == 'Alquiler' || property.operations[0].operation_type == 'Alquiler temporario') && property.expenses > 0) {
            let expenses = ` < div class="property-grid-price" >
                    <span class="price-prefix"></span>
                    <span class="property-price-holder">$<span class="property-price-number"> ${property.expenses} expensas</span></span>

                </div > `
        }


        let item = `<div class="col-sm-12 col-md-6 col-xl-4 property-list-item property-item-data"> 
                        <a href="${hrefTag}" class="pxp-results-card-1 rounded-lg" data-prop="1">
                            <div id="card-carousel-1" class="carousel slide" data-ride="carousel" data-interval="false">
                                <div class="carousel-inner">
                                    <div class="carousel-item active overlay" style="background-image: url(${imgTag});" > </div>  
                                </div>  
                            </div>
                            <div class="pxp-results-card-1-gradient"></div>
                            <div class="pxp-results-card-1-details">
                                <div class="pxp-results-card-1-details-title" style="white-space: none;">${property.publication_title}</div>
                                <div class="pxp-results-card-1-details-price"> ${price} </div>
                            </div>
                            <div class="pxp-results-card-1-features">
                                <span> <strong>En Venta</strong>${this.getIcons(property)}
                            </div> 
                            <div class="pxp-results-card-1-save"><span class="fa fa-play"></span></div>
                        </a>
                    </div>`;
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
