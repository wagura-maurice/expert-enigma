<?php

namespace App\Http\Controllers;

use App\Farmers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Excel;
use File;

class FarmersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\farmers  $farmers
     * @return \Illuminate\Http\Response
     */
    public function show(farmers $farmers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\farmers  $farmers
     * @return \Illuminate\Http\Response
     */
    public function edit(farmers $farmers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\farmers  $farmers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, farmers $farmers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\farmers  $farmers
     * @return \Illuminate\Http\Response
     */
    public function destroy(farmers $farmers)
    {
        //
    }
}
