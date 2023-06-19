<?php

namespace App\Http\Controllers\admin\Vente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    public function ListeClient(){

        return view('admin.vente.client');
    }
    public function ShowClient(){

        return view('admin.vente.showclient');
    }
}
