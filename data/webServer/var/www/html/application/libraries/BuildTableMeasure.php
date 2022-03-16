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



class BuildTableMeasure {
	function __construct(){
		
	}
	
	public function getHtml($data_array){
		$html = "";
		$fakeId = 1;
		if(!$data_array) return $html;
		foreach ($data_array as $elem) {
			if(!$elem) return $html;

			$elem = (Object) array (
				"fakeId"	=> $fakeId++,
				"timestamp"	=> $elem->timestamp,
				"topic"		=> $elem->topic,
				"payload"	=> $elem->payload,
			);
			
			$html= $html."<tr>";
			$html= $html."<th scope='row'>".$elem->fakeId."</th>";
			$html= $html."<td>".$elem->timestamp."</td>";
			$html= $html."<td>".$elem->topic."</td>";
			$html= $html."<td>".$elem->payload."</td>";
			$html= $html."</tr>";
		}
		return $html;
	}
}