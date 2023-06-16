<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class DashboardController extends Controller
{
    public function Index(){
        
      $fournisseurcount = Http::get(app('backendUrl').'/fournisseur-count')->json();
           $clientcount = Http::get(app('backendUrl').'/client-count')->json();
           $commandecount = Http::get(app('backendUrl').'/commande-count')->json();
           $achatpayer = Http::get(app('backendUrl').'/achat-payer')->json();
           $revenue = Http::get(app('backendUrl').'/revenue')->json();
         $ventetotal = Http::get(app('backendUrl').'/vente-total')->json();
      $chequeretard = Http::get(app('backendUrl').'/cheque-retard')->json();
        
        
        return view('admin.dashboard', compact('fournisseurcount','clientcount','commandecount','achatpayer','revenue','ventetotal','chequeretard'));
    }
}