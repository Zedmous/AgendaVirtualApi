<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        /*return [
            'id'=> $this->id,
            'nombre'=> $this->nombre,
            'apellido'=> $this->apellido,
            'telefono'=> $this->telefono
        ];*/
    }
}
