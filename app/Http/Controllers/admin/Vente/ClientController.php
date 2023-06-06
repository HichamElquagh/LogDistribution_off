<?php

namespace App\Http\Controllers\admin\Vente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    public function ListeClient(){

        $Clients = Http::get('https://iker.wiicode.tech/api/client');
        $dataClient = $Clients->json();

        return view('admin.vente.client',compact('dataClient'));
    }
}
