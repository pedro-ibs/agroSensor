<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *  @date Created at:	14/09/2021 11:33:01
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


class BuildCardDevice {
	function __construct(){
		$this->ci =& get_instance();
		$this->html	= "";
		$this->js	= "";
	}

	public function build($data_array){
		$id_fake	= 1;
		$html	= "";
		$js	= "";
	
		if(!$data_array) return;
		
		foreach ($data_array as $elem) {

			if(!$elem) return;

			$elem = (Object) array (
				"id"		=> $elem->id,
				"id_fake"	=> $id_fake++,
				"name"		=> $elem->name,
				"description"	=> $elem->description,
				"mac_address"	=> $elem->mac_address,
				"vcc"		=> $elem->vcc,
				"vbat"		=> $elem->vbat,
				"last_measures" => $elem->last_measures,
				"lat"		=> $elem->lat,
				"lng"		=> $elem->lng,
				"status"	=> $elem->status,
			);

			$html	= $html.$this->ci->load->view("template/cardDevice", $elem , true);
			$js	= $js.$this->ci->load->view("template/jsUpdateDeviceInfo", $elem, true);
		}

		$this->html	= $html;
		$this->js	= $js;
	}


	public function getHtml(){
		return $this->html;
	}


	public function getJs(){
		return $this->js;
	}
}