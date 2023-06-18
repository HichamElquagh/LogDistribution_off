<?php

namespace App\Http\Controllers\admin\Achat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class FournisseursController extends Controller
{
    public function ListeFournisseur(){
        return view('admin.achat.fournisseur');
    }
    public function detailFournisseur($id){

        $detailFournisseurs = Http::get(app('backendUrl').'/fournisseurs/'. $id);
        $detailFournisseur =  $detailFournisseurs->json();
        // return $detailFournisseur;

        return view('admin.achat.showfournisseur', compact('detailFournisseur'));
    }
}
