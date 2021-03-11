import EventHandleClick from './event/EventHandleClick'
import { Message } from './user-interface/Message';
const HOST = `${location.protocol}//${location.host}`;

document.addEventListener("DOMContentLoaded", function (event) {

    sessionStorage.removeItem('orders')

    new EventHandleClick(document.getElementById('ul-principal'))

    $('#tab-list').on('click', ' .btn-message', async function (e) {
        const { dataset: { id, user, costumer_id }, value } = e.target;
        e.preventDefault();
        e.stopPropagation();

        let data = {
            order_id: id,
            message: $('#message').val(),
            to: costumer_id,
            reception_id: id,
            costumer_id: costumer_id,
            user_id: user,
            from: user
        }
        const { status } = await axios.post(`${HOST}/api/v1/messages/create`, data)
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


    });

    $('#tab-list').on('click', '.chat-header .close', function (e) {
        const list = document.getElementById("tab-list");
        list.innerHTML = '';

    });
    function scrollToEnd(id) {
        var d = $(`#conversation-${id}`);
        d.scrollTop(d.prop("scrollHeight"));
    }

})
