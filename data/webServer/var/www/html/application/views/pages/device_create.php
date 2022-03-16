
<form class=' card-success vstack gap-2 mx-auto h-100 bg-dark text-light p-5' method='post' action='<?= base_url('Device/create'); ?>' >
	<div class='mb-4 row'>
		<div class='mb-2 col-md-6'>
			<b><label class='form-label'>Nome</label></b>
			<input type='text' name='name' class='form-control' placeholder='nome do dispositivo'  >
		</div>

		<div class='mb-2 col-md-6'>
			<b><label class='form-label'>Código de identificação</label></b>
			<input type='text' name='mac_address' class='form-control' placeholder='Código único que identifica o dispositivo'  >
		</div>

	</div>

	<b><label class='form-label'>Posição do dispositivo</label></b>
	<div class="map" id="mapid"></div>
	<div class="d-flex">
		<input id='pinMapLat' type='text' name='lat' class='form-control me-2 d-none' placeholder='Latitude' value='0'  readonly='readonly' >
		<input id='pinMapLng' type='text' name='lng' class='form-control ms-2 d-none' placeholder='Longitude' value='0'  readonly='readonly' >
	</div>

	<hr>

	<div class='mb-4'>		
		<div class='mb-5'>
			<b><label class='form-label'>Descrição do dispositivo</label></b>
			<textarea  id='textarea42' type='textarea' name='description' class='form-control' style='height: 175px;'  maxlength='200' id='textarea' placeholder='Descrição'></textarea>
			<div class='btn-group right w-100' role='group' id='count'>
				<span class="right" id='current'>0</span><span id='maximum'> / 200</span>
			</div>
		</div>
	</div>

	<hr>

	<div class='btn-group btn-group-sm right' role='group'>
		<button type='submit' class='btn btn-success'>Criar</button>
		<a class='btn btn-success' name='id_group' href='<?= base_url('Dashboard'); ?>'>Inicio</a>
	</div>			
</form>

<script type="text/javascript">
	

	
	$('#textarea42').keyup( function() {
			var characterCount = $(this).val().length,
			current = $('#current'),
			maximum = $('#maximum'),
			theCount = $('#count');
			current.text(characterCount);
		}
	);
	
	var my_map	= L.map('mapid').fitWorld();
	var msg		= "<b>você está aqui?</b>\n Clique no mapa ou arraste definir uma nova posição para o grupo de sensores";
	var DeviceMarker;

	function buildMapOnMyPosition(){
		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
			maxZoom: 30,
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' + 'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			id: 'mapbox/streets-v11',
			tileSize: 512,
			zoomOffset: -1
		}).addTo(my_map);		
	}

	function onLocationFound(e) {
		document.getElementById("pinMapLat").value = e.latlng.lat;
		document.getElementById("pinMapLng").value = e.latlng.lng;
		L.circle(e.latlng, e.accuracy).addTo(my_map);
		DeviceMarker = L.marker(e.latlng, {title: "Posição do grupo", alt: "pin da posição do grupo", draggable: true}).addTo(my_map).bindPopup(msg).openPopup();		
	}

	function onLocationError(e) {
		alert(e.message);
		my_map.setView([0, 0], 5);
		DeviceMarker = L.marker([0, 0], {title: "Posição do grupo", alt: "pin da posição do grupo", draggable: true}).addTo(my_map).bindPopup(msg).openPopup();
	}


	function onMapClick(e) {
		document.getElementById("pinMapLat").value = e.latlng.lat;
		document.getElementById("pinMapLng").value = e.latlng.lng;
		DeviceMarker.setLatLng(e.latlng,{draggable:true}).bindPopup(e.latlng).update();
	}


	buildMapOnMyPosition();
	
	my_map.on('click', onMapClick);
	my_map.on('locationfound', onLocationFound);
	my_map.on('locationerror', onLocationError);
	my_map.locate({setView: true, maxZoom: 15});


</script>



