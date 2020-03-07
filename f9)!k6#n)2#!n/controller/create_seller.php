<?php 
include($app_key.'/model/Seller.php');
$_POST['accept_terms'] = $_POST['accept_terms']=='on'?1:0;
$varr =[
	'date'=>'required',
	'name'=>'required',
	'phone_no'=>'required',
	'whats_app_no'=>'required',
	'address'=>'required',
	'pin'=>'required',
	'file_paths'=>'required',
	'villege'=>'required',
	'landmark'=>'required',
	'dimension'=>'required',
	'price'=>'required',
	'accept_terms'=>'required'
];
if(in_array($_POST['property_category'],['House','Flats','Independent House','Form House','Villas'])){
	unset($varr['dimension']);
}
Seller::validate($varr);
$_POST['view_rand'] = rand();
$id = Seller::create();
$result = [Seller::find($id)];
$msg1 = "Please check back your information! We will get back to you soon.";
include($app_key.'/view/seller_props.php');
?>