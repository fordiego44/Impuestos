import { Tab } from '../user-interface/Tab'

export default class EventHandler {
    constructor(elem) {
        this._element = elem;
        elem.onclick = this.onClick.bind(this)

    }

    async talk(e) {
        const { dataset: { id } } = e.target;
        //  let orders = JSON.parse(sessionStorage.getItem('orders')) || []
        // const result = orders.filter(order => order == id);

        //if (result.length == 0) {
        //  orders.push(id);
        //   sessionStorage.setItem('orders', JSON.stringify(orders));
        const { status, data: data } = await axios.get(`/api-web/v1/orders/one/${id}`)

        if (status === 200) {
            const list = document.getElementById("tab-list");
            list.innerHTML = '';
            console.log('tab', data.reception);
            let tab = new Tab('costumer', data.reception)
            tab.insertAfterToElement('tab-list');
        }
        // }
    }
    async store(e) {
        console.log("state");
        const { dataset: { id } } = e.target;

        const { status, data: data } = await axios.get(`/api-web/v1/orders/one/${id}`)

        if (status === 200) {
            const list = document.getElementById("tab-list");
            list.innerHTML = '';
            console.log('tab', data.reception);
            let tab = new Tab('user', data.reception)
            tab.insertAfterToElement('tab-list');
        }
    }

    async sendMessage(e) {
        const { dataset: { id } } = e.target;
        if (e.keyCode === 13) {
            e.preventDefault();
            e.stopPropagation();
        }
    }
    onClick(e) {
        let { action } = e.target.dataset
        if (action) {
            this[action](e);
        }
    }
}
