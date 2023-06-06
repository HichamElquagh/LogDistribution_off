<?php

namespace App\Http\Controllers\admin\Vente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function Index(){
        return view('admin.vente.paiement');
    }
}
