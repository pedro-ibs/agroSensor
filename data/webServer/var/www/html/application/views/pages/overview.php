<div class='container block-mt150px'>
	<div class='card card-dark card-header-cark-blue p-3'>
		<div class='card-header card-header-cark-blue pb-5'>
			<div class='card-header card-header-cark-blue'>
				<form class='justify-content-end w-100 p-auto d-flex pb-2 btn-group' method='post' action='<?= base_url('Dashboard'); ?>' >
					<input class='form-control' name='findOverview' type='search' placeholder='Procurar por dispositivos' aria-label='Search' value='<?=$findOverview?>'>
					<button class='btn btn-secondary' type='submit'>Procurar</button>
					<a class='btn btn-success' href='<?= base_url('Dashboard'); ?>'>Limpar</a>
				</form>
			</div>
		</div>
		<div class='map rounded-3' id='mapid'></div>
	
		<div class='t-scroll'>
			<table class='table table-striped table-border-less table-hover mt-5'>
				<thead>
					<tr>
						<th scope='col'>#</th>
						<th scope='col'>Nome</th>
						<th scope='col'>Código</th>
						<th scope='col'>Ultima medida</th>
						<th scope="col">Status</th>
						<th scope='col'>Alimentação</th>
						<th scope='col'>Bateria</th>
						<th scope='col'></th>
	
					</tr>
				</thead>
				<tbody>
					<?= $tbody ?>
				</tbody>
			</table>
		</div>
	
	</div>
</div>


