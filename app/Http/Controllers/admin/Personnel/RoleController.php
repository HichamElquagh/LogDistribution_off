<?php

namespace App\Http\Controllers\admin\Personnel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function Index(){

        return view('admin.personnel.role');

}
}
