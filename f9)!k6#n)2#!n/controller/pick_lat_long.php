<?php 
if(strpos($_POST['url'],'@')>0){
	$page = $_POST['url'];
}else{
	$page = file_get_contents('http://checkshorturl.com/expand.php?u='.$_POST['url']);

	$first = strpos($page,'Long URL');
	$first = strpos($page,'href',$first);
}

$first = strpos($page,'@',$first);
$last = strpos($page,',',$first+1);
$latitude = substr($page,$first+1,$last-$first-1);

$first = $last+1;
$last = strpos($page,',',$first+1);
$longitude = substr($page,$first,$last-$first);

header('content-type:application/json');
if(is_numeric($latitude) && is_numeric($longitude) && $latitude>-90 && $latitude<90 && $longitude>-180 && $longitude<180){
	echo json_encode(['data'=>"latlong",'latitude'=>$latitude, 'longitude'=>$longitude]);
}else{
	$reg = "(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})";
	if(preg_match($reg,$_POST['url'])){
		echo json_encode(['data'=>"save"]);
	}
}

?>