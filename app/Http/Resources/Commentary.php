<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Commentary extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this -> id,
            'user_emmiter' => $this -> user_emmiter,
            'user_receiver' => $this -> user_receiver,
            'description' => $this -> description,
            'created_at' => $this -> created_at -> format('m/d/Y'),
            'updated_at' => $this -> updated_at -> format('m/d/Y'),
        ];
    }
}
