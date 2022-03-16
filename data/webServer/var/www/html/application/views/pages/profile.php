<div class='page-group-main'>
	<div class='page-group-head-danger pb-5'> 
		<div class='card-header'>
			<div class='justify-content-end w-100 p-auto d-flex pb-2'>
				<h5 class='card-title'>Usuários </h5>
				<a class='btn btn-success col-md-1 right' href='<?= base_url('Profile/create') ?>'>Novo</a>
			</div>

			<form class='justify-content-end w-100 p-auto d-flex pb-2 btn-group ' method='post' action='<?= base_url('Profile'); ?>' >
				<input class='form-control' name='findUser' value='<?=$findUser?>' type='search' placeholder='Procurar dispositivos' aria-label='Search'>				
				<button class='btn btn-secondary btn-small' type='submit'>Procurar</button>
				<a class='btn btn-success btn-small' href='<?= base_url('Profile'); ?>'>Limpar</a>
			</form>
		</div>
	</div>
	
	<?php if(isset($profile)) print($profile); ?>
	
	<div class='page-group-footer-danger w-auto h-auto p-5 card-header'>
		<div class='justify-content-end w-100 p-auto d-flex pb-2'>
			<a class='btn btn-success col-md-1 right' href='<?= base_url('Profile'); ?>'>Limpar</a>
		</div>			
	</div>
</div>






