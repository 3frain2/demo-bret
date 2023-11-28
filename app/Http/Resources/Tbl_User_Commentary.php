<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Tbl_User_Commentary extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'profiles_id' => $this->profiles_id,
            'commentaries_id' => $this->commentaries_id,
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
