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
    public function index($action)
    {
        return view('add-maize', ['action' => $action]);
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
                    
                    if ($request->action == 'planting') {
                        $insert = Maize::planting($data);
                    } else if ($request->action == 'harvesting') {
                        $insert = Maize::harvesting($data);
                    }

                    // echo "<pre>";
                    // print_r($insert);
                    // die();

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

            } else {
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
