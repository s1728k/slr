<?php 
include_once($app_key.'/include/Model.php');
/**
 * 
 */
class SnapDeal extends Model
{
	public static $table = 'snapdeal';
	
	public static $fields = ['id','catid','offset','name','image1','image2','image3','price','price_after_discount','discount','rating','url','created_at','updated_at',];

	public static $visibles = ['id','catid','offset','name','image1','image2','image3','price','price_after_discount','discount','rating','url','created_at','updated_at',];

}