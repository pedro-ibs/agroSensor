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


class BuildMenu {
	function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->model("Device_model", "m_device");

		$this->data = $this->ci->m_device->takeMine();
	}
	
	public function getHtml( ){
		$html ="";
		if(!$this->data) return $html;

		foreach ($this->data as $elem) {
			if(!$elem) return $html;
			$html=$html."<li class='nav-item  p-2'><a class='nav-link btn my-btn-dark text-capitalize' href='".base_url('Dashboard/device/'.$elem->id)."'>".$elem->name."</a></li>\n";
		}
		return $html;
	}
}