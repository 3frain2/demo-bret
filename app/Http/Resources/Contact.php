<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this -> id,
            'info' => $this -> info,
            'created_at' => $this -> created_at -> format('m/d/Y'),
            'updated_at' => $this -> updated_at -> format('m/d/Y'),
        ];
    } 
}
