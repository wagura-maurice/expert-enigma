<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmers extends Model
{
    protected $table= 'farmers';

	public static function getFarmer($value)
	{
		return Self::where(['national_id_number' => $value])->first();
	}
}
