<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class TransfertController extends Controller
{
    function Index() {

        $responseArticles = Http::get(app('backendUrl').'/');
        $allArticles = $responseArticles->json();
         return view("admin.redirects.Transfert.transfert");
    } 
}
