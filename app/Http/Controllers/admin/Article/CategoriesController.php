<?php

namespace App\Http\Controllers\admin\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function ListeCategorie(){
        $categories = Http::get('https://iker.wiicode.tech/api/categories');
        $dataCategory = $categories->json();

        return view('admin.article.listecategory',compact('dataCategory'));
    }

    public function StoreCategorie(Request $request){

        try {
        
            $validatedData = Validator::make($request->all(),[
                'categoryname' => 'required',
            ],[
                'required' => 'Le champ :attribute est obligatoire.',
            ]);

            $validatedData->setAttributeNames([
                'categoryname' => 'Nom de la categorie',
            ]);

            if($validatedData->fails()){
                return redirect()->back()->with('error', $validatedData->errors()->first());
            }

            $response = Http::post('https://iker.wiicode.tech/api/categories', [
                'category' => $validatedData->validated()['categoryname'],
            ]);
         
                if(!($response->status() == 200)){
                    return redirect()->back()->with('error', 'Une erreur est survenue');
                }
                return redirect()->back()->with('success', 'Categorie créé avec succès !');
                
                
        }catch (\Exception $e){
                return redirect()->back()->with('errorCatch', 'Oops! Une erreur est survenue, veuillez réssayer ultérieurement');
        }
    }

    public function UpdateCategorie(Request $request){
        try {
        
            $validatedData = Validator::make($request->all(),[
                'categoryname' => 'required',
            ],[
                'required' => 'Le champ :attribute est obligatoire.',
            ]);

            $validatedData->setAttributeNames([
                'categoryname' => 'Nom de la categorie',
            ]);

            if($validatedData->fails()){
                return redirect()->back()->with('error', $validatedData->errors()->first());
            }
            
            $response = Http::put('https://iker.wiicode.tech/api/categories/'.$request->catid, [
                'category' => $validatedData->validated()['categoryname'],
            ]);
         
                if(!($response->status() == 200)){
                    return redirect()->back()->with('errorCat', 'Une erreur est survenue');
                }
                return redirect()->back()->with('successCat', 'Categorie modifiée avec succès !');
                
                
        }catch (\Exception $e){
                return redirect()->back()->with('errorCatch', 'Oops! Une erreur est survenue, veuillez réssayer ultérieurement');
        }
    }

    public function deleteCategorie($id)
    {
        try {
            $response = Http::delete('https://iker.wiicode.tech/api/categories/'. $id);

            if ($response->status() == 200) {
                return redirect()->route('adminCategories')->with('successCat', 'Categorie supprimée avec succès !');
            } else {
                return redirect()->back()->with('errorCat', 'Une erreur est survenue lors de la suppression de la categorie');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('errorCatch', 'Oops! Une erreur est survenue, veuillez réessayer ultérieurement');
        }
    }
}

