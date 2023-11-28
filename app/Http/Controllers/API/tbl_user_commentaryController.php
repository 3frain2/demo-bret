<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Tbl_user_commentary;
use App\Http\Resources\Tbl_user_commentary as Tbl_user_commentaryResource;
   
class Tbl_user_commentaryController extends BaseController
{
    public function index()
    {
        $tbl_user_commentaries = Tbl_user_commentary::all();
        return $this->sendResponse(Tbl_user_commentaryResource::collection($tbl_user_commentaries), 'Users-Commentaries encontrados.');
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'profiles_id' => 'required',
            'commentaries_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $tbl_user_commentary = Tbl_user_commentary::create($input);
        return $this->sendResponse(new Tbl_user_commentaryResource($tbl_user_commentary), 'User-Commentary Creado.');
    }
   
    public function show($id)
    {
        $tbl_user_commentary = Tbl_user_commentary::find($id);
        if (is_null($tbl_user_commentary)) {
            return $this->sendError('User-Commentary no existe.');
        }
        return $this->sendResponse(new Tbl_user_commentaryResource($tbl_user_commentary), 'User-Commentary encontrado.');
    }
    
    public function update(Request $request, Tbl_user_commentary $tbl_user_commentary)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'profiles_id' => 'required',
            'commentaries_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $tbl_user_commentary->profiles_id = $input['profiles_id'];
        $tbl_user_commentary->commentaries_id = $input['commentaries_id'];
        $tbl_user_commentary->save();
        
        return $this->sendResponse(new Tbl_user_commentaryResource($tbl_user_commentary), 'User-Commentary actualizado.');
    }
   
    public function destroy(Tbl_user_commentary $tbl_user_commentary)
    {
        $tbl_user_commentary->delete();
        return $this->sendResponse([], 'User-Commentary Borrado.');
    }
}