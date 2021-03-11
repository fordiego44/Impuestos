import { BaseElement } from './BaseElement'


export class Tab extends BaseElement {

    constructor(costumer, data) {
        super()
        this.costumer = costumer
        this.data = data
    }

    getElementString() {
        let tab = ''
        let messages = '';
        const costumer_id = this.data.customer_id;
        const user_id = this.data.id_user;

        for (let data of this.data.messages) {
            if (this.costumer == 'costumer') {
                if (data.from == costumer_id) {

                    messages += `<div class="chat chat-user">
                                    <div class="user-avatar"></div>
                                    <span class="chat-text">${data.message}</span>
                                </div>`
                } else {
                    messages += `<div class="chat">
                                    <div class="user-avatar"></div>
                                    <span class="chat-text">${data.message}</span>
                                </div>`
                }
            }
            else {

                if (data.from == user_id) {
                    messages += `<div class="chat chat-user">
                                    <div class="user-avatar"></div>
                                    <span class="chat-text">${data.message}</span>
                                </div>`
                } else {
                    messages += `<div class="chat">
                                    <div class="user-avatar"></div>
                                    <span class="chat-text">${data.message}</span>
                                </div>`
                }
            }
        }
        tab += `<div class="tabs-container-chat">
                    <div class="chat-tab" data-id='${this.data.id}'>
                        <div class="chat-header" style='display:flex;justify-content: space-between;'>
                        
                            <a href="#" class="user-name" title=" ">
                            #000${this.data.pending}
                            </a>
                            <div class="close" style='font-size:20px; margin-right: 10px'><i class="im im-icon-Close"></i></div>
                        </div>
                        <div class="chat-body">
                            <div class="chat-container" id="conversation-${this.data.id}"> 
                                ${messages}
                            </div>
                        </div>
                        <div class="chat-footer">
                            <div class="message-form" style='display: flex'>
                                <textarea style='min-height: auto;' row='1' data-id='${this.data.id}' data-user='${this.data.id_user}' data-costumer_id='${this.data.customer_id}'  autocomplete="off" class="message" name="message" id="message"  placeholder="Escribe un mensaje..."/> </textarea>
                                <button  data-id='${this.data.id}' data-user='${this.data.id_user}' data-costumer_id='${this.data.customer_id}'  class='btn-message'>Enviar</button>
                            </div>
                        </div>
                    </div>
                </div>`;
        return tab;
    }
}