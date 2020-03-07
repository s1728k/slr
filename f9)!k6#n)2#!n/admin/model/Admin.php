<?php 
include_once($app_key.'/include/Model.php');
/**
 * 
 */
class Admin extends Model
{
	public static $table = 'admins';
	
	public static $fields = ['id', 'avatar','name','email','password','phone','role','favorites','last_logged_in','p1','p2','p3','p4','p5','p6','p7','p8','p9','p10','p11','p12','p13','p14','p15','p16','p17','p18','p19','p20','p21','p22','p23','p24','p25','p26','p27','p28','created_at','updated_at'];

	public static $visibles = ['id','name','email','phone','role','last_logged_in','created_at','updated_at'];

	public static $settings = ['id','name'];

	public static function roleArray($role = null){
		if($role == 'settings'){
			return self::$settings;
		}elseif($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}