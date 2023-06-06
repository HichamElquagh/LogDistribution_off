<?php

namespace App\Http\Controllers\admin\Achat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function Index(){
        return view('admin.achat.paiement');
    }
}
