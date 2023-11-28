<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Contact;
use App\Http\Resources\Contact as ContactResource;
   
class ContactController extends BaseController
{
    public function index()
    {
        $contacts = Contact::all();
        return $this->sendResponse(ContactResource::collection($contacts), 'Contacts encontrados.');
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'info' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $contact = Contact::create($input);
        return $this->sendResponse(new ContactResource($contact), 'Contact Creado.');
    }
   
    public function show($id)
    {
        $contact = Contact::find($id);
        if (is_null($contact)) {
            return $this->sendError('Contact no existe.');
        }
        return $this->sendResponse(new ContactResource($contact), 'Contact encontrado.');
    }
    
    public function update(Request $request, Contact $contact)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'info' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $contact->info = $input['info'];
        $contact->save();
        
        return $this->sendResponse(new ContactResource($contact), 'Contact actualizado.');
    }
   
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $this->sendResponse([], 'Contact Borrado.');
    }
}