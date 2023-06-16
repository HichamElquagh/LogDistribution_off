<?php

namespace App\Http\Controllers\admin\Secteur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class SecteurController extends Controller
{
    //
     public function Index()
    {
        $responseWarehouse = Http::get(app('backendUrl').'/warehouse');
        $allWarehouses = $responseWarehouse->json();
        return view('admin.vente.secteur' , compact('allWarehouses'));
    }
}
