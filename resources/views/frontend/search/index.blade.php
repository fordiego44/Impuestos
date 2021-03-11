@extends('frontend.app' , ['bussines'=> $business, 'users', $users])
@section('content')
<style>
    .fixed-wapp {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    position: absolute;
    right: 15px; 
    top: 15%;
    width: 260px;
    background: white;
    z-index: 999999999;
    display: flex;
    padding:8px; 
    flex-direction: row;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
}
</style>
<a   class="fixed-wapp" style="margin-top:0px"><i class="fa fa-map-marker" style=" color: #60b863; font-size: 20px;padding: 5px;"></i> Negocios cerca a tu ciudad</a>

<div id="map-container" class="fullwidth-home-map">
    <div id="map" data-map-zoom="9">
     </div>

	<div class="main-search-inner">

		<div class="container">
			<div class="row">
                <div class="col-md-1"></div>
				<div class="col-md-10">
					
                    <div class="main-search-input">
                        
                       
                        <div class="main-search-input-item">
                            <select  id="district" data-placeholder="Seleccionar distrito" name='district'   class="chosen-select">
                                @foreach ($districts as $item)
                                    <option value={{$item->_id}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="main-search-input-item">
                            <select data-placeholder="Categorias" name='category' class="chosen-select" id='business' >
                                <option value="">Todos los negocios</option>
                                @foreach ($business as $item)
                                    <option value={{$item->id}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div> 
                     
                  
                   
                </div>
                <div class="col-md-1"></div>

			</div>
		</div>

	</div>
 
</div> 
<div class="container margin-top-20">
	<div class="row">  
		<div class="col-lg-12 col-md-12"> 
			<div class="row margin-bottom-25"> 
				<div class="col-md-6 col-xs-6">
                    <div class="sort-by">
						<div class=" ">
                            <h5 for="" style="font-size: 16px;"><span id="cantCompany"></span> Resultados encontrados </h5>
                        </div>
                    </div>  
				</div> 
				<div class="col-md-6 col-xs-6"> 
					<div class="sort-by">
						<div class="sort-by-select">
							 
						</div>
					</div>
				</div>
			</div> 
            <div class="row fs-listings" id="content-products"> 
                
            </div> 
			<div class="clearfix"></div> 
             <div class="row fs-listings">
                <div class="col-md-12"> 
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="pagination-container margin-top-15 margin-bottom-40">
                                <nav class="pagination" id="paginationNav">
                                    <ul > 
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div> 
                </div>
            </div> 
            
		</div> 
	</div>
    </div>
   
    @endsection


@section('after-scripts')
<script src="https://api.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
 <script src={{asset('/js/frontend/calification.js')}}></script>
 

<script>
    $('.like-icon').on('click',function(){
         let user = $(this).attr('data-id');
        if(user){
            $.get('/like',{user:user},function(res){
                 
                if(res.status == "200"){
                    $('.sign-in').click();
                }
            })
        } 
    })
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }
 
    async function init() {
  
        district_id = $('#district').val() || '';
        const urlParams = new URLSearchParams(window.location.search);
        const business = urlParams.get('business') || '';
        //business = $('#business').val() || '';
        let page = 0; 
        let data2 = await axios.get(`/list-restaurant?business=${business}&district=${district_id}&page=${page}`);
     
        const html2 = productsHTML(data2.data.users.data)
        $('#content-products').empty().append(html2)
    }
    init()
    $('#business').change( async function( ) { 
        let params = {
      
            district_id: $('#district').val(), 
            business: $('#business').val(),
        }
        let page = 0;
        const data = await axios.post('/search-category', params)
    
        district_id = $('#district').val() || '';
        business = $('#business').val() || '';
        
        let data2 = await axios.get(`/list-restaurant?business=${business}&district=${district_id}&page=${page}`);
      
        const html = productsHTML(data2.data.users.data)
        $('#content-products').empty().append(html)
 
    })
    $('select[name=department]').change(async function() {
        let page = 0;
        let params = {
 
            district_id: $('select[name=district]').val(),
            business: $('#business').val(),
        }
		const data =  await axios.post('/filter-province',params)
		 
		let provinces = data.data.provincias;
		let html = []

		for (let i = 0; i < provinces.length; i++) {
			html[i] = `<option value=${provinces[i]._id}>${provinces[i].name}</option>` 
		}
		$('select[name=province]').empty().append(html)
		$('select[name=province]').trigger("chosen:updated");
      
        district_id = $('#district').val() || '';
        business = $('#business').val() || '';
        let data2 = await axios.get(`/list-restaurant?business=${business}&district=${district_id}&page=${page}`);
        const html2 = productsHTML(data2.data.users.data)
        $('#content-products').empty().append(html2)
       
        searchDistrict({
            department_id: $('select[name=department]').val(),
            province_id: $('select[name=province]').val(),
            district_id: $('select[name=district]').val(),
            business: $('#business').val(),
        })

    });     
    
    
    $('select[name=district]').change(async function() {
        let page = 0;
 
        district_id = $('#district').val() || '';
        business = $('#business').val() || '';

         let data2 = await axios.get(`/list-restaurant?business=${business}&district=${district_id}&page=${page}`);

        const html2 = productsHTML(data2.data.users.data)
        $('#content-products').empty().append(html2)

    }); 
     async function searchDistrict(params) {
        const data = await axios.post('/filter-district', params)
		let districts = data.data.distritos;
		let html = []
        for (let i = 0; i < districts.length; i++) {
			html[i] = `<option value=${districts[i]._id}>${districts[i].name}</option>` 
		}
		$('select[name=district]').empty().append(html)
		$('select[name=district]').trigger("chosen:updated");
    
     }
     function productsHTML(data) {
        let html = []
        for (let i = 0; i < data.length; i++) {

                
            
                full = Math.round(data[i].qualification)
                empty = 5- full;
                html[i] = `   
                            <div class="col-lg-4 col-md-6">
                                <a href="/resultados/${data[i].slug}/${data[i].id}" class="listing-item-container">
                                    <div class="listing-item">
                                        <img src="images/${data[i].image}" alt="">`;

                data[i].state == "1" ? html[i] += `<div class="listing-badge now-open">Abierto</div>`: html[i] +=  `<div class="listing-badge now-closed">Cerrado</div>`;

                html[i] +=                     `<div class="listing-item-content">
                                            <span class="tag">${data[i].business}</span> 
                                            <h3>${data[i].company} <i class="verified-icon"></i></h3>
                                           <!-- <span>${data[i].company}</span>-->
                                        </div>`;

                data[i].liked == "1" ? html[i] += `<span class="like-icon liked" data-id="${data[i].id}"></span>`: html[i] += `<span class="like-icon" data-id="${data[i].id}"></span>`;
                
                html[i]+=   `</div>
                                    <div class="star-rating" data-rating="${data[i].qualification}">
                                        <div class="rating-counter">(${data[i].opinions} críticas)</div>`;

                for(let j = 0; j < full; j++){html[i]+= `<span class="star"></span>`;}
                for(let j = 0; j < empty; j++){html[i]+= `<span class="star empty"></span>`;}

                html[i]+= `</div></a></div>`;
            }
            return html;
     }
     
     function categoryHTML(data) {
        let html = []
        for (let i = 0; i < data.length; i++) {
                html[i] = `   
                            <input id="check-${data[i].id}" type="checkbox" name="checked[]" class="check-category"  data-id=${data[i].id} data-text="1">
                            <label for="check-${data[i].id}">${data[i].name}</label>
                        `;
            }
            return html; 
     } 
    
    
</script> 
<script>
    $(document).ready(function(){
        const urlParams = new URLSearchParams(window.location.search);
        const business_id = urlParams.get('business');
        let business = ''
        if (business_id) { business = business_id;
        } else { business = $('#business').val() }
        $("#business option[value='" + business + "']").prop("selected", "selected")
        $('select[name=category]').trigger("chosen:updated"); 
        window.map = L.map('map', mapOptions);
        $('#scrollEnabling').hide();
        paginator.getUsers();
    }); 
    if ($('#map').attr('data-map-scroll') == 'true' || $(window).width() < 992) {
        var scrollEnabled = false;
    } else {
        var scrollEnabled = true;
    }
    var mapOptions = {
        gestureHandling: false,
        zoom: 18,
    }
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
                        <a class="page-link" onclick="paginator.cambiarPagina(${numberPager[i]})">${numberPager[i]}</a>
                        </li>`
            }
            html.unshift(preview);
            html.push(next);

            return html;
        }, async cambiarPagina(page) {
            $('#map .leaflet-control-container .leaflet-top').empty()
            let data2 = await axios.get(`/list-restaurant?business=${business}&district=${district_id}&page=${page}`);
            
            const html2 = this.productsHTML(data2.data.users.data)
            $('#content-products').empty().append(html2)
            this.getUsers(page);
        }, async getUsers(page = 0) {

            map.eachLayer(function (layer) {
                map.removeLayer(layer);
            });

        
            district_id = $('#district').val() || '';
            business = $('#business').val() || '';

            let { data: data } = await axios.get(`/list-restaurant?business=${business}&district=${district_id}&page=${page}`);
 
            let locations = [];

            $('#cantCompany').text(data.users.data.length)
            let html = this.setPaginatorHTML(data.pagination);
            $('#paginationNav ul').empty().append(html);
            data.users.data.forEach(element => {
                let icon = `<i class='im im-icon-Map-Marker'></i>`;
                /*
                if (element.business_id == 1) icon = `<i class='im im-icon-Chef-Hat'></i>`;
                if (element.business_id == 3) icon = `<i class='im im-icon-Add-UserStar'></i>`;
                if (element.business_id == 4) icon = `<i class='im im-icon-Polo-Shirt'></i>`;
                if (element.business_id == 5) icon = `<i class='im im-icon-Gear'></i>`;
                if (element.business_id == 6) icon = `<i class='im im-icon-Shop-4'></i>`;
                if (element.business_id == 7) icon = `<i class='im im-icon-Digital-Drawing'></i>`;*/
             
                locations.push([
                    this.locationData(
                        ' /resultados/' + element.slug + '/' + element.id, '/images/' + element.image,
                        element.company, element.company, '3.5', '12'),
                    element.latitude, element.longitude, 1, icon]);
            });
            var infoBox_ratingType = 'star-rating';
            map.on('popupopen', function () {
                if (infoBox_ratingType = 'numerical-rating') {
                    numericalRating('.leaflet-popup .' + infoBox_ratingType + '');
                }
                if (infoBox_ratingType = 'star-rating') {
                    starRating('.leaflet-popup .' + infoBox_ratingType + '');
                }
            });
            
            L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: " &copy;  <a href='https://www.mapbox.com/about/maps/'>Mapbox</a> &copy;  <a href='http://www.openstreetmap.org/copyright'>OpenStreetMap</a>",
                zoom: 18,
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoianVsY3NhciIsImEiOiJjamRqZXZlejMxbHR3MnpybGxkcGc5Z3BkIn0.ZntG4X4OuEvnbrUPSzKUSQ'
            }).addTo(map);
            //https://api.tiles.mapbox.com/v4/mapbox.streets/13/2426/3080@2x.png?access_token=pk.eyJ1IjoicHVyZXRoZW1lcyIsImEiOiJjanRnY203ZGEwamlxNDNydXZuZXl0Zjd1In0.sNlCSHyQwC4oQGckrLUUXA
            markers = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
            });
            var markerArray = [];

            for (var i = 0; i < locations.length; i++) {
                var listeoIcon = L.divIcon({
                    iconAnchor: [20, 51],
                    popupAnchor: [0, -51],
                    className: 'listeo-marker-icon',
                    html: '<div class="marker-container">' +
                        '<div class="marker-card">' +
                        '<div class="front face" style="border-color: #4CAF50;color: #4CAF50;">' + locations[i][4] + '</div>' +
                        '<div class="back face" style="background: #4CAF50;border-color: #4CAF50;">' + locations[i][4] + '</div>' +
                        '<div class="marker-arrow" style="border-color: #4CAF50 transparent transparent;"></div>' +
                        '</div>' +
                        '</div>'
                });
                var popupOptions = {
                    'maxWidth': '270',
                    'className': 'leaflet-infoBox'
                }


                marker = new L.marker([locations[i][1], locations[i][2]], {
                    icon: listeoIcon,
                }).bindPopup(locations[i][0], popupOptions);


                map.on('popupopen', function (e) {
                    L.DomUtil.addClass(e.popup._source._icon, 'clicked');
                }).on('popupclose', function (e) {
                    if (e.popup) {
                        L.DomUtil.removeClass(e.popup._source._icon, 'clicked');
                    }
                });

                markers.addLayer(marker);

            }
            map.addLayer(markers);

            markerArray.push(markers);

            if (markerArray.length > 0) {
                map.fitBounds(L.featureGroup(markerArray).getBounds());
                navigator.geolocation.getCurrentPosition(position => {
                    const latlngs = [
                        [position.coords.latitude, position.coords.longitude],
                        [position.coords.latitude, position.coords.longitude]

                    ];
                    var polyline = L.polyline(latlngs, { color: '#e8e0d9' }).addTo(map);
                    map.fitBounds(polyline.getBounds(), false, { padding: 20 });

                })
            }
            map.removeControl(map.zoomControl);
            var zoomOptions = {
                zoomInText: '<i class="fa fa-plus" aria-hidden="true"></i>',
                zoomOutText: '<i class="fa fa-minus" aria-hidden="true"></i>',
            };
            var zoom = L.control.zoom(zoomOptions);
            zoom.addTo(map);
        }, locationData(locationURL, locationImg, locationTitle, locationAddress, locationRating, locationRatingCounter) {
            return ('' +
            '<a href="' + locationURL + '" class="leaflet-listing-img-container">' +
            '<div class="infoBox-close"><i class="fa fa-times"></i></div>' +
            '<img src="' + locationImg + '" alt="">' +
            '<div class="leaflet-listing-item-content">' +
            '<h3>' + locationTitle + '</h3>' +
            '<span>' + locationAddress + '</span>' +
            '</div>' +
            '</a>' +
            '<div class="leaflet-listing-content">' +
            '<div class="leaflet-listing-title">' +
            '</div>' +
            '</div>')
        }, productsHTML(data) {
            let html = []
            for (let i = 0; i < data.length; i++) {
                    
                full = Math.round(data[i].qualification)
                empty = 5- full;
                html[i] = `   
                            <div class="col-lg-4 col-md-6">
                                <a href="/resultados/${data[i].slug}/${data[i].id}" class="listing-item-container">
                                    <div class="listing-item">
                                        <img src="images/${data[i].image}" alt="">`;

                //data[i].state == "1" ? html[i] += `<div class="listing-badge now-open">Now Open</div>`:html[i] +=  `<div class="listing-badge now-closed">Now Closed</div>`;

                html[i] +=                     `<div class="listing-item-content">
                                            <span class="tag">${data[i].business}</span> 
                                            <h3>${data[i].company} <i class="verified-icon"></i></h3>
                                           <!-- <span>${data[i].company}</span>-->
                                        </div>`;

                data[i].liked == "1" ? html[i] += `<span class="like-icon liked" data-id="${data[i].id}"></span>`: html[i] += `<span class="like-icon" data-id="${data[i].id}"></span>`;
                
                html[i]+=   `</div>
                                    <div class="star-rating" data-rating="${data[i].qualification}">
                                        <div class="rating-counter">(${data[i].opinions} críticas)</div>`;
                for(let j = 0; j < full; j++){html[i]+= `<span class="star"></span>`;}
                for(let j = 0; j < empty; j++){html[i]+= `<span class="star empty"></span>`;}
                html[i]+= `</div></a></div>`;
                }
                return html;
        } 
    } 
    $('#department').change(async function () { 
        $('#map .leaflet-control-container .leaflet-top').empty()
        paginator.getUsers();
    })
    $('#province').change(async function () { 
        $('#map .leaflet-control-container .leaflet-top').empty()
        paginator.getUsers();
    })
    $('#district').change(async function () { 
        $('#map .leaflet-control-container .leaflet-top').empty() 
        paginator.getUsers();
    })
    $('#business').change(async function () {
        $('#map .leaflet-control-container .leaflet-top').empty();
        paginator.getUsers();
    })


</script>
@endsection