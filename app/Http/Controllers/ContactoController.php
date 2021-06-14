<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactoResource;
use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacto=Contacto::paginate(10);
        return ContactoResource::collection($contacto);
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
        //
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'telefono'=>'required'
        ]);
        $contacto= new Contacto();
        $contacto->nombre=$request->nombre;
        $contacto->apellido=$request->apellido;
        $contacto->telefono=$request->telefono;
        if($contacto->save()){
            return new ContactoResource($contacto);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $contacto=Contacto::findOrFail($id);
        return  new ContactoResource($contacto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $contacto=Contacto::findOrFail($id);
        $contacto->nombre=$request->nombre;
        $contacto->apellido=$request->apellido;
        $contacto->telefono=$request->telefono;
        if($contacto->save()){
            return new ContactoResource($contacto);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $contacto=Contacto::findOrFail($id);
        if($contacto->delete()){
            return new ContactoResource($contacto);
        }
    }
}
