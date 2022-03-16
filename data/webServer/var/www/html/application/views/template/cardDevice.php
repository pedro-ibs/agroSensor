<div class="group-list page-group-body-success">
	<div class="card-header">
		<div class="card-title fs-6 text text-capitalize" ><b><?= $id_fake ?> </b><?= $name ?></div>
	</div>
	<div class="card-body">
		<p class="fs-7 text card-text text-justify"> <?=  $description ?> </p>
		<hr>
		<div class='t-scroll'>			
			<div class='text fs-6'>
				<table class="table table-borderless mb-2 text-center fs-6">
					<thead>
						<tr>
							<th scope="col">Código</th>
							<th scope="col">Status</th>
							<th scope="col">Alimentação de entrada</th>
							<th scope="col">Alimentação da bateria</th>
							<th scope="col">Ultima medida</th>
							<th scope="col">Latitude</th>
							<th scope="col">Longitude</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row"><i><?=$mac_address?></i></th>
							<td><i><spam id='<?=$mac_address?>status'></spam ></i></td>
							<td><i><spam id='<?=$mac_address?>vcc'></spam ></i></td>
							<td><i><spam id='<?=$mac_address?>vbat'></spam ></i></td>
							<td><i><spam id='<?=$mac_address?>last_measures'></spam ></i></td>
							<td><i><i><?=$lat?></i></td>
							<td><i><?=$lng?></i></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class='justify-content-end w-100 p-auto d-flex'>
			<form class='btn-group btn-group-sm' method='post' action='<?= base_url('Device/update'); ?>' >
				<a class='btn btn-secondary btn-small' href='<?= base_url('Dashboard/device/'.$id); ?>'>Ver</a>

				<?php
					if($this->login->isMaster()){
						echo "<button class='btn btn-success btn-small ' value='".$id."' name='id_device' type='submit'>Editar</button>";
					}
				?>
			</form>
		</div>
	</div>
</div>