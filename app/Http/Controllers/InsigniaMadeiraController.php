<?php

namespace App\Http\Controllers;

use App\InsigniaMadeira;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InsigniaMadeiraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = InsigniaMadeira::all();
        $list->load('ramo', 'linha_formacao', 'associado'); 
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
        $im = new InsigniaMadeira;
        $im->associado_id = $request->associado_id;
        $im->ramo_id = $request->ramo_id;
        $im->linha_formacao_id = $request->linha_formacao_id;
        $im->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InsigniaMadeira  $insigniaMadeira
     * @return \Illuminate\Http\Response
     */
    public function show(InsigniaMadeira $insigniaMadeira)
    {
        $item = InsigniaMadeira::find($insigniaMadeira->id);
        $list->load('ramo', 'linha_formacao', 'associado');
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InsigniaMadeira  $insigniaMadeira
     * @return \Illuminate\Http\Response
     */
    public function edit(InsigniaMadeira $insigniaMadeira)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InsigniaMadeira  $insigniaMadeira
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InsigniaMadeira $insigniaMadeira)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InsigniaMadeira  $insigniaMadeira
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        Log::info($id);
        
        $item = InsigniaMadeira::findOrFail($id);
        $item->delete();
    }
}
