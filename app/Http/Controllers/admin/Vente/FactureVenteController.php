<?php

namespace App\Http\Controllers\admin\Vente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class FactureVenteController extends Controller
{
    public function ListeFactureVente(){
        $factures = Http::get(app('backendUrl').'/facturevente');
        $dataFacture = $factures->json();

        return view('admin.vente.facture.listefacture',compact('dataFacture'));
    }

    public function CreateFactureVente(){
        $bonLivraisons = Http::get(app('backendUrl').'/getblv');
        $dataBl = $bonLivraisons->json();

        return view('admin.vente.facture.createfacture',compact('dataBl'));
    }

    public function ShowFacture($id){
        $facture = Http::get(app('backendUrl').'/facturevente/'.$id);
        $dataFacturee = $facture->json();
        
        $societe = Http::get(app('backendUrl').'/societe');
        $dataSociete = $societe->json();

        return view('admin.vente.facture.showfacture',compact('dataFacturee','dataSociete'));
    }
}
