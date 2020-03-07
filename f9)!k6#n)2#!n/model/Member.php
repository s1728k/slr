<?php 
include_once($app_key.'/include/Model.php');
/**
 * 
 */
class Member extends Model
{
	public static $table = 'members';
	
	public static $fields = ['id','view_rand','social_media','date','name','phone_no','whats_app_no','email','address','member_type','property_category','comments','accept_terms','status','status_date','comments_array','created_at','updated_at',];

	public static $visibles = ['id','view_rand','social_media','date','name','phone_no','whats_app_no','email','address','member_type','property_category','created_at','updated_at',];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}

