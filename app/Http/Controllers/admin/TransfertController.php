<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class TransfertController extends Controller
{
   public function Index() {

        $responseTransfet = Http::get(app('backendUrl').'/transfert');
        $allTransfert = $responseTransfet->json();
         return view("admin.redirects.Transfert.transfert" , compact('allTransfert'));
    } 

   public function ShowTransfert($id) {
    
      $Transfert = Http::get(app('backendUrl').'/transfert/'.$id);
      $allTransfert = $Transfert->json();

      // return $allTransfert;
      $societe = Http::get(app('backendUrl').'/societe');
      $dataSociete = $societe->json();  
         return view("admin.redirects.Transfert.showtransfert" , compact('allTransfert','dataSociete'));
    } 

   public function CreateTransfert() {
  
         return view("admin.redirects.Transfert.CreateTransfert");
    } 


   
}
