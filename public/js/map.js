

		mapboxgl.accessToken = 'pk.eyJ1Ijoiamhvbm1jIiwiYSI6ImNrOXUwdWg0aTFtMjIzZHBqbmJiejEyZWUifQ.E4jyfbchTPlMpfRBTrnyHw';
		var bounds = [
			[-71.15037206517002, -18.35882708416956], // Southwest coordinates
			[-69.47882051578074, -16.781660471111678] // Northeast coordinates
			];
		var longitud = document.getElementById('longitud').value;
		var latitud = document.getElementById('latitud').value;



		if(longitud == '' && latitud == ''){

			var longitud_s, latitud_s,ayuda;
			function inicio(){
			navigator.geolocation.getCurrentPosition(function(position){
				//console.log(position.coords.latitude, position.coords.longitude);
				var longitud_s = position.coords.longitude;
				var latitud_s= position.coords.latitude;
				// document.getElementById('longitud').value =longitud_s;

			});}
			window.onload = inicio;
			// console.log(document.getElementById('longitud').value);

			longitud = '-70.2714499782323';
			latitud = '-18.032241907512386';
			// Set bounds to New York, New York

			var map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v11',
			center: [longitud,latitud],
			zoom: 9,
			maxBounds: bounds // Sets bounds as max

			});
		}
		else{

			var map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v11',
			center: [longitud,latitud],
			zoom: 13,
			maxBounds: bounds // Sets bounds as max
			});

		}

		map.addControl(new MapboxGeocoder({
			accessToken: mapboxgl.accessToken
		}));

		map.addControl(new mapboxgl.NavigationControl());
		map.addControl(new mapboxgl.FullscreenControl());
		map.addControl(
			new mapboxgl.GeolocateControl({
			positionOptions: {
				enableHighAccuracy: true
			},
			trackUserLocation: true
			})

		);

		var marker = new mapboxgl.Marker({
			draggable: true
			})
		.setLngLat([longitud,latitud])
		.addTo(map);
		// ----------
		map.on('click', addMarker);

		function addMarker(e){
		  if (typeof marker !== "undefined" ){
				// map.removeLayer(marker);
		  }
			$('.mapboxgl-marker').remove();

								var marker = new mapboxgl.Marker({
									draggable: true
									})
								.setLngLat([e.lngLat.lng, e.lngLat.lat])
								.addTo(map);

								var lngLat = marker.getLngLat();
									$('#longitud').val(lngLat.lng);
									$('#latitud').val(lngLat.lat);

										//Introducir function de mapa inverso
										$.ajax({
												url: "https://api.mapbox.com/geocoding/v5/mapbox.places/"+lngLat.lng+","+lngLat.lat+".json?access_token=pk.eyJ1Ijoiamhvbm1jIiwiYSI6ImNrOXUwdWg0aTFtMjIzZHBqbmJiejEyZWUifQ.E4jyfbchTPlMpfRBTrnyHw",
												dataType: "json",
												type: "GET"
											}).done(function(data) {

													$('#region').val(data.features[1].text);
													$('#direccion').val(data.features[0].place_name);
											});
											
								function onDragEnd() {
								var lngLat = marker.getLngLat();
									$('#longitud').val(lngLat.lng);
									$('#latitud').val(lngLat.lat);

										//Introducir function de mapa inverso
										$.ajax({
												url: "https://api.mapbox.com/geocoding/v5/mapbox.places/"+lngLat.lng+","+lngLat.lat+".json?access_token=pk.eyJ1Ijoiamhvbm1jIiwiYSI6ImNrOXUwdWg0aTFtMjIzZHBqbmJiejEyZWUifQ.E4jyfbchTPlMpfRBTrnyHw",
												dataType: "json",
												type: "GET"
											}).done(function(data) {

													$('#region').val(data.features[1].text);
													$('#direccion').val(data.features[0].place_name);
											});
										//------------------------------------


								}
								marker.on('dragend', onDragEnd);
		}

		// ----
		function onDragEnd() {
		var lngLat = marker.getLngLat();
			$('#longitud').val(lngLat.lng);
			$('#latitud').val(lngLat.lat);

				//Introducir function de mapa inverso
				$.ajax({
						url: "https://api.mapbox.com/geocoding/v5/mapbox.places/"+lngLat.lng+","+lngLat.lat+".json?access_token=pk.eyJ1Ijoiamhvbm1jIiwiYSI6ImNrOXUwdWg0aTFtMjIzZHBqbmJiejEyZWUifQ.E4jyfbchTPlMpfRBTrnyHw",
						dataType: "json",
						type: "GET"
					}).done(function(data) {

							$('#region').val(data.features[1].text);
							$('#direccion').val(data.features[0].place_name);
					});
				//------------------------------------


		}
		marker.on('dragend', onDragEnd);


		$('#tab2a').on('submit','#edit-ubication',function(){
				 event.preventDefault();
				 Swal.fire({
					 title: '¡Actualizando datos!',
					 // html: 'Espere un momento',// add html attribute if you want or remove
					 allowOutsideClick: false,
					 allowEscapeKey : false,
					 onBeforeOpen: () => {
							 Swal.showLoading()
					 },
					 });

				 	var region = $('#region').val();
					if (region == 'Tacna' || region=='') {
						$.ajax({
						url: '/admin/profile/edit/ubication',
						method:"POST",
						data:new FormData(this),
						dataType:"json",
						processData: false,
						contentType: false,
						success:function(res)
						{
								Swal.fire({
									position: 'center',
									icon: 'success',
									title: '¡Datos actualizados exitosamente!',
									showConfirmButton: false,
									timer: 1500
								})
					 }
					});
					} else {
							Swal.fire('Solo se permite ubicaciones dentro de Tacna');
					}

		});
