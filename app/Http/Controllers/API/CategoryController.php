<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Category;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends BaseController
{
    public function index()
    {
        $categories = Category::all();
        return $this->sendResponse(CategoryResource::collection($categories), 'Categories encontrados.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nameCategory' => 'required',
            'image' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $category = Category::create($input);
        return $this->sendResponse(new CategoryResource($category), 'Category Creado.');
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return $this->sendError('Category no existe.');
        }
        return $this->sendResponse(new CategoryResource($category), 'Category encontrado.');
    }

    public function show_id($nameCategory)
    {
        $category = Category::where('nameCategory', $nameCategory)->first();
        if (is_null($category)) {
            return $this->sendError('Category no existe.');
        }
        return $this->sendResponse(new CategoryResource($category), 'Category encontrado.');
    }

    public function update(Request $request, Category $category)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nameCategory' => 'required',
            'image' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $category->nameCategory = $input['nameCategory'];
        $category->image = $input['image'];
        $category->save();

        return $this->sendResponse(new CategoryResource($category), 'Category actualizado.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->sendResponse([], 'Category Borrada.');
    }
}
