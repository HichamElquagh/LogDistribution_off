<?php

namespace App\Http\Controllers\admin\Achat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class FactureAchatController extends Controller
{
    public function ListeFactureAchat(){
        $factures = Http::get(app('backendUrl').'/facture');
        $dataFacture = $factures->json()['data'];

        return view('admin.achat.facture.listefacture',compact('dataFacture'));
    }

    public function CreateFactureAchat(){
        $bonLivraisons = Http::get(app('backendUrl').'/getblf');
        $dataBl = $bonLivraisons->json();

        return view('admin.achat.facture.createfacture',compact('dataBl'));
    }

    public function ShowFacture($id){
        $facture = Http::get(app('backendUrl').'/facture/'.$id);
        $dataFacturee = $facture->json()['data'];
        
        $societe = Http::get(app('backendUrl').'/societe');
        $dataSociete = $societe->json();

        return view('admin.achat.facture.showfacture',compact('dataFacturee','dataSociete'));
    }
}
