<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use DateInterval;
use App\CursoEquipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CursoEquipeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = CursoEquipe::with('associado')->where('curso_id', $request->curso_id);

        $list = $query->get();    

        $list->sortBy('associado.nome');

        return $list;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', CursoEquipe::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('create');
        $this->authorize('create', CursoEquipe::class);

        $cursoEquipe = new CursoEquipe;        
        $cursoEquipe->curso_id = $request->curso_id;
        $cursoEquipe->associado_id = $request->associado_id;             
        
        $cursoEquipe->save();
        Log::info($cursoEquipe);
        return CursoEquipe::with('associado')->find($cursoEquipe->id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CursoEquipe  $cursoEquipe
     * @return \Illuminate\Http\Response
     */
    public function show(CursoEquipe $cursoEquipe)
    {
        $this->authorize('view', $cursoEquipe);
        $cursoEquipe = CursoEquipe::find($cursoEquipe->id);      

        return $cursoEquipe;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CursoEquipe  $cursoEquipe
     * @return \Illuminate\Http\Response
     */
    public function edit(CursoEquipe $cursoEquipe)
    {
        $this->authorize('update', $cursoEquipe);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CursoEquipe  $cursoEquipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CursoEquipe $cursoEquipe)
    {
        Log::info('update');
        $this->authorize('update', $cursoEquipe);

        $cursoEquipe = CursoEquipe::find($cursoEquipe->id);

        $cursoEquipe->save();

        return CursoEquipe::find($cursoEquipe->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CursoEquipe  $cursoEquipe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::info('delete: ' . $id);
        $item = CursoEquipe::findOrFail($id);        
        $this->authorize('delete', $item);

        $item->delete();
    }

  


}
