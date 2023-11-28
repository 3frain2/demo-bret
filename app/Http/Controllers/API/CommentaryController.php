<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Commentary;
use App\Http\Resources\Commentary as CommentaryResource;
   
class CommentaryController extends BaseController
{
    public function index()
    {
        $commentaries = Commentary::all();
        return $this->sendResponse(CommentaryResource::collection($commentaries), 'Commentaries encontrados.');
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_emmiter' => 'required',
            'user_receiver' => 'required',
            'commentary' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $commentary = Commentary::create($input);
        return $this->sendResponse(new CommentaryResource($commentary), 'Commentary Creado.');
    }
   
    public function show($id)
    {
        $commentary = Commentary::find($id);
        if (is_null($commentary)) {
            return $this->sendError('Commentary no existe.');
        }
        return $this->sendResponse(new CommentaryResource($commentary), 'Commentary encontrado.');
    }
    
    public function update(Request $request, Commentary $commentary)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_emmiter' => 'required',
            'user_receiver' => 'required',
            'commentary' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $commentary->user_emmiter = $input['user_emmiter'];
        $commentary->user_receiver = $input['user_receiver'];
        $commentary->commentary = $input['commentary'];
        $commentary->save();
        
        return $this->sendResponse(new CommentaryResource($commentary), 'Commentary actualizado.');
    }
   
    public function destroy(Commentary $commentary)
    {
        $commentary->delete();
        return $this->sendResponse([], 'Commentary Borrado.');
    }
}