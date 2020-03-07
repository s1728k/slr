<?php 
include($app_key.'/model/Buyer.php');
$_POST['accept_terms'] = $_POST['accept_terms']=='on'?1:0;
$varr =[
	'date'=>'required',
	'name'=>'required',
	'phone_no'=>'required',
	'whats_app_no'=>'required',
	'your_location'=>'required',
	'address'=>'required',
	'pin'=>'required',
	'dimension'=>'required',
];
if(in_array($_POST['property_category'],['House','Flats','Independent House','Form House','Villas'])){
	unset($varr['dimension']);
}
Buyer::validate($varr);
$_POST['view_rand'] = rand();
$id = Buyer::create();
$result = [Buyer::find($id)];
$msg1 = "Please check back your information! We will get back to you soon.";
include($app_key.'/view/buyer_props.php');
?>