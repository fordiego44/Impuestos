import {Item} from '../user-interface/Item'
import {Button} from '../user-interface/ButtonDevelopment'
import {SpanListTitleDevelopment} from '../user-interface/SpanListTitleDevelopment'
const HOST = `${location.protocol}//${location.host}`;

export let actionUpdateButtonMoreDevelopment = (meta = {}, type) => {
    let {current_page: currentPage, from: fromPage, last_page: lastPage, per_page: perPage, total: totalPage} = meta;
    let nextPage = currentPage;
    if (typeof currentPage === 'undefined') {
        currentPage = document.getElementsByName('meta_current_page')[0].value
        lastPage = document.getElementsByName('meta_last_page')[0].value
        fromPage = document.getElementsByName('meta_from')[0].value
        totalPage = document.getElementsByName('meta_total')[0].value
        perPage = document.getElementsByName('meta_per_page')[0].value
    }
    let listCant;
    const propertiesListCant = document.getElementById('properties-list').childElementCount
    if(propertiesListCant < 8){
        listCant = propertiesListCant;
    }else {
        if((Number(perPage) > 8)){
            listCant = propertiesListCant;
        }else{
            listCant = 8+((propertiesListCant-8)*8);
        }
    }
    if(listCant > totalPage){

        listCant = totalPage;

    }

    if (parseInt(currentPage) < parseInt(lastPage)) {
        switch (type) {
            case 'loading':
                let propertyLoadingButton = new Button(`property-loading`, `Cargando Emprendimientos ...`, null,'disabled')
                propertyLoadingButton.appentToElement('casaroyal_ajax_load_more');
                break;

            default:
                let count = totalPage - (currentPage * perPage)
                let title = `Ver más emprendimientos (${count})`
                let propertyMoreButton = new Button(`property-more`, title, +currentPage + 1)
                propertyMoreButton.appentToElement('casaroyal_ajax_load_more');
                let spanListTitle = new SpanListTitleDevelopment(listCant, totalPage)
                spanListTitle.appentToElement('property-list-title');
                if(nextPage){
                    document.getElementsByName('meta_current_page')[0].value = nextPage;
                }
                break;
        }
    } else {
        let elem = document.getElementById('property-loading')
        if (elem !== null) elem.parentNode.removeChild(elem);
        let spanListTitle = new SpanListTitleDevelopment(listCant, totalPage)
        spanListTitle.appentToElement('property-list-title');
    }

}
