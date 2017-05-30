<?php

namespace App\Http\Controllers;

use App\Grade;
use App\InsigniaMadeira;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GradeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        $query = Grade::with('ramo', 'linha_formacao', 'tipo_curso');
              
  //      $query = $query->orderBy('nome');        

        $list = $query->paginate();


        foreach ($list as $grade) {            
            $this->authorize('view', $grade);
            //$grade->ims->sortBy('ramo.id');
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
        $this->authorize('create', Grade::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Grade::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        $this->authorize('view', $grade);
        return Grade::with('ramo', 'linha_formacao', 'tipo_curso')->find($grade->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        $this->authorize('update', $grade);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        $this->authorize('update', $grade);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $this->authorize('delete', $grade);
    }
}
