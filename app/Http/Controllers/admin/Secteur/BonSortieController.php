<?php

namespace App\Http\Controllers\admin\Secteur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BonSortieController extends Controller
{
    public function listeBonSortie(){
        $bonSorties = Http::get(app('backendUrl').'/bonsortie');
        $dataBs = $bonSorties->json();

        return view('admin.secteur.sortie.bonsortie',compact('dataBs'));
    }

    public function CreateBonSortie(){
        $secteurs = Http::get(app('backendUrl').'/secteur');
        $datasecteur = $secteurs->json();

        return view('admin.secteur.sortie.createbonsortie',compact('datasecteur'));
    }

    public function ShowBonSortie($id){
        $bonsortie = Http::get(app('backendUrl').'/bonsortie/'.$id);
        $dataBonSortie = $bonsortie->json();

        $societe = Http::get(app('backendUrl').'/societe');
        $dataSociete = $societe->json();

        return view('admin.secteur.sortie.showbonsortie',compact('dataBonSortie','dataSociete'));
    }
}
