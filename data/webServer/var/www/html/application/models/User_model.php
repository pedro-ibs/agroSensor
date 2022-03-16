<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->logged = $this->session->userdata("user_logged");
	}

	private $sessionData = array(
		"logged"	=> false,
		"user_id"	=> 0,
		"first_name"	=> "",
		"type"		=> "",
	);

	public function getSelf(){
		$query = $this->db->get_where("user", "id = ".$this->logged->user_id)->row();
		return $query;
	}

	public function getAt( $id ){
		if( isForbidden($id) ) return;
		return  $this->db->get_where("user", "id = ".$id)->row();
	}

	public function getAll(){
		return  $this->db->get_where("user", "id > 1")->result();
	}

	public function create( $data ){

		if( ( isset($data->nickname) && isset($data->password1) && isset($data->password2) && isset($data->first_name) && isset($data->last_name) )== false){
			return false;
		}

		if( (!$data->nickname) || (!$data->password1) || (!$data->password2) || (!$data->first_name) || (!$data->last_name) ){
			$this->session->set_userdata("msg_error", "Todos os campos devem ser preenchidos");
			return false;
		}

		if( isDataForbidden( $data ) == true ){
			$this->session->set_userdata("msg_error", getMsgWordsForbidden() );
			return false;
		}

		if($data->password1 !== $data->password2){
			$this->session->set_userdata("msg_error", "As senhas não são iguais " );
			return false;
		}

		$create = array(
			"id"		=> 0,
			"nickname"	=> $data->nickname,
			"first_name"	=> $data->first_name,
			"last_name"	=> $data->last_name,
			"password"	=> md5($data->password1),
		);
		
		$query = $this->db->insert('user', $create);
		$this->session->set_userdata( "msg_success", getMsgQuerySuccess() );
		return true;

	}

	public function update($data, $id){
		if( isForbidden($data) ) return null;
		if( isForbidden($id) ) return null;

		$this->db->update('user', $data, array('id' => $id));
		return  $this->getAt($id);
	}

	public function delete( $id){
		if( isForbidden($id) ) return;

		if($id <= 1) return;

		$query = $this->getAt($id);
		if(isset($query->id)){
			$this->db->delete('user', array("id" => $query->id));	
		}
	}

	public function updateSelf( $data ){

		if( ( isset($data->nickname) && isset($data->password1) && isset($data->password2) && isset($data->first_name) && isset($data->last_name) )== false){
			return false;
		}

		if( (!$data->nickname) || (!$data->password1) || (!$data->password2) || (!$data->first_name) || (!$data->last_name) ){
			$this->session->set_userdata("msg_error", "Todos os campos devem ser preenchidos");
			return false;
		}

		if( isDataForbidden( $data ) == true ){
			$this->session->set_userdata("msg_error", getMsgWordsForbidden() );
			return false;
		}

		if($data->password1 !== $data->password2){
			$this->session->set_userdata("msg_error", "As senhas não são iguais " );
			return false;
		}

		$update = array(
			"nickname"	=> $data->nickname,
			"first_name"	=> $data->first_name,
			"last_name"	=> $data->last_name,
			"password"	=> md5($data->password1),
		);

		$query = $this->update($update, $this->logged->user_id);

		if(!$query) {
			$this->session->set_userdata("msg_error", getMsgQueryFailure());
			return false;
		}

		$this->session->set_userdata( "msg_success", getMsgQuerySuccess() );
		return true;
	}

	public function authenticate( $data ) {
		$sessionData = (object)$this->sessionData;

		if( ( isset($data->nickname) == false ) || ( isset($data->password) ) == false){
			$sessionData->logged = false;
			return $this->sessionData;
		}
		
		if( isWordForbidden($data->nickname) || isWordForbidden( $data->password ) ) {
			$this->session->set_userdata("msg_error", getMsgWordsForbidden() );
			$sessionData->logged = false;
			return $sessionData;
		}

		$query = $this->db->get_where("user", "nickname = '".$data->nickname."' AND password = '".md5($data->password)."'")->row();

		if(!$query) {
			$this->session->set_userdata("msg_error", "nickname e/ou Senha estão incorreto." );
			$sessionData->logged = false;
			return $sessionData;
		}

		$sessionData->logged		= true;
		$sessionData->user_id		= $query->id;
		$sessionData->first_name	= $query->first_name;
		$sessionData->type		= $query->type;
		
		return $sessionData;
	}
}
