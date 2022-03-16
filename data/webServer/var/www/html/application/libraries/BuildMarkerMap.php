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


class BuildMarkerMap {
	function __construct(){
		$this->ci =& get_instance();
	}

	public function getJs($data_array){
		$js ="";
		if(!$data_array) return $js;
		foreach ($data_array as $elem) {
			if(!$elem) return $js;
			$msg = "<a href=\"".base_url('Dashboard/device/'.$elem->id)."\">".$elem->name."</a>: ".$elem->description;
			$js = $js."L.marker([".$elem->lat.",".$elem->lng."], {title: '".$elem->name."'}).addTo(my_map).bindPopup('".$msg."');";
		}
		return $js;
	}
}