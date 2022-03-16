<!DOCTYPE html>
<html>
	<head>
		<?= $header ?>
	</head>
	
	<body>
		<?= $navbar ?>
		<section>
			<main class='container'>
				<div class='m-5 h-100 block-mb150px col-md-12 m-auto'>
					<div class='block-mt150px'>

					<?php
						showErrorMsg($this->session->userdata('msg_error')); 
						showSuccessMsg($this->session->userdata('msg_success'));

						$this->session->set_userdata("msg_success", "" );
						$this->session->set_userdata("msg_error", "" );

					?>

						<?= $content ?>
					</div>
				</div>
			</main>
		</section>
		
		<div class='block-mt130px'></div>

		<?= $footer ?>		
	</body>
</html>