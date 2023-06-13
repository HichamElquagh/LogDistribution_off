<?php

namespace App\Http\Controllers\admin\Secteur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BonSecteurController extends Controller
{
    public function listeBonSecteur(){
        $bonSecteurs = Http::get(app('backendUrl').'/ventesecteur');
        $dataBonSecteur = $bonSecteurs->json();

        return view('admin.secteur.vente.bonsecteur',compact('dataBonSecteur'));
    }

    public function createBonSecteur(){
        $bonSorties = Http::get(app('backendUrl').'/getbs');
        $dataBs = $bonSorties->json();

        return view('admin.secteur.vente.createbonsecteur',compact('dataBs'));
    }

    public function ShowBonSecteur($id){
        $bonSecteur = Http::get(app('backendUrl').'/ventesecteur/'.$id);
        $bsc = $bonSecteur->json()['data'];

        $societe = Http::get(app('backendUrl').'/societe');
        $dataSociete = $societe->json();

        return view('admin.secteur.vente.showbonsecteur',compact('bsc','dataSociete'));
    }
}

