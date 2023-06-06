<?php

namespace App\Http\Controllers\admin\Achat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class BonCommandeController extends Controller
{
    public function ListeBonCommande(){
        $bonCommandes = Http::get(app('backendUrl').'/boncommande');
        $dataBc = $bonCommandes->json()['data'];

        return view('admin.achat.commande.boncommande',compact('dataBc'));
    }

    public function CreateBonCommande(){
        $fournisseurs = Http::get(app('backendUrl').'/fournisseurs');
        $dataFournisseur = $fournisseurs->json();
        
        $articles = Http::get(app('backendUrl').'/articles');
        $dataArticle = $articles->json()['data'];

        return view('admin.achat.commande.createboncommande',compact('dataFournisseur','dataArticle'));
    }

    public function ShowBonCommande($id){
        $boncommande = Http::get(app('backendUrl').'/boncommande/'.$id);
        $dataBonCommande = $boncommande->json();

        $societe = Http::get(app('backendUrl').'/societe');
        $dataSociete = $societe->json();

        return view('admin.achat.commande.showboncommande',compact('dataBonCommande','dataSociete'));
    }

}
