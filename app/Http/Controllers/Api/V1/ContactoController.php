<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Contacto;
use Illuminate\Http\Request;
use App\Http\Requests\V1\ContactoRequest;
use App\Http\Resources\Api\V1\ContactoResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactoController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$contacto=Contacto::paginate(10);
        //return ContactoResource::collection($contacto);
        
        return ContactoResource::collection(Contacto::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactoRequest $request)
    {
        //
        $request->validated();
        $user = Auth::user();
        $contacto= new Contacto();
        $contacto->nombre=$request->nombre;
        $contacto->apellido=$request->apellido;
        $contacto->telefono=$request->telefono;
        /*if($contacto){
            return new ContactoResource($contacto);
        }*/
        $res = $contacto->save();
        if ($res) {
            return response()->json(['mensaje' => 'Contacto creado exitosamente',], 201);
        }
        return response()->json(['mensaje' => 'Error al crear contacto'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show(Contacto $contacto)
    {
        //
        //$contacto=Contacto::findOrFail($id);
        return  new ContactoResource($contacto);
        //return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacto $contacto)
    {
        //
        Validator::make($request->all(), [
            'nombre' => 'max:70',
            'apellido' => 'max:70',
            'telefono' => 'max:70',
        ])->validate();
        /*if (Auth::id() !== $post->user->id) {
            return response()->json(['message' => 'You don\'t have permissions'], 403);
        }*/

        if (!empty($request->input('nombre'))) {
            $contacto->nombre = $request->input('nombre');
        }
        if (!empty($request->input('apellido'))) {
            $contacto->apellido = $request->input('apellido');
        }
        if (!empty($request->input('telefono'))) {
            $contacto->telefono = $request->input('telefono');
        }

        $res = $contacto->save();

        if ($res) {
            return response()->json(['mensaje' => 'Contacto actualizado exitosamente']);
        }

        return response()->json(['mensaje' => 'Error al actualizar contacto'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
    {
        //
        $res = $contacto->delete();

        if ($res) {
            return response()->json(['mensaje' => 'Contacto eliminado exitosamente']);
        }

        return response()->json(['mensaje' => 'Error al eliminar contacto'], 500);
    }
}
