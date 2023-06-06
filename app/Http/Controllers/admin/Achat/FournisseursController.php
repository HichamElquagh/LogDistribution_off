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
}
