<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArchivoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'idtipoarchivo' => $this->idtipoarchivo,
            'nombre' => $this->nombre,
            'idmilitante' => $this->idmilitante,
            'url' => $this->url,
            'extension' => $this->extension,
            'tamaño' => $this->tamaño,
            'estado' => $this->estado,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
