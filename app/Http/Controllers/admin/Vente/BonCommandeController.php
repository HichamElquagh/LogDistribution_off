<?php

namespace App\Http\Controllers\admin\Vente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BonCommandeController extends Controller
{
    public function ListeBonCommande(){
        
        $bonCommandes = Http::get(app('backendUrl').'/boncommandevente');
        $dataBc = $bonCommandes->json()['data'];
        return view('admin.vente.commande.boncommande',compact('dataBc'));
    }

    public function CreateBonCommande(){
        $clients = Http::get(app('backendUrl').'/client');
        $dataClient = $clients->json();
        
        $articles = Http::get(app('backendUrl').'/articles');
        $dataArticle = $articles->json()['data'];

        return view('admin.vente.commande.createboncommande',compact('dataClient','dataArticle'));
    }

    public function ShowBonCommande($id){
        $boncommande = Http::get(app('backendUrl').'/boncommandevente/'.$id);
        $dataBonCommande = $boncommande->json();

        $societe = Http::get(app('backendUrl').'/societe');
        $dataSociete = $societe->json();

        return view('admin.vente.commande.showboncommande',compact('dataBonCommande','dataSociete'));
    }
}
