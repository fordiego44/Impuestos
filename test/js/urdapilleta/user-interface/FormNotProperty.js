import { BaseElement } from './BaseElement'

export class FormNotProperty extends BaseElement {

    constructor(id) {
        super();
        this._id = id;
        //this.title = title;
        //this.link = link;
        //this.disable = (typeof disable === 'undefined') ? '' : disable;

    }
    getElementString() {
        //return `<a class="casaroyal-btn" data-action="properties" data-page="${this.link}" ${this.disable} id="${this._id}"><i data-action="properties" data-page="${this.link}" class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span data-action="properties" data-page="${this.link}">${this.title}</span></a>`;
        return `<div > <h5  class="entry-title">` +
            `<a type='button' href="#formNotProperties" data-toggle="collapse" >No encontraste lo que buscás? En urdapilleta.com.ar personalizamos tu Búsqueda. Para recibir ayuda por uno de nuestros asesores, haz <strong>Click acá para comenzar.</strong></a>` +
            `<div class="property-contact-agent collapse" id='formNotProperties'>` +
            `<h3 class="entry-title">Quiero que me llamen.</h3>` +
            `<h5 class="entry-title">Si no has encontrado las propiedades que buscas, no te preocupes. Completá con tus datos. Uno de nuestros asesores inmobiliarios tomará contacto con vos para personalizar tu búsqueda.</h5>` +
            `<form id="property-not-form" novalidate="novalidate">` +
            `<input type="text" name="name" id='no_name' placeholder="Nombre Completo" class="name required" title="* Por favor, ingrese su nombre completo">` +
            `<input type="text" name="phone" id='no_phone' placeholder="Whatsapp > 11223344" class="phone required" title="* Por favor, ingrese un núnmero de teléfomo o whatsapp">` +
            `<input type="text" name="email" id='no_email' placeholder="Email" class="email required" title="* Por favor, ingrese un correo electrónico">` +
            `<div class="submit-require-showing-property-form">` +
            `<input style='width:100%;color: #fff !important; font-family: Rubik, sans-serif; padding: 15px 13px; border-radius: 3px; background-color: #a71b20; display: inline-block; text-align: center; margin-right: 10px; font-weight: 500; min-width: 60px; font-size: 20px;'  type='button' id="${this._id}" style='width: 97%;'   class="buttonWrap button bg-highlight button-sm button-rounded uppercase ultrabold contactSubmitButton top-30"  value='Quiero que me llamen' > ` +
            `</div>` +
            `</form>` +
            `</div>` +
            `</h5></div>`;
    }







}
