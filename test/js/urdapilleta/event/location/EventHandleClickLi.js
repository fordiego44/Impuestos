export default class EventHandleClickLi {
    constructor(elem) {
        this._element = elem;
        elem.mouseover = this.onClick.bind(this)

    }

   location(e){

        const { id, name } = e;

   }

    onClick(e) {
         let {action} = e.target.dataset
        if (action) {
            this[action](e.target)
        }
    }


}
