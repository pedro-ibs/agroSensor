

<div class=" card card-dark card-header-cark-blue">
	<div class='card-header card-header-cark-blue p-3 mb-3'>
		
		<div class='card-header card-header-cark-blue mb-3 row'>
			<div class='col-md-6'>
				<h5 class='capitalize'><b><i><?= $device->name ?></i></b> - <?= $device->mac_address ?> </h5>
			</div>

			<div class='col-md-6 d-flex col-md-6'>
				<h5 class=' right capitalize'><b><i><spam id='<?= $device->mac_address ?>status' ><spam></i></b></h5>
			</div>

			<div class='row'>
				<p><?= $device->description ?></p> 
			</div>
		</div>

		<div class='row mb-3' >
			
			<div class='col-md-4 d-flex mb-auto mt-auto'>
				<div class='d-flex me-2'>
					<div class='mb-auto mt-auto me-1'><label><b><i>Inicio:</i></b></label></div>
					<input class='border rounded-3 left' type="date" id="date" name="date">
				</div>

				<div class='d-flex'>
					<div class='mb-auto mt-auto me-1'><label><b><i>Final:</i></b></label></div>
					<input class='border rounded-3 left' type="date" id="date_end" name="date_end">
				</div>
			</div>
			
			<div class='col-md-3 btn-group btn-group-sm'>
				<a class='btn btn-success ms-1' onclick='update_values();' href='#mapid' >Aplicar</a>
				<a class='btn btn-dark' onclick='dowland_values();' id='download'>Baixar:</a>
				
				<select class='btn btn-dark' name="topicSelected" id='topicSelected'>
					<option value="temperature" selected>temperature</option>
					<option value="humidity">humidity</option>
					<option value="vcc">vcc</option>
					<option value="vbat">vbat</option>
				</select>
			</div>

			<div class='col-md-5 text-end mb-auto mt-auto'>
				<p class='mb-auto mt-auto'><b><i>Ultima medida:<i/></b> <span id='<?= $device->mac_address ?>last_measures'></span></p>
			</div>
		</div>

		<div class='map-small rounded-3' id='mapid'></div>

	</div>

	<?= $htmlChart ?>

	<!-- <div class='m-3 mt-3'>
		<table class="table table-striped table-border-less table-hover">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Timestamp</th>
					<th scope="col">Topic</th>
					<th scope="col">Payload</th>
				</tr>
			</thead>
			<tbody>
				<?= $tbody ?>
			</tbody>
		</table>
	</div> -->

</div>



<script type="text/javascript" >
	function update_<?= $device->mac_address ?>_info(){
		var labels = ['last_measures', 'status', 'vcc', 'vbat'];
		updateDeviceInfo('<?= $device->mac_address ?>', labels, '<?= base_url('Measures/device'); ?>');
	}

	dateUpdate();
	update_<?= $device->mac_address ?>_info();

	setInterval(update_<?= $device->mac_address ?>_info(), 10000);


	<?= $jsChart ?>

	function update_values() { 
		update_<?= $device->mac_address ?>_info();

		update_vcc<?= $device->id ?>Chart();
		update_vbat<?= $device->id ?>Chart();
		update_temperature<?= $device->id ?>Chart();
		update_humidity<?= $device->id ?>Chart();
	}

	function dowland_values() {
		var topic = $('#topicSelected').val();
		downloadDataset(<?= $device->id ?>, topic, '<?= base_url('Measures/'); ?>');
	}



</script>