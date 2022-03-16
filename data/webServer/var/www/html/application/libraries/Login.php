<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * myLogin.php
 *
 *  @date Created at:	28/09/2021 11:37:21
 *	@author:	Pedro Igor B. S.
 *	@email:		pibscontato@gmail.com
 * 	GitHub:		https://github.com/pedro-ibs
 * 	tabSize:	8
 *
 * ########################################################
 * TODO: Licence
 * ########################################################
 *
 * TODO: documentation or resume or Abstract
 *
 */




class Login {
	function __construct(){

		$this->ci =& get_instance();

		$login = (object)$this->ci->session->userdata("user_logged");

		if(!isset($login->logged) || !isset($login->user_id) || !isset($login->first_name) || !isset($login->type) ){
			$login = array(
				"logged"	=> false,
				"user_id"	=> 0,
				"first_name"	=> "",
				"type"		=> "normal",
			);
			$this->ci->session->set_userdata("user_logged",  $login);
		}
	}

	public function isDontLogged(){
		$login = (object)$this->ci->session->userdata("user_logged");

		if( !isset($login->logged) ){
			redirect('Profile/sign_in', 'refresh');
		}
		
		if($login->logged == false){
			redirect('Profile/sign_in', 'refresh');
		}
	}

	public function isLogged(){
		$login = (object)$this->ci->session->userdata("user_logged");

		if( !isset($login->logged) ){
			redirect('Profile/sign_in', 'refresh');
		}

		if($login->logged == true){
			redirect('Dashboard', 'refresh');
		}
	}

	public function isMaster (){
		$login = (object)$this->ci->session->userdata("user_logged");

		if(!isset($login->type) ){
			return false;
		}

		if(strcmp($login->type, "master") != 0){
			return false;
		}

		return true;
	}


	public function isForbidden (){
		if($this->isMaster() == false ){

			redirect('Profile/sign_in', 'refresh');
		}
	}	
}
