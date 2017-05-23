<?php

namespace App\Http\Controllers;

use App\Curso;
use App\InsigniaMadeira;
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
        

        $query = Curso::with('grade.ramo', 'grade.linha_formacao', 'grade.tipo_curso');
              
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
        return Curso::with('grade.ramo', 'grade.linha_formacao', 'grade.tipo_curso')->find($curso->id);
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
