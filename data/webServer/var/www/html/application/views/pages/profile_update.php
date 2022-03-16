<form ' class=' card-danger vstack gap-2 mx-auto h-100 bg-dark text-light p-5' method='post' action='<?= base_url("Profile/update"); ?>' >
	
	<div class="mb-3 row">
		<div class='mb-1 col-md-6'>
			<b><label class='form-label'>Primeiro Nome</label></b>
			<input type='text' name='first_name' class='form-control' required value='<?= $user->first_name ?>' >
		</div>

		<div class='mb-1 col-md-6'>
			<b><label class='form-label'>Ultimo nome</label></b>
			<input type='text' name='last_name' class='form-control' required value='<?= $user->last_name ?>' >
		</div>
	</div>
	
	<div class="mb-3">
		<div class='mb-5'>
			<b><label class='form-label'>Apelido</label></b>
			<input type='text' name='nickname' class='form-control' required value='<?= $user->nickname ?>' >
		</div>
	</div>

	<hr>

	<div class="mb-5 row ">
		<div class='mb-1 col-md-6'>
			<b><label class='form-label'>Senha</label></b>
			<input type='password' name='password1' class='form-control' required>
		</div>

		<div class='mb-1 col-md-6'>
			<b><label class='form-label'>Repetir senha</label></b>
			<input type='password' name='password2' class='form-control' required>
		</div>
	</div>		

	<hr>
	
	<div class="btn-group btn-group-sm right" role="group">
		<button type='submit'	class='btn btn-danger'>Salvar</button>
		<a type='button'	class='btn btn-danger' href='<?= base_url("Dashboard"); ?>'>Inicio</a>
	</div>
</form>
