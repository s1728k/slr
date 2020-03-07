<?php 
include_once($app_key.'/include/Model.php');
/**
 * 
 */
class BoxtA extends Model
{
	public static $table = 'boxt_answers';
	
	public static $fields = ['id','boxt_id','icon','image','text','info','nextStatus','queryFragment','value','tag','created_at','updated_at',];

	public static $visibles = ['id','boxt_id','icon','image','text','info','nextStatus','queryFragment','value','tag','created_at','updated_at',];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}

