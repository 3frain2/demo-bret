<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this -> id,
            'nameCategory' => $this -> nameCategory,
            'image' => $this -> image,
            'created_at' => $this -> created_at -> format('m/d/Y'),
            'updated_at' => $this -> updated_at -> format('m/d/Y'),
        ];
    }
}
