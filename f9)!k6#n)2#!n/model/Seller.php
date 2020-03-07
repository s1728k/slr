<?php 
include_once($app_key.'/include/Model.php');
/**
 * 
 */
class Seller extends Model
{
	public static $table = 'seller';
	
	public static $fields = ['id','view_rand','social_media','lead_cat','lead_type','date','name','phone_no','whats_app_no','address','pin','villege','landmark','file_paths','sr_type','property_category','property_type','dimension','dim_unit','tprice','price','goodwill','advance','p_unit','p_dim','comments','status','status_date','comments_array','comments1','comments2','comments3','latitude','longitude','place_link','accept_terms','created_at','updated_at',];

	public static $visibles = ['id','view_rand','social_media','lead_cat','lead_type','date','name','phone_no','whats_app_no','address','pin','property_category','property_type','dimension','dim_unit','status','status_date','created_at','updated_at',];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}