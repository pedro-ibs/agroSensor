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


class BuildCardUser {
	function __construct(){
		$this->ci =& get_instance();
		$this->html	= "";
	}

	public function build($data_array){
		$html	= "";
	
		if(!$data_array) return;
		
		foreach ($data_array as $elem) {

			if(!$elem) return;

			$elem = (Object) array (
				"id"		=> $elem->id,
				"first_name"	=> $elem->first_name,
				"last_name"	=> $elem->last_name,
				"nickname"	=> $elem->nickname,
				"type"		=> $elem->type,
			);

			$html	= $html.$this->ci->load->view("template/cardUser", $elem , true);
		}

		$this->html	= $html;
	}


	public function getHtml(){
		return $this->html;
	}
}