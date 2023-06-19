<?php

namespace App\Http\Controllers\admin\Achat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class FactureAvoirAchatController extends Controller
{
    public function ListeFactureAvoirAchat(){
        $avoirs = Http::get(app('backendUrl').'/avoirsachat');
        $dataAvoir = $avoirs->json()['data'];

        return view('admin.achat.avoir.listeavoir',compact('dataAvoir'));
    }

    public function CreateFactureAvoirAchat(){
        $bonRetour = Http::get(app('backendUrl').'/getchangebr');
        $dataBr = $bonRetour->json();

        return view('admin.achat.avoir.createavoir',compact('dataBr'));
    }

    public function ShowFactureAvoirAchat($id){
        $factureAvoir = Http::get(app('backendUrl').'/avoirsachat/'.$id);
        $dataFactureAvoir = $factureAvoir->json()['data'];
        
        $societe = Http::get(app('backendUrl').'/societe');
        $dataSociete = $societe->json();

        return view('admin.achat.avoir.showavoir',compact('dataFactureAvoir','dataSociete'));
    }
}
