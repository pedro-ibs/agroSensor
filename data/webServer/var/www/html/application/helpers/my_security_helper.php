<?php



function isWordForbidden( $query_words) {
	$words_forbidden=  array(
		"select",
		"delete",
		"update",
		"insert",
		"alter",
		"join",
		"order",
		"group",
		"function",
		"--",
		"continue",
		"break",
		"case",
		"into",
		"having",
		"from",
		"kill",
		"like",
		"ignore",
		"primary",
		"read",
		"rename",
		"replace",
		"return",
		"references",
		"regexp",
		"schema",
		"set",
		"sql",
		"table",
		"then",
		"unlock",
		"while",
		"where",
		"when",
		"values",
		"varchar",
		">",
		"<",
		"script",
	);
	
	foreach($words_forbidden as $elem) {
		$pattern = '/' . $elem . '/';

		if(preg_match($pattern, strtolower($query_words)) > 0){
			return true;
		}
	}
	
	return false;
}


function isDataForbidden($data) {
	foreach($data as $elem) {
		if(isWordForbidden($elem) == true){;
			return true;
		}
	}
	return false;
}

function getMsgWordsForbidden(){
	return "Palavra utilizada é proibida!";
}

function getMsgQueryFailure(){
	return "Falha ao atualizar dados tente novamente mais tarde!";
}

function getMsgQuerySuccess(){
	return "Dados atualizados com sucesso.";
}


function isForbidden($data){
	$rec = false;
	if(is_array($data)){
		$rec = isDataForbidden($data);
	} else {
		$rec = isWordForbidden($data);
	}

	if($rec){
		// $ci =& get_instance();
		// $ci->session->set_userdata("msg_error", $this->getMsgWordsForbidden() );
		redirect(base_url(), 'refresh');
	}

	return $rec;
} 