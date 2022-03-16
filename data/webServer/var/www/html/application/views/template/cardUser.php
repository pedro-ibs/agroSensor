<div class="group-list page-group-body-danger">
	<div class="card-header">
		<div class="card-title fs-6 text text-capitalize" ><b><?= $id ?> </b><?= $first_name." ".$last_name ?></div>
	</div>
	<div class="card-body">
		<div class='t-scroll'>
			<div class='text fs-6'>
				<table class="table table-borderless mb-2 text-center fs-6">
					<thead>
						<tr>
							<th scope="col">Código</th>
							<th scope="col">Apelido</th>
							<th scope="col">Tipo</th>
							<th></th>
	
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row"><i><?=$id?></i></th>
							<td><i><?= $nickname ?></i></td>
							<td><i><?= $type ?></i></td>
							<td class='btn-group-sm'><a class='btn btn-danger btn-small' href='<?= base_url('Profile/delete/'.$id); ?>'>Deletar</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>