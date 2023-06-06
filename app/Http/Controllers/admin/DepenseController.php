<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class DepenseController extends Controller
{
    public function Index(){

        return view('admin.redirects.depense.depense');
    }
    }

    // public function Storedepense(Request $request){

    //      try {


    //             $response = Http::post('https://iker.wiicode.tech/api/depense', [
    //                 'depense' => $request->input('depense'),
    //                 'depense_Tax' => $request->input('depense_Tax')

    //             ]);


    //             if(!($response->status() == 200)){
    //                 return redirect()->back()->with('error', 'Une erreur est survenue');
    //             }
    //             return redirect()->back()->with('success', 'Depense créé avec succès !');


    //     }catch (\Exception $e){
    //             return redirect()->back()->with('errorCatch', 'Oops! Une erreur est survenue, veuillez réssayer ultérieurement');
    //     }
    // }




    // public function EditDepense($id){

    //     $response = Http::get('https://iker.wiicode.tech/api/depense/'.$id);
    //     $data = $response->json();


    //     return view('admin.redirects.Depense.DepenseEdit',compact('data'));
    // }

    // public function updateDepense(Request $request){
    //       try {



    //         $response = Http::put('https://iker.wiicode.tech/api/depense/'.$request->DepenseId, [
    //             'depense' => $request->input('depense'),
    //             'depense_Tax' => $request->input('depense_Tax')
    //         ]);



    //             if(!($response->status() == 200)){
    //                 return redirect()->back()->with('errorCat', 'Une erreur est survenue');
    //             }
    //             return redirect()->back()->with('successCat', 'Depense mise a joure avec succès !');


    //      }catch (\Exception $e){
    //             return redirect()->back()->with('errorCatch', 'Oops! Une erreur est survenue, veuillez réssayer ultérieurement');
    //     }
    // }

    // public function Deletedepense($id)
    // {
    //     try {
    //         $response = Http::delete('https://iker.wiicode.tech/api/depense/'. $id);

    //         if ($response->status() == 200) {
    //             return redirect()->route('admindepense')->with('successCat', 'Depense supprimée avec succès !');
    //         } else {
    //             return redirect()->back()->with('errorCat', 'Une erreur est survenue lors de la suppression de la Depense');
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('errorCatch', 'Oops! Une erreur est survenue, veuillez réessayer ultérieurement');
    //     }
    // }
    // }
