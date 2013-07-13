<?php

function zillow_xml() {
	$address 	= urlencode($_REQUEST['address']);
	$zipcode 	= $_REQUEST['zipcode'];
	$zillow_url = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1bf3voyyiob_5i268&address=$address&citystatezip=$zipcode";
	$zillow 	= simplexml_load_file($zillow_url);
	$zcode = $zillow->message->code;
	
	if($zcode == 0) {
			foreach ($zillow->response->results->result as $item) {
			$city 	= $item->address->city;
			$state 	= $item->address->state;
			$sqFt 	= $item->finishedSqFt;						
			$bed	= $item->bedrooms;
			$bath	= $item->bathrooms;
			$zlink 	= $item->links->homedetails; }

			$output = array(
			'city' 		=> $city,
			'state' 	=> $state,								
			'sqFt'		=> $sqFt,
			'bed'		=> $bed,
			'bath'		=> $bath,				
			'zlink'		=> $zlink);

			return $output;	
	}
	else {
			$badadd = 'true';
			return $badadd;
		}	
}


//echo '<pre>', print_r($zillow, true), '</pre>';
//echo $zillow['zlink'];
?>