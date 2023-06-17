<?php

namespace App\Http\Controllers\admin\Achat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BonChangeController extends Controller
{
    public function CreateBonChange(){
        $bonRetour = Http::get(app('backendUrl').'/getchangebr');
        $dataBr = $bonRetour->json();

        return view('admin.achat.change.createbonchange',compact('dataBr'));
    }
}
