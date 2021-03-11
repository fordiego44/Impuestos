import EventHandleClick from './event/EventHandleClick'
import { Message } from './user-interface/Message';
document.addEventListener("DOMContentLoaded", function (event) {

    sessionStorage.removeItem('orders')

    new EventHandleClick(document.getElementById('ul-principal'))

    $('#tab-list').on('click', ' .btn-message', async function (e) {
        e.preventDefault();
        e.stopPropagation();
        const { dataset: { id, user }, value } = e.target;

        let data = {
            order_id: id,
            message: $('#message').val(),
            to: user,
            reception_id: id,
            user_id: user,
            costumer_id: document.getElementById('costumer_chat').value,
            from: document.getElementById('costumer_chat').value
        }
        const { status } = await axios.post(`/api-web/v1/messages/create`, data)

        if (status === 200) {
            let message = new Message($('#message').val());
            $('#message').val(" ")
            message.insertDeleteAfterToElement(`conversation-${id}`);
            scrollToEnd(id);
            setTimeout(() => {
                const list = document.getElementById("tab-list");
                list.innerHTML = '';
            }, 1000);

        }

    })

    $('#tab-list').on('click', '.chat-header .close', function (e) {
        const list = document.getElementById("tab-list");
        list.innerHTML = '';

    });
    function scrollToEnd(id) {
        var d = $(`#conversation-${id}`);
        d.scrollTop(d.prop("scrollHeight"));
    }
})
