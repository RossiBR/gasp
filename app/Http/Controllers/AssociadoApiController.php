<?php

namespace App\Http\Controllers;

use App\Associado;
use App\InsigniaMadeira;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AssociadoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $field = $request->field;
        $search = $request->search;
        $im = $request->im;
        $ramo = $request->ramo;
        $linha = $request->linha;
        $contrato = $request->contrato;            

        $query = Associado::with('ims.ramo', 'ims.linha_formacao', 'contratos');         
        
        $query = $query->withCount('ims');
        $query = $query->withCount('contratos');

        
        if ($im == 1) {
            $query = $query->has('ims' ,'>', 0);
        }
        if ($ramo) {
            $query = $query->whereHas('ims', function ($query) use ($ramo) {
                $query->where('ramo_id', '=', $ramo);
            });
        }
        if ($linha) {
            $query = $query->whereHas('ims', function ($query) use ($linha) {
                $query->where('linha_formacao_id', '=', $linha);
            });
        }
         
        if ($contrato == 2) {
            $query = $query->whereHas('contratos', function ($query) {
                $query->where('data_fim', '<', date("Y-m-d H:i:s"));
            });
        }
        if ($contrato == 1) {
            $query = $query->whereHas('contratos', function ($query) {
                $query->where('data_fim', '>=', date("Y-m-d H:i:s"));
            });
        }
        if ($contrato == 3) {
            $query = $query->has('contratos' ,'=', 0);
        }

        //$query = $query->where('registro', 'like', '%'.$search.'%');
        //($search) {
        $query = $query->where($field, 'like', '%'.$search.'%');
        //}
        
        $query = $query->orderBy('nome');        

        $list = $query->paginate();


        foreach ($list as $associado) {            
            $this->authorize('view', $associado);            
            //$associado->ims->sortBy('ramo.id');
        }

        return $list;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Associado::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Associado::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Associado  $associado
     * @return \Illuminate\Http\Response
     */
    public function show(Associado $associado)
    {
        $this->authorize('view', $associado);
        return Associado::with('ims.ramo', 'ims.linha_formacao')->find($associado->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Associado  $associado
     * @return \Illuminate\Http\Response
     */
    public function edit(Associado $associado)
    {
        $this->authorize('update', $associado);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Associado  $associado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Associado $associado)
    {
        $this->authorize('update', $associado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Associado  $associado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Associado $associado)
    {
        $this->authorize('delete', $associado);
    }
}
