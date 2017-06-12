<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use DateInterval;
use App\CursoPeriodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CursoPeriodoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = CursoPeriodo::with('modulos.modulo')->where('curso_id', $request->curso_id)->orderBy('data_inicio');      

        $list = $query->get();    
        foreach ($list as $periodo) {
            $periodo->modulos = $periodo->modulos->sortBy('ordem');
            $date = null;        
            $cursoPeriodo = null;
            foreach ($periodo->modulos as $cm) {
                if($cursoPeriodo <> $cm->curso_periodo_id) {
                    $cursoPeriodo = $cm->curso_periodo_id;
                    if ($date) {
                        $date->add(new DateInterval('P1D'));
                    } else {
                        $date = new DateTime('2017-01-01 08:00');                        
                    }
                    
                }
                //$this->authorize('view', $cm);
                $cm->horario_inicio = $date->format('H:i');
                $date->add(new DateInterval('PT' . $cm->carga_horaria_min . 'M'));
                $cm->horario_fim = $date->format('H:i');

            }
                
               
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
        $this->authorize('create', CursoPeriodo::class);
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
        $this->authorize('create', CursoPeriodo::class);

        $cursoPeriodo = new CursoPeriodo;
        $cursoPeriodo->curso_id = $request->curso_id;
               
        
        $cursoPeriodo->save();

        return CursoPeriodo::find($cursoPeriodo->id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CursoPeriodo  $cursoPeriodo
     * @return \Illuminate\Http\Response
     */
    public function show(CursoPeriodo $cursoPeriodo)
    {
        $this->authorize('view', $cursoPeriodo);
        $cursoPeriodo = CursoPeriodo::find($cursoPeriodo->id);      

        return $cursoPeriodo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CursoPeriodo  $cursoPeriodo
     * @return \Illuminate\Http\Response
     */
    public function edit(CursoPeriodo $cursoPeriodo)
    {
        $this->authorize('update', $cursoPeriodo);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CursoPeriodo  $cursoPeriodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CursoPeriodo $cursoPeriodo)
    {
        Log::info('update');
        $this->authorize('update', $cursoPeriodo);

        $cursoPeriodo = CursoPeriodo::find($cursoPeriodo->id);

        $cursoPeriodo->save();

        return CursoPeriodo::find($cursoPeriodo->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CursoPeriodo  $cursoPeriodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CursoPeriodo $cm)
    {
        $this->authorize('delete', $cursoPeriodo);
    }

   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CursoPeriodo  $cursoPeriodo
     * @return \Illuminate\Http\Response
     */
    public function up(Request $request, CursoPeriodo $cursoModulo)
    {
        
        //$this->authorize('update', $cursoPeriodo);

        Log::info('upping ' . $cursoModulo);           

        $currentPosition = $cursoModulo->ordem;
        if ($currentPosition <= 1) {
          Log::debug('nop up');
            return;
        }
        Log::debug('lets up');
        $query = CursoPeriodo::with('modulo')->where('curso_id', $cursoModulo->curso_id)->orderBy('ordem');
        $list = $query->get();

        $newPosition = $cursoModulo->ordem - 1;        
        foreach ($list as $cm) {                     
            if ($cm->ordem == $newPosition) {                
                $cm->ordem = $cm->ordem + 1;
                $cm->save();
                break;
            }
        }
        $cursoModulo->ordem = $newPosition;       

        $cursoModulo->save();
    }


/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CursoPeriodo  $cursoPeriodo
     * @return \Illuminate\Http\Response
     */
    public function down(Request $request, CursoPeriodo $cursoModulo)
    {
        
        //$this->authorize('update', $cursoPeriodo);

        Log::info('downing ' . $cursoModulo);           

        $currentPosition = $cursoModulo->ordem;
        $query = CursoPeriodo::with('modulo')->where('curso_id', $cursoModulo->curso_id)->orderBy('ordem');
        $list = $query->get();

        if ($currentPosition >= count($list)) {
          Log::debug('nop down');
            return;
        }
        Log::debug('lets down');
        
        
        $newPosition = $cursoModulo->ordem +1;        
        foreach ($list as $cm) {                     
            if ($cm->ordem == $newPosition) {                
                $cm->ordem = $cm->ordem - 1;
                $cm->save();
                break;
            }
        }
        $cursoModulo->ordem = $newPosition;       

        $cursoModulo->save();
    }


}
