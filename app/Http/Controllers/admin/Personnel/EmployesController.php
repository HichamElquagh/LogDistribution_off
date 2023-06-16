<?php

namespace App\Http\Controllers\admin\Personnel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class EmployesController extends Controller
{
    public function ListeEmploye(){
        
        $employes = Http::get(app('backendUrl').'/employee');
        $dataEmploye = collect($employes->json()['data']);

        // $SoloEmploye = $dataEmploye->filter(function ($employe) {
        //     return $employe['role_name'] != 'Magazinier';
        // });

        $roles = Http::get(app('backendUrl').'/emprole');
        $dataRole = collect($roles->json());

        // $SoloRole = $dataRole->filter(function ($role) {
        //     return $role['role_name'] != 'Magazinier';
        // });

        return view('admin.personnel.employe',compact('dataEmploye','dataRole'));
    }
}
