<?php

namespace App\Http\Controllers\admin\Achat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class FactureAchatChangeController extends Controller
{
    public function CreateFactureAchatChange(){
        $bonChange = Http::get(app('backendUrl').'/getblcf');
        $dataBc = $bonChange->json();

        return view('admin.achat.facture-change.createfacturechange',compact('dataBc'));
    }

    public function ShowFactureAchatChange($id){
        $factureChange = Http::get(app('backendUrl').'/facture/'.$id);
        $dataFactureChange = $factureChange->json()['data'];
        
        $societe = Http::get(app('backendUrl').'/societe');
        $dataSociete = $societe->json();

        return view('admin.achat.facture-change.showfacturechange',compact('dataFactureChange','dataSociete'));
    }
}
