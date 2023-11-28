<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Profile;
use App\Http\Resources\Profile as ProfileResource;

class ProfileController extends BaseController
{
    public function index()
    {
        $profiles = Profile::all();
        return $this->sendResponse(ProfileResource::collection($profiles), 'Profiles encontrados.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'image' => 'required',
            'name' => 'required',
            'description',
            'abilities',
            'phone_number',
            'province',
            'contacts_id',
            'ratings_id',
            'users_id' => 'required',

        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $profile = Profile::create($input);
        return $this->sendResponse(new ProfileResource($profile), 'Profile Creado.');
    }

    public function show($users_id)
    {
        $profile = Profile::where('users_id', $users_id)->first();
        if (is_null($profile)) {
            return $this->sendError('Profile no existe.');
        }
        return $this->sendResponse(new ProfileResource($profile), 'Profile encontrado.');
    }

    public function show_id($idProfile)
    {
        $profile = Profile::where('id', $idProfile)->first();
        if (is_null($profile)) {
            return $this->sendError('Category no existe.');
        }
        return $this->sendResponse(new ProfileResource($profile), 'Category encontrado.');
    }

    public function update(Request $request, $id)
    {
        /*
        $input = $request->all();
        $validator = Validator::make($input, [
            'image' => 'required',
            'name' => 'required',
            'phone_number',
            'province',
            'contacts_id',
            'ratings_id',
            'users_id' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        */
        $profile = Profile::find($id);
        $profile->image = $request['image'];
        $profile->name = $request['name'];
        $profile->description = $request['description'];
        $profile->abilities = $request['abilities'];
        $profile->phone_number = $request['phone_number'];
        $profile->province = $request['province'];
        $profile->save();

        return $this->sendResponse(new ProfileResource($profile), 'Profile actualizado.');
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return $this->sendResponse([], 'Profile Borrado.');
    }
}
