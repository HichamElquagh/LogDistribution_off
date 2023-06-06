<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CaisseController extends Controller
{
    //
    public function Index(){


        $responseJournals = Http::get('https://iker.wiicode.tech/api/journal');
        $allJournals = $responseJournals->json();
           return view('admin.redirects.Caisse.caisse' , compact('allJournals'));
    }
}
