<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Tbl_Profile_Job extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'profiles_id' => $this->profiles_id,
            'jobs_id' => $this->jobs_id,
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
