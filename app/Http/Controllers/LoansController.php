<?php

namespace App\Http\Controllers;

use App\Loans;
use App\Farmers;
use Illuminate\Http\Request;
use Session;
use Excel;
use File;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('add-loans');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));

        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count()) {
                    $i = 1;
                    foreach ($data as $key => $value) {

                        $farmer = Farmers::getFarmer($value->id_number);

                        if (isset($farmer->id)) {

                            $insert[] = [
                                'id' => Loans::latest_loan_report()->id + $i,
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
                                'voucher_code' => strtoupper(Loans::generate_string(10)),
                                'farmer_id' => $farmer->id,
                                'created_at' => \Carbon\Carbon::parse('2018-10-22 00:00:00')->addSeconds($i)->format('Y-m-d H:i:s'),
                                'updated_at' => \Carbon\Carbon::parse('2019-04-22 00:00:00')->addSeconds($i)->format('Y-m-d H:i:s'),
                                'amount_paid' => $value->amount_paid,
                                'service_charge_percentage' => 0
                            ];
                        }
                        $i++;
                    }

                    if(!empty($insert)){

                        $insertData = Loans::insert($insert);
                        
                        if ($insertData) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                return back();

            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loans  $loans
     * @return \Illuminate\Http\Response
     */
    public function show(Loans $loans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loans  $loans
     * @return \Illuminate\Http\Response
     */
    public function edit(Loans $loans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loans  $loans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loans $loans)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loans  $loans
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loans $loans)
    {
        //
    }
}
