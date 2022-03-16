<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Measures extends CI_Controller {

	function __construct(){
		parent:: __construct();
		
		$this->user = $this->session->userdata("user_logged");
		
		if(isset($this->user->logged) == false){
			redirect('Profile/sign_in', 'refresh');
		}
		
		if($this->user->logged == false){
			redirect('Profile/sign_in', 'refresh');
		}

		$this->load->model("Device_model", "m_device");
	}
	
	public function index () {
		$data = (Object)$this->input->post();
		
		if( (isset($data->id) && isset($data->date) && isset($data->date_end) && isset($data->topic)) == false ){
			echo json_encode( null );
			return;
		}

		if( isDataForbidden($data)  ) {
			echo json_encode( null );
			return;
		}
		
		$measure = $this->m_measure->getAfterAt($data->id, $data->topic, $data->date,  $data->date_end);
		if( !$measure ){
			echo json_encode( null );
			return;
		}

		echo json_encode( $measure);
	}


	public function device(){
		$data = (Object)$this->input->post();
		
		if( isset($data->mac_address) == false ){
			echo json_encode( '0' );
			return;
		}

		if( isDataForbidden($data) == true ) {
			echo json_encode( '1' );
			return;
		}

		$device = $this->m_device->getFromMac($data->mac_address);

		if( !$device ){
			echo json_encode( '2' );
			return;
		}
		echo json_encode( $device );
	}
}
