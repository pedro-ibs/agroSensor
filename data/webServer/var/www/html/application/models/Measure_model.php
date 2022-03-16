<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Measure.php
 *
 *  @date Created at:	19/09/2021 13:05:58
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


class Measure_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->model("Device_model", "m_device" );

	}

	private function checkDevice($id_device){
		$device = $this->m_device->getAt($id_device);
		if(!$device){ return -1; }
		return $device->id;
	}

	public function getAfterAt( $id_device, $topic,  $start, $stop=false) {
		if( isForbidden($id_device)	) return;
		if( isForbidden($topic)		) return;
		if( isForbidden($start)		) return;
		if( isForbidden($stop)		) return;
		
		if($this->checkDevice($id_device) <= 0){
			return null;
		}

		if( $stop == false ){
			$sql = "id_sensor = ".$id_device." AND topic = '".$topic."' AND `timestamp >'".$start."'";
		} else {
			$sql = "id_sensor = ".$id_device." AND topic = '".$topic."' AND `timestamp` BETWEEN '".$start."' AND '".$stop."'";
		}
		
		$query = $this->db->get_where("measures", $sql)->result();
		if(!$query) {
			return null;
		}

		return (object)$query;
	}

	public function getLast( $id_device, $last) {
		if( isForbidden($id_device)	) return;
		if( isForbidden($last)		) return;

		if($this->checkDevice($id_device) <= 0){
			return null;
		}

		$query = $this->db->query("SELECT * FROM agrosensor.measures WHERE id_sensor=".$id_device." ORDER BY `timestamp` DESC LIMIT ".$last.";")->result();
		if(!$query) {
			return null;
		}

		return (object)$query;
	}
}
