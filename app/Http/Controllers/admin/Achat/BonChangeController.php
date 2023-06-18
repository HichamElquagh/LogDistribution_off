<?php

namespace App\Http\Controllers\admin\Achat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BonChangeController extends Controller
{
    public function CreateBonChange(){
        $bonRetour = Http::get(app('backendUrl').'/getchangebr');
        $dataBr = $bonRetour->json();

        return view('admin.achat.livraison-change.createbonchange',compact('dataBr'));
    }

    public function ShowBonChange($id){
        $bonchange = Http::get(app('backendUrl').'/bonlivraison/'.$id);
        $dataBonChange = $bonchange->json();

        $societe = Http::get(app('backendUrl').'/societe');
        $dataSociete = $societe->json();

        return view('admin.achat.livraison-change.showbonchange',compact('dataBonChange','dataSociete'));
    }
}
