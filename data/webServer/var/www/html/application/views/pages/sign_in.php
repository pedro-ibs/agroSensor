


<form id="ajax" class='card-danger vstack gap-2 mx-auto h-100 bg-dark text-light p-5' method='post' action='<?= base_url("Profile/sign_in"); ?>' >
	<div class='mb-3'>
		<b><label class='form-label'>Usuário</label></b>
		<input type='nickname' name='nickname' class='form-control' aria-describedby='emailHelp'>
	</div>
	
	<div class='mb-3'>
		<b><label class='form-label'>Senha</label></b>
		<input type='password' name='password' class='form-control'>
		<div id='passwordHelp' class='form-text'>Nunca compartilhe sua senha com outras pessoas.</div>
	</div> 

	<hr>
	
	<button type='submit' class='w-50 m-auto btn btn-success'>Entrar</button>
</form>