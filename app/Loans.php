<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    protected $table= 'loans';

	public static function latest_loan_report()
	{
		return Self::orderByDesc('id')->first();
	}

	public static function proccess_loans($data)
	{
		$i = 1;
        foreach ($data as $key => $value) {

            $farmer = \App\Farmers::getFarmer($value->id_number);

            if (isset($farmer->id)) {

                $insert[] = [
                    'id' => Self::latest_loan_report()->id + $i,
                    'commodity' => 'inputs',
                    'value' => $value->total_loan_amount,
                    'time_period' => 'before planting',
                    'season' => 3,
                    'interest_rate' => 2.5,
                    'interest_period' => 'month',
                    'interest_type' => 'simple',
                    'duration' => 6,
                    'duration_unit' => 'month',
                    'currency' => 'KES',
                    'service_charge' => 0,
                    'structure' => 'installments',
                    'status' => 'application started',
                    'disbursed_date' => '2018-10-22 00:00:00',
                    'repaid_date' => '2019-04-22 00:00:00',
                    'disbursal_method' => 'supplier',
                    'repayment_method' => 'mpesa',
                    'voucher_code' => strtoupper(Self::generate_string(10)),
                    'farmer_id' => $farmer->id,
                    'created_at' => \Carbon\Carbon::parse(now())->addSeconds($i)->format('Y-m-d H:i:s'),
                    'updated_at' => \Carbon\Carbon::parse(now())->addSeconds($i)->format('Y-m-d H:i:s'),
                    'amount_paid' => $value->amount_paid,
                    'service_charge_percentage' => 0
                ];
            }
            $i++;
        }
        
        return $insert;
	}

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
}
