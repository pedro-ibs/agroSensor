<?php



function showErrorMsg( $msg ){
	if($msg) print(
		"<div class='mb-5 p-3 w-100 error_msg' id='popup_message'>
			<div class='text-justify'>
				<h5>Falha na operação</h5>
				<p>".$msg."</p>
				<div class='justify-content-end w-100 p-auto d-flex'>
					<a class='btn btn-danger col-md-2 right' onclick='popup_message_close()'>Fechar</a>
				</div>
			</div>
		</div>"
	);
}



function showSuccessMsg( $msg ){
	if($msg) print(
		"<div class='mb-5 p-3 w-100 success_msg' id='popup_message'>
			<div class='text-justify'>
				<h5>Operação realizada com sucesso</h5>
				<p>".$msg."</p>
				<div class='justify-content-end w-100 p-auto d-flex'>
					<a class='btn btn-success col-md-2 right' onclick='popup_message_close()'>Fechar</a>
				</div>
			</div>
		</div>"
	);
}	