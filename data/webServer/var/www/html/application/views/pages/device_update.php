<form class=' card-success vstack gap-2 mx-auto h-100 bg-dark text-light p-5' method='post' action='<?= base_url('Device/update'); ?>' >
	<div class='mb-4 row'>
		<div class='mb-2 col-md-6'>
			<b><label class='form-label'>Nome</label></b>
			<input type='text' name='name' class='form-control' value='<?= $device->name ?>'  >
		</div>

		<div class='mb-2 col-md-6'>
			<b><label class='form-label'>Código de identificação</label></b>
			<input type='text' name='mac_address' class='form-control' value='<?= $device->mac_address ?>'  >
		</div>		

	</div>

	<hr>

	<b><label class='form-label'>Posição do dispositivo</label></b>
	<div class="map" id="mapid"></div>
	<div class="d-flex">
		<input id='pinMapLat' type='text' name='lat' class='form-control me-2 d-none' placeholder='Latitude' value='<?= $device->lat ?>'  readonly='readonly' >
		<input id='pinMapLng' type='text' name='lng' class='form-control ms-2 d-none' placeholder='Longitude' value='<?= $device->lng ?>'  readonly='readonly' >
	</div>

	<hr>
	<div class='mb-4'>		
		<div class='mb-5'>
			<b><label class='form-label'>Descrição do dispositivo</label></b>
			<textarea  type='textarea' name='description' class='form-control' style='height: 175px;'  maxlength='200' id='textarea'><?= $device->description ?></textarea>
			<div class='btn-group right w-100' role='group' id='count'>
				<span class="right" id='current'>0</span><span id='maximum'> / 200</span>
			</div>
		</div>
	</div>

	<hr>

	<div class='btn-group btn-group-sm right' role='group'>
		<button type='submit' class='btn btn-success' name='id_device' value='<?= $device->id ?>'>Salvar</button>
		<a class='btn btn-success' name='id_group' href='<?= base_url('Dashboard'); ?>'>Inicio</a>
		<a class='btn btn-danger text-capitalize' href='<?= base_url('Device/delete/'.$device->id); ?>'>deletar</a>
	</div>
</form>

<script type="text/javascript">
	$(window).on("load", function(){
		$('#textarea42').keyup( function() {
				var characterCount = $(this).val().length,
				current = $('#current'),
				maximum = $('#maximum'),
				theCount = $('#count');
				current.text(characterCount);
			}
		);
		
		var my_map	= L.map('mapid').setView([ <?= $device->lat ?> , <?= $device->lng ?>], 12);
		var msg		= "Clique definir uma nova posição para dispositivo";
		var DeviceMarker;

		function buildMapOnSelfPosition(){
			L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
				maxZoom: 18,
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' + 'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				id: 'mapbox/streets-v11',
				tileSize: 512,
				zoomOffset: -1
			}).addTo(my_map);
		}

		function onLocationError(e) {
			alert(e.message);
		}

		function onMapClick(e) {
			document.getElementById("pinMapLat").value = e.latlng.lat;
			document.getElementById("pinMapLng").value = e.latlng.lng;
			DeviceMarker.setLatLng(e.latlng,{draggable:true}).bindPopup(e.latlng).update();
		}

		buildMapOnSelfPosition();

		document.getElementById("pinMapLat").value = <?= $device->lat ?>;
		document.getElementById("pinMapLng").value = <?= $device->lng ?>;
		DeviceMarker = L.marker([ <?= $device->lat ?> , <?= $device->lng ?>], {title: "Posição do grupo", alt: "pin da posição do grupo", draggable: true}).addTo(my_map).bindPopup(msg).openPopup();

		my_map.on('click', onMapClick);
		my_map.on('locationfound', onLocationFound);
		my_map.on('locationerror', onLocationError);
	});
</script>





