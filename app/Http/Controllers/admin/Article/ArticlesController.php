<?php

namespace App\Http\Controllers\admin\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{
    public function ListeArticle(){

        $categories = Http::get('https://iker.wiicode.tech/api/categories');
        $dataCategory = $categories->json();
        $fournisseurs = Http::get('https://iker.wiicode.tech/api/fournisseurs');
        $dataFournisseurs = $fournisseurs->json();

        return view('admin.article.listearticle',compact('dataCategory','dataFournisseurs'));
    }

    public function StoreArticle(Request $request){

        try {
        
            $validatedData = Validator::make($request->all(),[
                'articlelibelle' => 'required',
                'articleReference' => 'required|numeric',
                'articlepu' => 'required|numeric',
                'articlepp' => 'required|numeric',
                'articlecf' => 'numeric',
                'articlesg' => 'numeric',
                'articleunite' => 'string',
                'articlecategory' => 'required|integer',
                'articlealert' => 'required|integer',
            ],[
                'required' => 'Le champ :attribute est obligatoire.',
                'string' => 'Le champ :attribute doit être une chaîne de caractères.',
                'numeric' => 'Le champ :attribute doit être un nombre.',
                'integer' => 'Le champ :attribute doit être un entier.',
            ]);

            $validatedData->setAttributeNames([
                'articlelibelle' => 'Libellé de l\'article',
                'articleReference' => 'Référence de l\'article',
                'articlepu' => 'Prix unitaire de l\'article',
                'articlepp' => 'Prix public de l\'article',
                'articlecf' => 'Client fidèle de l\'article',
                'articlesg' => 'Demi-grossiste de l\'article',
                'articleunite' => 'Unité de l\'article',
                'articlecategory' => 'Catégorie de l\'article',
                'articlealert' => 'Alerte de stock de l\'article',
            ]);

            if($validatedData->fails()){
                return redirect()->back()->with('error', $validatedData->errors()->first());
            }

            $response = Http::post('https://iker.wiicode.tech/api/articles', [
                'article_libelle' => $validatedData->validated()['articlelibelle'],
                'reference' => $validatedData->validated()['articleReference'],
                'prix_unitaire' => $validatedData->validated()['articlepu'],
                'prix_public' => $validatedData->validated()['articlepp'],
                'client_Fedele' => $validatedData->validated()['articlecf'],
                'demi_grossiste' => $validatedData->validated()['articlesg'],
                'unite' => $validatedData->validated()['articleunite'],
                'category_id' => $validatedData->validated()['articlecategory'],
                'alert_stock' => $validatedData->validated()['articlealert'],
            ]);
         
                if(!($response->status() == 200)){
                    return redirect()->back()->with('error', 'Une erreur est survenue');
                }
                return redirect()->back()->with('success', 'Article créé avec succès !');
                
                
        }catch (\Exception $e){
                return redirect()->back()->with('errorCatch', 'Oops! Une erreur est survenue, veuillez réssayer ultérieurement');
        }
    }

    public function EditArticle($id){

        $article = Http::get('https://iker.wiicode.tech/api/articles/'.$id);
        $dataArticle = $article->json()['Article Requested'];

        $categories = Http::get('https://iker.wiicode.tech/api/categories');
        $dataCategory = $categories->json();

        return view('admin.article.editarticle',compact('dataArticle','dataCategory'));
    }

    public function UpdateArticle(Request $request, $id)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'articlelibelle' => 'required',
                'articleReference' => 'required|numeric',
                'articlepu' => 'required|numeric',
                'articlepp' => 'required|numeric',
                'articlecf' => 'numeric',
                'articlesg' => 'numeric',
                'articleunite' => 'string',
                'articlecategory' => 'required|integer',
                'articlealert' => 'required|integer',
            ], [
                'required' => 'Le champ :attribute est obligatoire.',
                'string' => 'Le champ :attribute doit être une chaîne de caractères.',
                'numeric' => 'Le champ :attribute doit être un nombre.',
                'integer' => 'Le champ :attribute doit être un entier.',
            ]);

            $validatedData->setAttributeNames([
                'articlelibelle' => 'Libellé de l\'article',
                'articleReference' => 'Référence de l\'article',
                'articlepu' => 'Prix unitaire de l\'article',
                'articlepp' => 'Prix public de l\'article',
                'articlecf' => 'Client fidèle de l\'article',
                'articlesg' => 'Demi-grossiste de l\'article',
                'articleunite' => 'Unité de l\'article',
                'articlecategory' => 'Catégorie de l\'article',
                'articlealert' => 'Alerte de stock de l\'article',
            ]);

            if ($validatedData->fails()) {
                return redirect()->back()->with('error', $validatedData->errors()->first());
            }

            $response = Http::put('https://iker.wiicode.tech/api/articles/'. $id, [
                'article_libelle' => $validatedData->validated()['articlelibelle'],
                'reference' => $validatedData->validated()['articleReference'],
                'prix_unitaire' => $validatedData->validated()['articlepu'],
                'prix_public' => $validatedData->validated()['articlepp'],
                'client_Fedele' => $validatedData->validated()['articlecf'],
                'demi_grossiste' => $validatedData->validated()['articlesg'],
                'unite' => $validatedData->validated()['articleunite'],
                'category_id' => $validatedData->validated()['articlecategory'],
                'alert_stock' => $validatedData->validated()['articlealert'],
            ]);

            if (!($response->status() == 200)) {
                return redirect()->back()->with('error', 'Une erreur est survenue');
            }

            return redirect()->back()->with('success', 'Article modifié avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorCatch', 'Oops! Une erreur est survenue, veuillez réessayer ultérieurement');
        }
    }

    public function deleteArticle($id)
    {
        try {
            $response = Http::delete('https://iker.wiicode.tech/api/articles/'. $id);

            if ($response->status() == 200) {
                return redirect()->route('adminArticles')->with('success', 'Article supprimé avec succès !');
            } else {
                return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression de l\'article');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('errorCatch', 'Oops! Une erreur est survenue, veuillez réessayer ultérieurement');
        }
    }

}
    