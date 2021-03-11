import {findBlog} from './blog/news'
import ItemBlog from './user-interface/ItemBlog'
const loadMore = document.querySelector('#casaroyal_ajax_load_more');

if (loadMore) {

    loadMore.addEventListener('click', function paginationBlog(e) {

        const currentPage = document.querySelector('#current_pagination');

        const currentValue = +currentPage.value + 1;

        const HOST = `${location.protocol}//${location.host}`;

        const url = {

            url: `${HOST}/api${document.location.pathname}${document.location.search}${(document.location.search.indexOf('?') == -1) ? '?' : '&'}page=${currentValue}`,

        };

        findBlog(url)
            .then(results => {

                if (results.length > 0) {
                    currentPage.value = currentValue
                    const items = new ItemBlog(currentValue,`Page ${currentValue}`,results)
                    items.insertAfterToElement('news')
                }
                if(results.length < 5){
                    loadMore.style.display = 'none';
                    document.querySelector('#casaroyal_ajax_load_more').removeEventListener('click', paginationBlog);
                }

            })
            .catch(e => console.log(e));

    });

}
