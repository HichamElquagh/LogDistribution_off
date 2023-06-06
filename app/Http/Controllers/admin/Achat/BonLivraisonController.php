<?php

namespace App\Http\Controllers\admin\Achat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BonLivraisonController extends Controller
{
    public function ListeBonLivraison(){
        $bonLivraison = Http::get(app('backendUrl').'/bonlivraison');
        $dataBl = $bonLivraison->json()['data'];

        return view('admin.achat.livraison.bonlivraison',compact('dataBl'));
    }

    public function CreateBonLivraison(){
        $bonCommandes = Http::get(app('backendUrl').'/getbc');
        $dataBc = $bonCommandes->json();

        return view('admin.achat.livraison.createbonlivraison',compact('dataBc'));
    }

    public function ShowBonLivraison($id){
        $bonlivraison = Http::get(app('backendUrl').'/bonlivraison/'.$id);
        $dataBonLivraison = $bonlivraison->json();

        $societe = Http::get(app('backendUrl').'/societe');
        $dataSociete = $societe->json();

        return view('admin.achat.Livraison.showbonlivraison',compact('dataBonLivraison','dataSociete'));
    }
}
