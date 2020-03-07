<?php 
include_once($app_key.'/include/Model.php');
/**
 * 
 */
class LinkShare extends Model
{
	public static $table = 'linkshares';
	
	public static $fields = ['id', 'shared_props','shared_to_id','shared_to_cat','urlcode','category','whats_app_no','contact_info','location_info','status_info','created_at','updated_at'];

	public static $visibles = ['id', 'shared_props','shared_to_id','shared_to_cat','urlcode','category','whats_app_no','created_at','updated_at'];
}