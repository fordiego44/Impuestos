import { BaseElement } from './BaseElement'

export class SpanListTitleDevelopment extends BaseElement {

    constructor(cant, total) {
        super()
        this.cant = cant;
        this.total = total;
    }

    getElementString() {
        return `<span>Mostrando ${this.cant} de ${this.total} Emprendimientos en urdapilleta</span>`
    }

}
