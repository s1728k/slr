<?php
function curl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
$result = curl('https://maps.googleapis.com/maps/api/place/autocomplete/json?input='.$_POST['input'].'&key=AIzaSyAStT0b5XERgSTXI2Oq2goU5xUDxJBNI8U&components=country:in&radius=50000&location=12.972442,77.580643');
$obj = json_decode($result);
$places = [];
foreach ($obj->predictions as $place) {
	$places[]=$place->description;
}
header('content-type:application/json');
echo json_encode($places);
?>