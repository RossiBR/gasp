<?php

namespace App\Http\Controllers;

use App\Ramo;
use Illuminate\Http\Request;

class RamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Ramo::paginate();
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
     * @param  \App\Ramo  $ramo
     * @return \Illuminate\Http\Response
     */
    public function show(Ramo $ramo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ramo  $ramo
     * @return \Illuminate\Http\Response
     */
    public function edit(Ramo $ramo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ramo  $ramo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ramo $ramo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ramo  $ramo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ramo $ramo)
    {
        //
    }
}
