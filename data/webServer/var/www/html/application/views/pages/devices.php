<div class='page-group-main'>
	<div class='page-group-head-success pb-5'> 
		<div class='card-header'>
			<div class='justify-content-end w-100 p-auto d-flex pb-2'>
				<h5 class='card-title'>Dispositivos </h5>

				<?php
					if($this->login->isMaster()){
						echo "<a class='btn btn-success col-md-1 right' href='".base_url('Device/create')."'>Novo</a>";
					} else {
						echo "<div class='right'></div>";

					}
				?>

				
			</div>

			<form class='justify-content-end w-100 p-auto d-flex pb-2 btn-group ' method='post' action='<?= base_url('Device'); ?>' >
				<input class='form-control' name='findDevices' value='<?=$findDevices?>' type='search' placeholder='Procurar dispositivos' aria-label='Search'>				
				<button class='btn btn-secondary btn-small' type='submit'>Procurar</button>
				<a class='btn btn-success btn-small' href='<?= base_url('Device'); ?>'>Limpar</a>
			</form>
		</div>
	</div>
	
	<?php if(isset($devices)) print($devices); ?>
	
	<div class='page-group-footer-success w-auto h-auto p-5 card-header'>
		<div class='justify-content-end w-100 p-auto d-flex pb-2'>
			<a class='btn btn-success col-md-1 right' href='<?= base_url('Device'); ?>'>Limpar</a>
		</div>			
	</div>
</div>






