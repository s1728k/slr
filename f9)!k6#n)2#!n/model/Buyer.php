<?php 
include_once($app_key.'/include/Model.php');
/**
 * 
 */
class Buyer extends Model
{
	public static $table = 'buyer';

	public static $fields = ['id','view_rand','lead_cat','lead_type','date','name','phone_no','whats_app_no','your_location','address','pin','br_type','property_category','property_type','dimension','dim_unit','min_price','max_price','comments','status','status_date','comments_array','comments1','comments2','comments3','accept_terms','created_at','updated_at',];

	public static $visibles = ['id','view_rand','lead_cat','lead_type','date','name','phone_no','whats_app_no','address','pin','property_category','property_type','dimension','dim_unit','status','status_date','created_at','updated_at',];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}

}

