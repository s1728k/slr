<?php 
include_once($app_key.'/include/Model.php');
/**
 * 
 */
class Setting extends Model
{
	public static $table = 'settings';
	
	public static $fields = ['id','social_media','sellable_properties','rentable_properties','bhk','sites','commercial_properties','pot_bhk','pot_sites','pot_commercial_properties','sell_prices','rent_prices','price_units','land_units','land_per_unit','member_types','member_works','messages','created_at','updated_at'];

	public static $visibles = ['id','social_media','sellable_properties','rentable_properties','bhk','sites','commercial_properties','pot_bhk','pot_sites','pot_commercial_properties','sell_prices','rent_prices','price_units','land_units','land_per_unit','member_types','member_works','messages','created_at','updated_at'];
}