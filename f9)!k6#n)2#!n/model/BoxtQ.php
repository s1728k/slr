<?php 
include_once($app_key.'/include/Model.php');
/**
 * 
 */
class BoxtQ extends Model
{
	public static $table = 'boxt_questions';
	
	public static $fields = ['id','boxt_id','text','additionalInfo','helpText','ignoreIfAnswered','template','subtitle','helpTemplate','tag','productType','dependentAnswers','answers','created_at','updated_at',];

	public static $visibles = ['id','boxt_id','text','additionalInfo','helpText','ignoreIfAnswered','template','subtitle','helpTemplate','tag','productType','dependentAnswers','answers','created_at','updated_at',];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}

