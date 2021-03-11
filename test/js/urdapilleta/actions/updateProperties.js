
import { Button } from '../user-interface/Button'

import { SpanListTitle } from '../user-interface/SpanListTitle'
const HOST = `${location.protocol}//${location.host}`;

export let actionUpdateButtonMore = (meta = {}, type) => {
    let { current_page: currentPage, from: fromPage, last_page: lastPage, per_page: perPage, total: totalPage } = meta;
    let nextPage = currentPage;
    if (typeof currentPage === 'undefined') {
        currentPage = document.getElementsByName('meta_current_page')[0].value
        lastPage = document.getElementsByName('meta_last_page')[0].value
        fromPage = document.getElementsByName('meta_from')[0].value
        totalPage = document.getElementsByName('meta_total')[0].value
        perPage = document.getElementsByName('meta_per_page')[0].value
    }


    let listCant;
    const propertiesListCant = document.getElementById('properties-list').childElementCount;


    if (propertiesListCant < 12) {
        listCant = propertiesListCant;
    } else {
        listCant = 12 + ((propertiesListCant - 12) * 12);
    }

    if (listCant > totalPage) {
        listCant = totalPage;
    }
    if (parseInt(currentPage) < parseInt(lastPage)) {
        switch (type) {
            case 'loading':
                let propertyLoadingButton = new Button(`property-loading`, `Cargando Propiedades ...`, null, 'disabled')
                propertyLoadingButton.appentToElement('casaroyal_ajax_load_more');
                break;
            default:
                let count = totalPage - (currentPage * perPage)
                let title = `Ver más propiedades (${count})`
                let propertyMoreButton = new Button(`property-more`, title, +currentPage + 1)
                propertyMoreButton.appentToElement('casaroyal_ajax_load_more');
                let sub = document.getElementsByName('title_name')[0].value.split('|')
                let subtitle = ''
                switch (sub.length) {
                    case 1:
                        subtitle = sub[0]
                        break;
                    case 2:
                        subtitle = sub[1]
                        break;
                    case 3:
                        subtitle = sub[2]
                        break;
                }
                let spanListTitle = new SpanListTitle(listCant, totalPage, subtitle)
                spanListTitle.appentToElement('property-list-title');
                if (nextPage) {
                    document.getElementsByName('meta_current_page')[0].value = nextPage;
                }
                break;
        }
    } else {
        let sub = document.getElementsByName('title_name')[0].value.split('|')
        let subtitle = ''


        switch (sub.length) {
            case 1:
                subtitle = sub[0]
                break;
            case 2:
                subtitle = sub[1]
                break;
            case 3:
                subtitle = sub[2]
                break;
            default:
                break;
        }


        let elem = document.getElementById('property-loading')
        if (elem !== null) elem.parentNode.removeChild(elem);
        let spanListTitle = new SpanListTitle(listCant, totalPage, subtitle)
        spanListTitle.appentToElement('property-list-title');
    }

}
