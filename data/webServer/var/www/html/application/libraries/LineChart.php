<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * LineChart.php
 *
 *  @date Created at:	19/09/2021 11:33:51
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




class LineChart {
	function __construct(){
		$this->ci =& get_instance();
	}

	public function getNewHtml($id, $topic){
		return "<canvas id='".$topic.$id."Chart'></canvas>";
	}
	
	public function getNewJs($id, $topic){
		$data = (Object) array(
			"id" => $id,
			"topic" => $topic,
		);
		$js = $this->ci->load->view("template/jsChart", $data , true);
		return $js;
	}
}






