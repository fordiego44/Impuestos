import { BaseElement } from './BaseElement'


export class Message extends BaseElement {

    constructor(data) {
        super()

        this.data = data
    }

    getElementString() {
        let message = '';


        message += `<div class="chat chat-user">
                            <div class="user-avatar"></div>
                            <span class="chat-text">${this.data}</span>
                        </div>`
        return message;
    }
}