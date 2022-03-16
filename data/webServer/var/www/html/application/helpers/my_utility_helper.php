<?php

function findWordOnObjectArray( $findAt, $findThisWord) {
	
	if(!$findThisWord){
		return $findAt;
	}

	if(!$findThisWord){
		return $findAt;
	}
	
	$dataArray = array();
	$findThisWord = strtolower($findThisWord);
	$findThisWord = trim($findThisWord);

	foreach($findAt as $data) {
		if(!$data) return $dataArray;
		foreach($data as $elem) {			
			$compareThis = strtolower($elem);
			$compareThis = trim($compareThis);
			if(preg_match("/".$findThisWord."/", $compareThis) > 0){
				array_push( $dataArray, $data );
				break;
			}
		}
	}
	return $dataArray;
}
