<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maize extends Model
{
    protected $table= 'maize_reports';

    public static function latest_maize_report()
	{
		return Self::orderByDesc('id')->first();
	}

	public static function planting($data)
	{
		$i = 1;
		foreach ($data as $key => $value) {

		    $farmer = \App\Farmers::getFarmer($value->id_number);

		    if (isset($farmer->id)) {

		        $insert[] = [
		            'id' => Self::latest_maize_report()->id + $i,
		            'acres_planted' => $value->acreage,
		            'kg_of_seed_planted' => $value->seeds_planted_kg,
		            'farmer_id' => $farmer->id,
		            'created_at' => \Carbon\Carbon::parse(now())->addSeconds($i)->format('Y-m-d H:i:s'),
		            'updated_at' => \Carbon\Carbon::parse(now())->addSeconds($i)->format('Y-m-d H:i:s'),
		            'report_type' => 'planting',
		            'season' => 4, //$value->season,
		            'kg_of_fertilizer' => $value->fertilizer_kg,
		            'status' => 'verified'
		        ];
		    }
		    $i++;
		}

		return $insert;
	}

	public static function harvesting($data)
	{
		$i = 1;
		foreach ($data as $key => $value) {

		    $farmer = \App\Farmers::getFarmer($value->id_number);

		    if (isset($farmer->id)) {

		        $insert[] = [
		            'id' => Self::latest_maize_report()->id + $i,
		            'farmer_id' => $farmer->id,
		            'created_at' => \Carbon\Carbon::parse(now())->addSeconds($i)->format('Y-m-d H:i:s'),
		            'updated_at' => \Carbon\Carbon::parse(now())->addSeconds($i)->format('Y-m-d H:i:s'),
		            'bags_harvested' => $value->bags_harvested,
		            'report_type' => 'harvest',
		            'season' => 4, //$value->season,
		            'status' => 'verified'
		        ];
		    }
		    $i++;
		}

		return $insert;
	}
}
