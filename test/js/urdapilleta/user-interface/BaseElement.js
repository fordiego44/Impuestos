export class BaseElement {
    constructor() {

        this.element = null;

    }
    appentToElement(el) {

        this.createElement()
        document.getElementById(el).innerHTML = this.element
        // el.after(this.element)

    }

    insertAfterToElement(el) {
        this.createElement()
        const elem = document.createElement('div');
        elem.style.cssText = 'display: flex;flex-wrap: wrap;width:100%';
        elem.innerHTML = this.element;
        document.getElementById(el).appendChild(elem)
    }
    createElement() {

        let stringElement = this.getElementString();
        this.element = stringElement;

    }

    getElementString() {

        throw 'Override'

    }

    enableJS() {

        componentHandler.upgradeElement(this.element[0])

    }
}
