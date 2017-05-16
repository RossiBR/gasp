<?php

namespace App\Http\Controllers;

use App\ContratoVoluntario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContratoVoluntarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = ContratoVoluntario::all();
        $list->load('associado'); 
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
        $im = new ContratoVoluntario;
        $im->associado_id = $request->associado_id;
        $im->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContratoVoluntario  $contratoVoluntario
     * @return \Illuminate\Http\Response
     */
    public function show(ContratoVoluntario $contratoVoluntario)
    {
        $item = ContratoVoluntario::find($contratoVoluntario->id);
        $list->load('associado');
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContratoVoluntario  $contratoVoluntario
     * @return \Illuminate\Http\Response
     */
    public function edit(ContratoVoluntario $contratoVoluntario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContratoVoluntario  $contratoVoluntario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContratoVoluntario $contratoVoluntario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContratoVoluntario  $contratoVoluntario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        Log::info($id);
        
        $item = ContratoVoluntario::findOrFail($id);
        $item->delete();
    }
}
