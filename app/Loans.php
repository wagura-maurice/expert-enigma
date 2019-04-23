<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    protected $table= 'loans';

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
 
	public static function generate_string($strength = 16) {
		$input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $input_length = strlen($input);
	    $random_string = '';
	    for($i = 0; $i < $strength; $i++) {
	        $random_character = $input[mt_rand(0, $input_length - 1)];
	        $random_string .= $random_character;
	    }
	 
	    return $random_string;
	}

	public static function latest_loan_report()
	{
		return Loans::latest()->first();
	}
}
