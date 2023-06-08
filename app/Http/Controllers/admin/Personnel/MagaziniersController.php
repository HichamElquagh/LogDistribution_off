<?php

namespace App\Http\Controllers\admin\Personnel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class MagaziniersController extends Controller
{
    public function ListeMagazinier(){

        $magaziniers = Http::get(app('backendUrl').'/employee'); 
        $dataMagazinier = collect($magaziniers->json()['data']);

        $SoloMagaziniers = $dataMagazinier->filter(function ($magazinier) {
            return $magazinier['role_name'] === 'magazinier';
        });
        return view('admin.personnel.magazinier',compact('SoloMagaziniers'));
    }
}
