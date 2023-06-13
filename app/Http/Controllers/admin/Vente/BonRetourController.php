<?php

namespace App\Http\Controllers\admin\Vente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BonRetourController extends Controller
{
    public function ListeBonRetour(){
        $bonRetour = Http::get(app('backendUrl').'/bonretourvente');
        $dataBr = $bonRetour->json();

        return view('admin.vente.retour.bonRetour',compact('dataBr'));
    }

    public function CreateBonRetour(){
        $bonLivraison = Http::get(app('backendUrl').'/getblrv');
        $dataBl = $bonLivraison->json();

        return view('admin.vente.retour.createbonretour',compact('dataBl'));
    } 

    public function ShowBonRetour($id){
        $bonretour = Http::get(app('backendUrl').'/bonretourvente/'.$id);
        $dataBonRetour = $bonretour->json();

        $societe = Http::get(app('backendUrl').'/societe');
        $dataSociete = $societe->json();

        return view('admin.vente.retour.showbonretour',compact('dataBonRetour','dataSociete'));
    }
}
