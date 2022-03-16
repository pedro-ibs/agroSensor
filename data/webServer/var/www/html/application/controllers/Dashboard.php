<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent:: __construct();
		
		$this->user = $this->session->userdata("user_logged");
		
		$this->login->isDontLogged();

		$this->load->model("Device_model", "m_device");
		$this->load->model("Measure_model", "m_measure");

		$this->load->library("BuildTableDevice");
		$this->load->library("BuildMarkerMap");
		$this->load->library("BuildMenu");
		$this->load->library("LineChart");
		$this->load->library("BuildTableMeasure");
		$this->data		= array();
		$this->data['menu']	=  $this->buildmenu->getHtml();
	}
	
	private function overview ($device){

		$this->data['map'] = $mapSet = (Object) array (
			"zoom"	=> '2',
			"lat"	=> '0',
			"lng"	=> '0',
		);

		$js = $this->load->view("template/map", $this->data, true);
		$js = $js.$this->buildmarkermap->getJs( $device );

		
		$this->buildtabledevice->build($device);		
		$js = $js.$this->buildtabledevice->getJs();

		$this->data['tbody']		= $this->buildtabledevice->getHtml();
		$this->data['path']		= "Overview";
		$this->data['js']		= $js;
		$this->data['header']		= $this->load->view("common/header", $this->data, true);
		$this->data['navbar']		= $this->load->view("common/navbar", $this->data, true);
		$this->data['content']		= $this->load->view("pages/overview", $this->data, true);
		$this->data['footer']		= $this->load->view("common/footer", $this->data, true);
		$this->load->view("page", $this->data);
	}

	public function status($status=0){
		if(($status < 0) || ($status > 3) ){
			redirect('Dashboard', 'refresh');
		}

		$findOverview = $this->input->post("findOverview");
		$this->data['findOverview'] = $findOverview;
		$device = $this->m_device->takeMine($status);
		$device = findWordOnObjectArray( $device , $findOverview);
		$this->overview($device);
	}


	public function index(){
		$findOverview = $this->input->post("findOverview");
		$this->data['findOverview'] = $findOverview;
		$device = $this->m_device->takeMine();
		$device = findWordOnObjectArray( $device , $findOverview);
		$this->overview($device);
	}

	public function device($id=0){
		if($id <= 0){
			redirect('Dashboard', 'refresh');
		}

		$device = $this->m_device->getAt($id);

		if(!$device){
			redirect('Dashboard', 'refresh');
		}

		$topics = array('temperature', 'humidity', 'vcc', 'vbat');


		$htmlChart = "<div class='row m-2'>";
		$jsChart = "";
		foreach ($topics as $topic) {
			$htmlChart = $htmlChart."<div class='col-md-6'>".$this->linechart->getNewHtml($device->id, $topic)."</div>";
			$jsChart = $jsChart.$this->linechart->getNewJs($device->id, $topic);
		}
		$htmlChart = $htmlChart."</div>";

		$measures = $this->m_measure->getLast($device->id, 10);
		$measures = $this->buildtablemeasure->getHtml($measures);



		$this->data['map'] = $mapSet = (Object) array (
			"zoom"	=> '15',
			"lat"	=> $device->lat,
			"lng"	=> $device->lng,
		);
		$js = $this->load->view("template/map", $this->data, true);
		$js = $js.$this->buildmarkermap->getJs( ( object ) array( $device ) );
		
		$this->data['tbody']		= $measures; 
		$this->data['device']		= $device;
		$this->data['htmlChart'] 	= $htmlChart;
		$this->data['jsChart']		= $jsChart;
		$this->data['path']		= "Detalhes";
		$this->data['js']		= $js;
		$this->data['header']		= $this->load->view("common/header", $this->data, true);
		$this->data['navbar']		= $this->load->view("common/navbar", $this->data, true);
		$this->data['content']		= $this->load->view("pages/dashboard_device", $this->data, true);
		$this->data['footer']		= $this->load->view("common/footer", $this->data, true);
		$this->load->view("page", $this->data);

	}
}
