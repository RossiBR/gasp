<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use DateInterval;
use App\CursoModulo;
use App\CursoPeriodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CursoModuloApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $periodos = CursoPeriodo::where('curso_id', $request->curso_id)->orderBy('data_inicio')->get();
        Log::debug($periodos);
        $finalList = null;
        foreach ($periodos as $periodo) {            
            $query = CursoModulo::with('modulo')->where('curso_periodo_id', $periodo->id)->orderBy('ordem'); 
            $list = $query->get();      
            Log::debug($finalList);
            Log::debug($list);
            $date = null;        
            $cursoPeriodo = null;
            foreach ($list as $cm) {
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
            $finalList = $finalList ? json_encode(array_merge(json_decode($finalList, true),json_decode($list, true))) : $list;            
        }

        return $finalList;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', CursoModulo::class);
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
        $this->authorize('create', CursoModulo::class);

        $curso = new CursoModulo;
        $curso->grade_id = $request->grade_id;
        $curso->local_id = $request->local_id;
        $curso->distrito_id = $request->distrito_id;
        $curso->criador_id = Auth::user()->id;               
        
        $curso->save();


        $grade = Grade::with('modulos.modulo')->find($curso->grade_id);
        if ($grade->modulos) {
            foreach ($grade->modulos as $gm) {
                $cursoModulo = new CursoModulo;
                $cursoModulo->curso_id = $curso->id;
                $cursoModulo->ordem = $gm->ordem;
                $cursoModulo->modulo_id = $gm->modulo_id;
                $cursoModulo->carga_horaria_min = $gm->modulo->carga_horaria_min;
                $cursoModulo->save();      
            }
        }

        return CursoModulo::with('modulo')->find($curso->id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CursoModulo  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(CursoModulo $curso)
    {
        $this->authorize('view', $curso);
        $curso = CursoModulo::find($curso->id);      

        return $curso;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CursoModulo  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(CursoModulo $curso)
    {
        $this->authorize('update', $curso);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CursoModulo  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CursoModulo $curso)
    {
        Log::info('update');
        $this->authorize('update', $curso);

        $curso = CursoModulo::find($curso->id);

        $curso->save();

        return CursoModulo::find($curso->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CursoModulo  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(CursoModulo $cm)
    {
        $this->authorize('delete', $curso);
    }

   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CursoModulo  $curso
     * @return \Illuminate\Http\Response
     */
    public function up(Request $request, CursoModulo $cursoModulo)
    {
        
        //$this->authorize('update', $curso);

        Log::info('upping ' . $cursoModulo);           

        $currentPosition = $cursoModulo->ordem;
        if ($currentPosition <= 1) {
          Log::debug('nop up');
            return;
        }
        Log::debug('lets up');
        $query = CursoModulo::with('modulo')->where('curso_id', $cursoModulo->curso_id)->orderBy('ordem');
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
     * @param  \App\CursoModulo  $curso
     * @return \Illuminate\Http\Response
     */
    public function down(Request $request, CursoModulo $cursoModulo)
    {
        
        //$this->authorize('update', $curso);

        Log::info('downing ' . $cursoModulo);           

        $currentPosition = $cursoModulo->ordem;
        $query = CursoModulo::with('modulo')->where('curso_id', $cursoModulo->curso_id)->orderBy('ordem');
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
