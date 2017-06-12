<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use DateInterval;
use App\Curso;
use App\CursoModulo;
use App\CursoPeriodo;
use App\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CursoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        $query = Curso::with('grade.ramo', 'grade.linha_formacao', 'grade.tipo_curso', 'local', 'distrito', 'equipe.associado', 'modulos');
              
  //      $query = $query->orderBy('nome');        

        $list = $query->paginate();


        foreach ($list as $curso) {            
            $this->authorize('view', $curso);            
            //$curso->ims->sortBy('ramo.id');
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
        $this->authorize('create', Curso::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Curso::class);

        $curso = new Curso;
        $curso->grade_id = $request->grade_id;
        $curso->local_id = $request->local_id;
        $curso->distrito_id = $request->distrito_id;
        $curso->criador_id = Auth::user()->id;               
        
        $curso->save();


        $grade = Grade::with('modulos.modulo')->find($curso->grade_id);
        if ($grade->modulos) {
            $ultimoPeriodo = 0;
            $cursoPeriodo = 0;
            foreach ($grade->modulos as $gm) {
                if ($ultimoPeriodo < $gm->periodo) {
                    $cursoPeriodo = new CursoPeriodo;
                    $cursoPeriodo->curso_id = $curso->id;
                    $cursoPeriodo->save();
                    $ultimoPeriodo = $gm->periodo;
                }
                $cursoModulo = new CursoModulo;
                $cursoModulo->curso_id = $curso->id;
                $cursoModulo->curso_periodo_id = $cursoPeriodo->id;
                $cursoModulo->ordem = $gm->ordem;
                $cursoModulo->modulo_id = $gm->modulo_id;
                $cursoModulo->carga_horaria_min = $gm->modulo->carga_horaria_min;
                $cursoModulo->save();      
            }
        }

        return Curso::with('grade.ramo', 'grade.linha_formacao', 'grade.tipo_curso','local', 'distrito')->find($curso->id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        $this->authorize('view', $curso);
        $curso = Curso::with('grade.ramo', 'grade.linha_formacao', 'grade.tipo_curso','local', 'distrito', 'modulos.modulo', 'diretor')->find($curso->id);

        return $curso;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        $this->authorize('update', $curso);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {
        $this->authorize('update', $curso);

        $curso = Curso::find($curso->id);
        //$curso->grade_id = $request->grade_id;
        $curso->local_id = $request->local_id;
        $curso->diretor_associado_id = $request->diretor_associado_id;
        //$curso->distrito_id = $request->distrito_id;
        //$curso->criador_id = Auth::user()->id;
        
        $curso->save();

        return Curso::with('grade.ramo', 'grade.linha_formacao', 'grade.tipo_curso','local', 'distrito', 'diretor')->find($curso->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        $this->authorize('delete', $curso);
    }

    
}
