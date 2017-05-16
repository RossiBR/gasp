<?php

namespace App\Http\Controllers;

use App\LinhaFormacao;
use Illuminate\Http\Request;

class LinhaFormacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = LinhaFormacao::paginate();
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LinhaFormacao  $linhaFormacao
     * @return \Illuminate\Http\Response
     */
    public function show(LinhaFormacao $linhaFormacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LinhaFormacao  $linhaFormacao
     * @return \Illuminate\Http\Response
     */
    public function edit(LinhaFormacao $linhaFormacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LinhaFormacao  $linhaFormacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LinhaFormacao $linhaFormacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LinhaFormacao  $linhaFormacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(LinhaFormacao $linhaFormacao)
    {
        //
    }
}
