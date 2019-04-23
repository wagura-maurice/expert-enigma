<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmers extends Model
{
    protected $table= 'farmers';

	/*protected $fillable = [
		'title',
		'description'
	];

	public static $create_rules = [
		'title' => 'required|string|unique:sp_about_us',
		'description' => 'required|string',
	];

	public static $update_rules = [
		'title' => 'required|string',
		'description' => 'required|string',
	];*/

	public static function getFarmer($value)
	{
		return Farmers::where(['national_id_number' => $value])->first();
	}
}
