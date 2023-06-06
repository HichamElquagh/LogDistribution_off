<?php

namespace App\Http\Controllers\admin\Secteur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendeurController extends Controller
{
    public function ListeVendeur(){
        return view('admin.secteur.vendeur');
    }
}
