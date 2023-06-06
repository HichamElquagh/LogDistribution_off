<?php

namespace App\Http\Controllers\admin;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $responseArticles = Http::get('https://iker.wiicode.tech/api/articles');
        $responseWarehouse = Http::get('https://iker.wiicode.tech/api/warehouse');
        $allArticles = $responseArticles->json();
        $allWarehouses = $responseWarehouse->json();
        
        return view('admin.redirects.Stock.stock' , compact('allArticles','allWarehouses'));

    }
        
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Stock $stock)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Stock $stock)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Stock $stock)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Stock $stock)
    // {
    //     //
    // }
}
