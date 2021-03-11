let paginator = {
    pagesNumber(pagination) {
        let offset = 8;

        if (!pagination.to) {
            return [];
        }

        var from = pagination.current_page - offset;
        if (from < 1) {
            from = 1;
        }

        var to = from + (offset * 2);
        if (to >= pagination.last_page) {
            to = pagination.last_page;
        }

        var pagesArray = [];
        while (from <= to) {
            pagesArray.push(from);
            from++;
        }
        return pagesArray;
    },
    setPaginatorHTML(data) {
        let numberPager = this.pagesNumber(data);

        let html = [], preview, next;
        for (let i = 0; i < numberPager.length; i++) {
            let active = numberPager[i] == data.current_page ? 'active' : '';
            if (data.current_page > 1) {
                preview = `<li class="page-item" >
                            <a class="page-link"  onclick="paginator.cambiarPagina('${data.current_page - 1}')">Ant</a>
                        </li>`
            }
            if (data.current_page < data.last_page) {
                next = `<li class="page-item "  >
                        <a class="page-link "  onclick="paginator.cambiarPagina('${data.current_page + 1}')">Sig</a>
                    </li>`
            }
            html[i] = `<li class="page-item  ${active}">
                    <a class="page-link current-page" onclick="paginator.cambiarPagina(${numberPager[i]})">${numberPager[i]}</a>
                    </li>`
        }
        html.unshift(preview);
        html.push(next);

        return html;
    },
    cambiarPagina(page) {
        search.searchCompanies(page);
    },
    getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }
}

let search = {
    async init(page = 0) {
        const { data: info } = await axios.get(`https://ipinfo.io?token=06e6161325a723`)
        const { data: city } = await axios.get(`/search-department?info=${info.city}`)
        let department = paginator.getParameterByName('department') ? paginator.getParameterByName('department') : city;
        let business = paginator.getParameterByName('business') ? paginator.getParameterByName('business') : $("select[name=business]").val();
        let name = paginator.getParameterByName('name') ? paginator.getParameterByName('name') : $("select[name=name]").val();


        const { data: data } = await axios.get(`/resultados-companies?page=${page}&department=${department}&business=${business}&name=${name}&info=${info.city}`)

        const pageHtml = paginator.setPaginatorHTML(data.pagination);
        const companies = this.showGrid(data.companies.data);
        $('#content-companies').empty().append(companies);
        $('#paginationNav').empty().append(pageHtml);

        let html = []

        let { data: array } = await axios.get(`all-companies?department=${department}&business=${business}`)
        for (let i = 0; i < array.length; i++) {
            html[i] = `<option value='${array[i].id}'>${array[i].company}</option>`;
        }
        html.unshift(`<option value="">buscar ... </option>`)
        $('select[name=name]').empty().append(html)
        $('select[name=name]').trigger("chosen:updated");

        $("#department option[value='" + department + "']").prop("selected", "selected")
        $("#business option[value='" + business + "']").prop("selected", "selected")
        $("#name option[value='" + name + "']").prop("selected", "selected")


        $('select[name=department]').trigger("chosen:updated");
        $('select[name=business]').trigger("chosen:updated");
        $('select[name=name]').trigger("chosen:updated");


    },
    async searchCompanies(page = 0) {
        let department = $("select[name=department]").val();
        let business = $("select[name=business]").val();
        let name = $("select[name=name]").val();

        const { data: data } = await axios.get(`/resultados-companies?page=${page}&department=${department}&business=${business}&name=${name}`)
        const pageHtml = paginator.setPaginatorHTML(data.pagination);
        const companies = this.showGrid(data.companies.data);
        $('#content-companies').empty().append(companies);
        $('#paginationNav').empty().append(pageHtml);
    },
    setCompanies(params) {
        let html = [];
        for (let i = 0; i < params.length; i++) {
            html = `<div class="col-lg-4 col-md-6">
            <a href="/resultados/${params[i].slug}/${params[i].id}" class="listing-item-container compact">
                <div class="listing-item">
                    <img src="images/${params[i].image}" alt="">

                        <div class="listing-badge now-open">Now Open</div>

                        <div class="listing-item-content">
                            <div class="numerical-rating" data-rating="3.5"></div>
                            <h3>${params[i].name}<i class="verified-icon"></i></h3>
                            <span>964 School Street, New York</span>
                        </div>
                        <span class="like-icon"></span>
                </div>
            </a>
        </div>`
        }
        return html;
    },
    showGrid(params) {


        let html = [];
        let state, liked = ''
        for (let i = 0; i < params.length; i++) {
            if (params[i].state == 1) {
                state = `<div class="listing-badge now-open">Abierto</div>`
            } else {
                state = `<div class="listing-badge now-closed">Cerrado</div>`
            }
            if (params[i].liked == 1) {
                liked = `<span class="like-icon liked" data-id="${params[i].id}" onclick=" ;return false;"></span>`
            } else {
                liked = `<span class="like-icon" data-id="${params[i].id}" onclick=" ;return false;"></span>`
            }

            html[i] = `<div class="col-lg-4 col-md-6">
                            <a href="/resultados/${params[i].slug}/${params[i].id}" class="listing-item-container compact" tabindex="0">
                                <div class="listing-item">
                                    <img src="images/${params[i].image}" alt=""/> 
                                    ${state}
                                    <div class="listing-item-content">
                                        <div class="numerical-rating" data-rating="${params[i].qualification}.0"></div>
                                        <h3>${params[i].company}<i class="verified-icon"></i></h3>
                                        <span>${params[i].address}</span>
                                    </div>
                                    ${liked} 
                                </div>
                            </a>
                        </div>`;

        }
        return html;
    },
    showList(params) {
        let html = [];
        for (let i = 0; i < params.length; i++) {
            html[i] = `<div class="col-lg-12 col-md-12">
                            <div class="listing-item-container list-layout">
                                <a href="/resultados/${params[i].slug}/${params[i].id}" class="listing-item"> 
                                    <!-- Image -->
                                            <div class="listing-item-image">
                                            <img src="images/${params[i].image}" alt="">
                                            <span class="tag">${params[i].business}</span>
                                            </div> 
                                    <!-- Content -->
                                        <div class="listing-item-content"> 
                                        <div class="listing-item-inner">
                                            <h3>${params[i].company}</h3>
                                            <span>778 Country Street, New York</span>
                                            <div class="star-rating" data-rating="2.0">
                                                <div class="rating-counter">(17 reviews)</div>
                                            </div>
                                        </div> 
                                        <span class="like-icon"></span> 
                                        <div class="listing-item-details">${params[i].address}</div>
                                    </div>
                                </a>
                            </div>
                        </div>`
        }
        return html;

    },
    filterShow(data) {
    },
    setNameCompanies(params) {
        let liTag = '';
        for (let data of params) {
            liTag += `<li class="li_location_mouse active-result" data-id="${data.id}" data-fullname="${data.company}" data-name="${data.company}" data-search="location">
                        <a data-id="${data.id}" data-fullname="${data.company}" data-name="${data.company}" data-search="location">
                        <i data-search="location" class="fa fa-dot-circle-o" data-id="${data.id}" data-fullname="${data.company}" data-name="${data.company}" data-action="location" aria-hidden="true"></i>
                            ${data.company}</a>
                    </li>`
        }
        return liTag;
    },
    async getNameCompanies() {
        const { status, data: data } = await axios.get('/name-companies')
        if (status === 200) {
            localStorage.setItem('name_companies', JSON.stringify(data));
        }
    }
}

search.getNameCompanies();
search.init();
$('#btnSearch').on('click', function () {

    search.searchCompanies();
});

$('#department').on('change', async function () {

    let html = []

    let { data: array } = await axios.get(`all-companies?department=${this.value}`)
    for (let i = 0; i < array.length; i++) {
        html[i] = `<option value='${array[i].id}'>${array[i].company}</option>`;
    }
    html.unshift(`<option value="">buscar ... </option>`)
    $('select[name=name]').empty().append(html)
    $('select[name=name]').trigger("chosen:updated");
});
$('#business').on('change', async function () {

    let html = []
    let department = $("select[name=department]").val();
    let business = $("select[name=business]").val();
    let name = $("select[name=name]").val();

    let { data: array } = await axios.get(`all-companies?department=${department}&business=${business}`)
    for (let i = 0; i < array.length; i++) {
        html[i] = `<option value='${array[i].id}'>${array[i].company}</option>`;
    }
    html.unshift(`<option value="">buscar ... </option>`)
    $('select[name=name]').empty().append(html)
    $('select[name=name]').trigger("chosen:updated");
});
