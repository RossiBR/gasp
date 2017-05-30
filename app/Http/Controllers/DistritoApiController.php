<?php

namespace App\Http\Controllers;

use Auth;
use App\Distrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DistritoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        $list = Distrito::all();
              
  //      $query = $query->orderBy('nome');        

        //$list = $query->paginate();


        foreach ($list as $distrito) {            
            $this->authorize('view', $distrito);            
            //$distrito->ims->sortBy('ramo.id');
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
        $this->authorize('create', Distrito::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Distrito::class);



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function show(Distrito $distrito)
    {
        $this->authorize('view', $distrito);
        return Distrito::find($distrito->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function edit(Distrito $distrito)
    {
        $this->authorize('update', $distrito);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distrito $distrito)
    {
        $this->authorize('update', $distrito);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distrito $distrito)
    {
        $this->authorize('delete', $distrito);
    }
}
