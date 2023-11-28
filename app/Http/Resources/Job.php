<?php
  
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Job extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this -> id,
            'nameJob' => $this -> nameJob,
            'cost' => $this -> cost,
            'description' => $this -> description,
            'created_at' => $this -> created_at -> format('m/d/Y'),
            'updated_at' => $this -> updated_at -> format('m/d/Y'),
            'categories_id' => $this -> categories_id
        ];
    }
}
