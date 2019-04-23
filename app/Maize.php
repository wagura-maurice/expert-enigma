<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maize extends Model
{
    protected $table= 'maize_reports';

    public static function latest_maize_report()
	{
		return Maize::latest()->first();
	}
}
