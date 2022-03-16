<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *  @date Created at:	14/09/2021 01:24:54
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



class Device_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->logged = $this->session->userdata("user_logged");
		$this->load->model("Measure_model", "m_measure");
		$this->load->library("LineChart");
	}

	public function getAll(){
		$query = $this->db->get("sensor")->result();
		return $query;
	}
	
	public function getAt( $id ){
		if( isForbidden($id) ) return null;

		// $query = $this->db->get_where("sensor", "`id` = ".$id." AND id_user = ".$this->logged->user_id)->row();
		$query = $this->db->get_where("sensor", "`id` = ".$id)->row();
		return $query;
	}

	public function getFromMac( $mac_address ){
		if( isForbidden($mac_address) ) return null;

		// $query = $this->db->get_where("sensor", "`mac_address` = '".$mac_address."' AND `id_user` = ".$this->logged->user_id)->row();
		$query = $this->db->get_where("sensor", "`mac_address` = '".$mac_address."'")->row();
		return $query;
	}
	
	public function takeMine($status = -1){
		if( isForbidden($status) ) return null;
		if($status < 0){
			// $query = $this->db->get_where("sensor", "id_user = ".$this->logged->user_id)->result();
			return $this->getAll();
		}

		// $query = $this->db->get_where("sensor", "id_user = ".$this->logged->user_id." AND status = ".$status)->result();
		$query = $this->db->get_where("sensor","status = ".$status)->result();
		return $query;

	}

	public function delete( $id){
		if( isForbidden($id) ) return;

		$query = $this->getAt($id);

		if(!$query){
			return false;
		}

		$this->db->delete('measures', array("id_sensor" => $query->id));
		// $this->db->delete('sensor', array("id" => $query->id, "id_user" => $this->logged->user_id));
		$this->db->delete('sensor', array("id" => $query->id));
		return true;
	}

	public function update($data){


		if( ( isset($data->id) && isset($data->name) && isset($data->description) && isset($data->mac_address) && isset($data->lat) && isset($data->lng) ) == false ){
			return false;
		}

		
		if( isDataForbidden($data) ){
			$this->session->set_userdata("msg_error", getMsgWordsForbidden() );
			return false;
		}
		
		if( !$data->name || !$data->description || !$data->mac_address || !$data->lat || !$data->lng ){
			$this->session->set_userdata("msg_error", "Todos os campos devem ser preenchidos");
			return false;
		}	

		$data->mac_address = strtolower($data->mac_address);
		$data->mac_address = trim($data->mac_address);

		$update = (Object)array(
			// "id_user"	=> $this->logged->user_id,
			"name"		=> $data->name,
			"mac_address"	=> $data->mac_address,
			"description"	=> $data->description,
			"lat"		=> $data->lat,
			"lng"		=> $data->lng,
		);


		$query = $this->getAt($data->id);
		if($query->mac_address != $update->mac_address ){
			$query = $this->db->get_where("sensor", "mac_address = '".$data->mac_address."'")->result();
			if( $query ){
				$this->session->set_userdata("msg_error", "O código de identificação já exite");
				return false;
			}
		}

		$this->db->update('sensor', $update, array('id' => $data->id));
		$query = $this->getAt($data->id);

		if(!$query){
			$this->session->set_userdata("msg_error", getMsgQueryFailure() );
			return false;
		}

		$this->session->set_userdata("msg_success", getMsgQuerySuccess() );

		return true;
	}

	public function create( $data ){

		if( ( isset($data->name) && isset($data->description) && isset($data->mac_address) && isset($data->lat) && isset($data->lng) ) == false ){
			return false;
		}

		if( isDataForbidden($data) ){
			$this->session->set_userdata("msg_error", getMsgWordsForbidden());
			return false;
		}

		if( !$data->name || !$data->description || !$data->mac_address || !$data->lat || !$data->lng ){
			$this->session->set_userdata("msg_error", "Todos os campos devem ser preenchidos");
			return false;
		}

		$data->mac_address = trim($data->mac_address);
		$data->mac_address = strtolower($data->mac_address);

		$query = $this->db->get_where("sensor", "mac_address = '".$data->mac_address."'")->result();
		if( $query ){
			$this->session->set_userdata("msg_error", "O código de identificação já exite");
			return false;
		}

		$data = array(
			"id"		=> 0,
			// "id_user"	=> $this->logged->user_id,
			"name"		=> $data->name,
			"description"	=> $data->description,
			"mac_address"	=> $data->mac_address,
			"lat"		=> $data->lat,
			"lng"		=> $data->lng,
		);
		$this->db->insert('sensor', $data);
		$this->session->set_userdata("msg_success", getMsgQuerySuccess() );
		return true;
	}

}


