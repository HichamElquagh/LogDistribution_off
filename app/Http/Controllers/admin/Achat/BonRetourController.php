<?php

namespace App\Http\Controllers\admin\Achat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BonRetourController extends Controller
{
    public function ListeBonRetour(){
        $bonRetour = Http::get(app('backendUrl').'/bonretourachat');
        $dataBr = $bonRetour->json();

        return view('admin.achat.retour.bonRetour',compact('dataBr'));
    }

    public function CreateBonRetour(){
        $bonLivraison = Http::get(app('backendUrl').'/getblr');
        $dataBl = $bonLivraison->json();

        return view('admin.achat.retour.createbonretour',compact('dataBl'));
    }   
}
