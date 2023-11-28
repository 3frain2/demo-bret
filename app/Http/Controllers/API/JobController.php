<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Job;
use App\Http\Resources\Job as JobResource;

class JobController extends BaseController
{
    public function index()
    {
        $jobs = Job::all();
        return $this->sendResponse(JobResource::collection($jobs), 'Jobs encontrados.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nameJob' => 'required',
            'cost' => 'required',
            'description' => 'required',
            'categories_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $job = Job::create($input);
        return $this->sendResponse(new JobResource($job), 'Job Creado.');
    }

    public function show($id)
    {
        $job = Job::find($id);
        if (is_null($job)) {
            return $this->sendError('Job no existe.');
        }
        return $this->sendResponse(new JobResource($job), 'Job encontrado.');
    }

    public function update(Request $request, $id)
    {

        $job = Job::find($id);

        /*
        $input = $request->all();
        $validator = Validator::make($input, [
            'nameJob' => 'required',
            'cost' => 'required',
            'description' => 'required',
            'categories_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        */
        $job->nameJob = $request['nameJob'];
        $job->cost = $request['cost'];
        $job->description = $request['description'];
        $job->categories_id = $request['categories_id'];
        $job->save();

        return $this->sendResponse(new JobResource($job), 'Job actualizado.');
    }

    public function destroy($id)
    {
        $job = Job::all()->where('id', $id);
        $job->each->delete();
        return $this->sendResponse([], 'Job Borrado.');
    }

    public function categoryJob($id){
        $jobs = Job::all()->where('categories_id', $id);
        return $this->sendResponse(JobResource::collection($jobs), 'Jobs encontrados.');
    }

    public function costJob($costMin, $costMax){
        $jobs = Job::whereBetween('cost', [$costMin, $costMax])->get();
        return $this->sendResponse(JobResource::collection($jobs), 'Jobs encontrados.');
    }
    public function filterJobName($letter){
        $jobs = Job::where('nameJob', 'LIKE', '%' . $letter . '%')->get();
        return $this->sendResponse(JobResource::collection($jobs), 'Jobs filtrados.');
    }
}
