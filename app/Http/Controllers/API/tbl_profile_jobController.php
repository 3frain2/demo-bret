<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Tbl_profile_job;
use App\Http\Resources\Tbl_profile_job as Tbl_profile_jobResource;

class Tbl_profile_jobController extends BaseController
{
    public function index()
    {
        $tbl_profile_jobs = Tbl_profile_job::all();
        return $this->sendResponse(Tbl_profile_jobResource::collection($tbl_profile_jobs), 'Profiles-Jobs encontrado.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'profiles_id' => 'required',
            'jobs_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $tbl_profile_job = Tbl_profile_job::create($input);
        return $this->sendResponse(new Tbl_profile_jobResource($tbl_profile_job), 'Profile-Job Creado.');
    }

    public function show($profiles_id)
    {
        $tbl_profile_jobs = Tbl_profile_job::all()->where('profiles_id', $profiles_id);
        return $this->sendResponse(Tbl_profile_jobResource::collection($tbl_profile_jobs), 'Profiles-Jobs encontrado.');
    }

    public function show_id($idJob)
    {
        $tbl_profile_jobs = Tbl_profile_job::where('jobs_id', $idJob)->first();
        if (is_null($tbl_profile_jobs)) {
            return $this->sendError('Category no existe.');
        }
        return $this->sendResponse(new Tbl_profile_jobResource($tbl_profile_jobs), 'Category encontrado.');
    }

    public function update(Request $request, Tbl_profile_job $tbl_profile_job)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'profiles_id' => 'required',
            'jobs_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $tbl_profile_job->profiles_id = $input['profiles_id'];
        $tbl_profile_job->jobs_id = $input['jobs_id'];
        $tbl_profile_job->save();

        return $this->sendResponse(new Tbl_profile_jobResource($tbl_profile_job), 'Profile-Job actualizado.');
    }

    public function destroy($jobs_id)
    {
        $tbl_profile_job = Tbl_profile_job::all()->where('jobs_id', $jobs_id);
        $tbl_profile_job->each->delete();
        return $this->sendResponse([], 'Jobs_Id Borrado.');
    }
}
