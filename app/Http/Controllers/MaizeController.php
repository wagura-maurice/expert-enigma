<?php

namespace App\Http\Controllers;

use App\Maize;
use App\Farmers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Excel;
use File;

class MaizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('add-maize');
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
                if(!empty($data) && $data->count()){
                    $i = 1;
                    foreach ($data as $key => $value) {

                        $farmer = Farmers::getFarmer($value->id_number);

                        if (isset($farmer->id)) {

                            $insert[] = [
                                'id' => Maize::latest_maize_report()->id + $i,
                                'acres_planted' => $value->acreage,
                                'kg_of_seed_planted' => $value->seeds_planted_kg,
                                'farmer_id' => $farmer->id,
                                'created_at' => '2018-10-22 00:00:00',
                                'updated_at' => '2019-04-22 00:00:00',
                                'bags_harvested' => $value->bags_harvested,
                                'report_type' => 'harvest',
                                'season' => $value->season,
                                'kg_of_fertilizer' => $value->fertilizer_kg,
                                'status' => 'pending'
                            ];
                        }
                        $i++;
                    }

                    echo "<pre>";
                    print_r($insert);
                    die();

                    if(!empty($insert)){

                        $insertData = Maize::insert($insert);
                        
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
     * @param  \App\Maize  $maize
     * @return \Illuminate\Http\Response
     */
    public function show(Maize $maize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maize  $maize
     * @return \Illuminate\Http\Response
     */
    public function edit(Maize $maize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maize  $maize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maize $maize)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maize  $maize
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maize $maize)
    {
        //
    }
}
