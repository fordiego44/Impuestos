import { BaseElement } from './BaseElement'

export class SpanListTitle extends BaseElement {

    constructor(cant, total, title) {
        super()
        this.cant = cant;
        this.total = total;
        this.title = title;
    }

    getElementString() {
        return `<span>Mostrando ${this.cant} de ${this.total} Propiedades en ${this.title}</span>`
    }

}
