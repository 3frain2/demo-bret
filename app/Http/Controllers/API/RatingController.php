<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Rating;
use App\Http\Resources\Rating as RatingResource;
   
class RatingController extends BaseController
{
    public function index()
    {
        $ratings = Rating::all();
        return $this->sendResponse(RatingResource::collection($ratings), 'Ratings encontrados.');
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'calification' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $rating = Rating::create($input);
        return $this->sendResponse(new RatingResource($rating), 'Rating Creado.');
    }
   
    public function show($id)
    {
        $rating = Rating::find($id);
        if (is_null($rating)) {
            return $this->sendError('Rating no existe.');
        }
        return $this->sendResponse(new RatingResource($rating), 'Rating encontrado.');
    }
    
    public function update(Request $request, Rating $rating)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'calification' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $rating->calification = $input['calification'];
        $rating->save();
        
        return $this->sendResponse(new RatingResource($rating), 'Rating actualizado.');
    }
   
    public function destroy(Rating $rating)
    {
        $rating->delete();
        return $this->sendResponse([], 'Rating Borrado.');
    }
}