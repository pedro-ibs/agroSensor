<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Device extends CI_Controller {

	function __construct(){
		parent:: __construct();
		
		$this->user = $this->session->userdata("user_logged");
		
		$this->login->isDontLogged();

		$this->load->model("Device_model", "m_device");
		$this->load->library("BuildCardDevice");
		$this->load->library("BuildMenu");
		$this->data		= array();
		$this->data['menu']	=  $this->buildmenu->getHtml();
	}
	
	public function index(){
		$findDevices = $this->input->post("findDevices");
		$devices = $this->m_device->takeMine();
		$devices = findWordOnObjectArray( $devices , $findDevices);

		$this->buildcarddevice->build($devices);


		$this->data['devices']		= $this->buildcarddevice->getHtml();
		$this->data['findDevices']	= $findDevices;
		$this->data['path']		= "Gerenciar Dispositivos";
		$this->data['js']		= $this->buildcarddevice->getJs();;
		$this->data['header']		= $this->load->view("common/header", $this->data, true);
		$this->data['navbar']		= $this->load->view("common/navbar", $this->data, true);
		$this->data['header']		= $this->load->view("common/header", $this->data, true);
		$this->data['navbar']		= $this->load->view("common/navbar", $this->data, true);
		$this->data['content']		= $this->load->view("pages/devices", $this->data, true);
		$this->data['footer']		= $this->load->view("common/footer", $this->data, true);
		
		$this->load->view("page", $this->data);	
	}

	public function create(){

		$this->login->isForbidden();

		if( $this->m_device->create( (Object)$this->input->post() ) ){
			redirect('Device', 'refresh');
		}

		$this->data['path']	= "Criar Dispositivo";
		$this->data['js']	= "";
		$this->data['header']	= $this->load->view("common/header", $this->data, true);
		$this->data['navbar']	= $this->load->view("common/navbar", $this->data, true);
		$this->data['header']	= $this->load->view("common/header", $this->data, true);
		$this->data['navbar']	= $this->load->view("common/navbar", $this->data, true);
		$this->data['content']	= $this->load->view("pages/device_create", $this->data, true);
		$this->data['footer']	= $this->load->view("common/footer", $this->data, true);

		$this->load->view("page", $this->data);			

	}
	
	public function update() {

		$this->login->isForbidden();

		$data = (Object)$this->input->post();

		if(!isset($data->id_device)){
			redirect('Device', 'refresh');
		}
		
		$data->id = $data->id_device;

		if ( $this->m_device->update($data) ){
			redirect('Device', 'refresh');
		}

		$this->data['device'] 	=  $this->m_device->getAt($data->id);
		$this->data['path']	= "Atualizar Dispositivo";
		$this->data['js']	= "";
		$this->data['header']	= $this->load->view("common/header", $this->data, true);
		$this->data['navbar']	= $this->load->view("common/navbar", $this->data, true);
		$this->data['content']	= $this->load->view("pages/device_update", $this->data, true);
		$this->data['footer']	= $this->load->view("common/footer", $this->data, true);
	
		$this->load->view("page", $this->data);
	}

	public function delete($id=0){ 

		$this->login->isForbidden();

		if ( $this->m_device->delete($id) ){
			$this->session->set_userdata("msg_success", "Dispositivo deletado" );
			redirect('Device', 'refresh');
		}

		$this->session->set_userdata("msg_error", "Esse dispositivo não exite" );
		redirect('Device', 'refresh');
	}

}
