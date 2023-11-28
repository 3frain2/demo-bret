<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Profile extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'description' => $this->description,
            'abilities' => $this->abilities,
            'phone_number' => $this->phone_number,
            'province' => $this->province,
            'contacts_id' => $this->contacts_id,
            'ratings_id' => $this->ratings_id,
            'users_id' => $this->users_id,
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
