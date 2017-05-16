<?php

namespace App\Http\Controllers;

use App\UEL;
use Illuminate\Http\Request;

class UELController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = UEL::paginate();
        return $list;

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
     * @param  \App\UEL  $UEL
     * @return \Illuminate\Http\Response
     */
    public function show(UEL $UEL)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UEL  $UEL
     * @return \Illuminate\Http\Response
     */
    public function edit(UEL $UEL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UEL  $UEL
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UEL $UEL)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UEL  $UEL
     * @return \Illuminate\Http\Response
     */
    public function destroy(UEL $UEL)
    {
        //
    }
}
