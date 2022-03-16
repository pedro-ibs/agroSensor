<nav class='navbar navbar-dark bg-dark fixed-top'>
	<div class='container-fluid'>

		<div class='navbar-brand' href='#' id='navbarSupportedContent'>
			<div class='nav-item dropdown '>
				<a class='nav-link dropdown-toggle text-light navbarDropdown_button' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
					<b><?php $user = $this->session->userdata("user_logged"); print($user->first_name." "); ?></b> / <i><?= $path ?></i>
				</a>
				<div class='dropdown-menu navbarDropdown_list'>
					<div><a class='dropdown-item' href='<?= base_url('Dashboard') ?>'>Overview</a></div>
					<div><a class='dropdown-item' href='<?= base_url('Profile/update') ?>'>Atualizar conta</a></div>

					<?php
						if($this->login->isMaster()){
							echo "<div><a class='dropdown-item' href='".base_url('Profile')."'> Gerenciar usuários</a></div>";
						}
					?>

					<div><a class='dropdown-item' href='<?= base_url('Device') ?>'>Gerenciar Dispositivos</a></div>
					<div><hr class='dropdown-divider'></div>
					<div><a class='dropdown-item' href='<?= base_url('Profile/sign_out') ?>'>Sair</a></div>
				</div>
			</div>

		</div>
		
		<button class='navbar-toggler' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasNavbar' aria-controls='offcanvasNavbar'>
			<span class='navbar-toggler-icon'></span>
		</button>		
	
		<div class='offcanvas offcanvas-end bg-dark green-800' tabindex='-1' id='offcanvasNavbar' aria-labelledby='offcanvasNavbarLabel'>
			<div class='offcanvas-header'>
				<h5 class='offcanvas-title text-light' id='offcanvasNavbarLabel'>Painel</h5>
				<button type='button' class='btn-close btn-outline-danger border border-danger' data-bs-dismiss='offcanvas' aria-label='Close'></button>
			</div>

			<div class='offcanvas-body'>
				<ul class='navbar-nav justify-content-end flex-grow-1 pe-3'>
					
					<li class='nav-item'>
						<b><a class='nav-link active btn my-btn-success' href='<?= base_url('Dashboard') ?>'>Overview</a></b>
					</li>

					<li class='nav-item mt-5'>
						<h5 class='offcanvas-title text-light' id='offcanvasNavbarLabel'>Status</h5>
					</li>


					<li class='nav-item mt-2'>
						<a class='nav-link btn my-btn-secondary' href='<?= base_url('Dashboard/status/0') ?>'>Desconhecidos</a>
					</li>

					<li class='nav-item mt-2'>
						<a class='nav-link btn my-btn-success' href='<?= base_url('Dashboard/status/1') ?>'>Conectados</a>
					</li>

					<li class='nav-item  mt-2'>
						<a class='nav-link btn my-btn-danger' href='<?= base_url('Dashboard/status/2') ?>'>Desconectados</a>
					</li>

					<li class='nav-item  mt-2'>
						<a class='nav-link btn my-btn-warning text-dark' href='<?= base_url('Dashboard/status/3') ?>'>Alimentação Baixa</a>
					</li>

					<li class='nav-item mt-5'>
						<h5 class='offcanvas-title text-light' id='offcanvasNavbarLabel'>Dispositivos</h5>
					</li>

					<div class="nav-item">
					
						<?= $menu ?>
					</div>


				</ul>

			</div>
		</div>
	</div>
</nav>
