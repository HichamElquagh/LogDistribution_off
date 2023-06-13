@extends('admin.layouts.template')

@section('page-title')
    Transfert | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Transfert</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Transfert</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-xl-9 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-xl-row flex-sm-row flex-column m-sm-3 m-0">
                            <div class="mb-xl-0 mb-4">
                                <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                                    <img src="{{ asset('backend/assets/images/logos/logo-light.png')}}" alt="" style="width: 200px">
                                </div>
                                @foreach($dataSociete as $societe)
                                    <p class="mb-2">{{$societe['adresse']}}</p>
                                    <p class="mb-2">{{$societe['email']}}</p>
                                    <p class="mb-2"><span class="fw-bold">Tel: </span>{{$societe['telephone']}}</p>
                                    <p class="mb-0"><span class="fw-bold">Fax: </span>{{$societe['fax']}}</p>
                                @endforeach
                            </div>
                            <div>
                                <h4 class="fw-semibold mb-2">Reference {{$allTransfert['reference']}}</h4>
                                <div class="mb-4 pt-1 d-flex">
                                    <span class="pe-2">Date: </span>
                                    <span class="fw-semibold pe-3">
                                        {{\Carbon\Carbon::parse($allTransfert['dateTransfert'])->isoFormat("LL") }}
                                    </span>
                                    <span class="statut-dispo d-flex align-items-center badge text-white">

                                    </span>
                                </div>
                                <div class="">
                                    {{-- @php
                                        $client = Http::get(app('backendUrl').'/client/'.$allTransfert['client_id']);
                                        $dataClient = $client->json()['client'];
                                    @endphp --}}
                                    <h6 class="mb-2">Livrer par: {{ $allTransfert['nom_employee'] }}</h6>
                                   <h6 class="mb-2">Camion: <span>{{ $allTransfert['marque'] }}</span></h6>
                                   <h6 class="mb-2">Matricule: <span>{{ $allTransfert['matricule'] }}</span></h6>
                                   <h6 class="mb-0">Modele: <span>{{ $allTransfert['modele'] }}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive border-top mt-4">
                        <table class="table m-0 text-center">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Article</th>
                                    <th>Quantité</th>
                                    <th>P.U</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allTransfert['Articles'] as $article)
                                    <tr>
                                        <td class="text-nowrap" width="300">{{$article['reference']}}</td>
                                        <td class="text-nowrap" width="600">{{$article['article_libelle']}}</td>
                                        <td width="200">{{$article['Quantity']}}</td>
                                        <td width="200">{{$article['unite']}}</td>
                                        {{-- <td>{{$article['Total_HT']}}</td> --}}
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="align-top px-4 py-4">
                                        <p class=" text-start mb-2 mt-3">
                                            <span class="ms-3 fw-bold">Créé par:</span>
                                            <span>Alfie Solomons</span>
                                        </p>
                                        <div class="text-center">
                                            <p class="mb-2 fs-bold">
                                                <span class="fw-bold">Envoyé de l'entrepôt :</span>
                                                <span class="text-info">{{ $allTransfert['warehouseTo'] }}</span>
                                            </p>
                                            <p class="mb-3 fs-bold">
                                                <span class="fw-bold">À L'entrepôt :</span>
                                                <span class="text-info">{{ $allTransfert['warehousesFrom'] }}</span>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                
                                
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body mx-3">
                        <div class="row">
                            <div class="col-12 text-center">
                                <span class="fw-bold">Note:</span>
                                {{-- <span>{{$allTransfert['Commentaire']}}</span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Actions
                        {{-- <a href="{{ route('listeCommandeVente') }}" class="btn btn-outline-secondary btn-sm" type="submit"> --}}
                            <i class="ri-arrow-go-back-line"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div id="accordionImprimer" class="custom-accordion">
                            <div class="card mb-1 shadow-none">
                                <a href="#collapseOne" class="text-dark collapsed" data-bs-toggle="collapse"
                                                aria-expanded="false"
                                                aria-controls="collapseOne">
                                    <div class="card-header bg-warning mb-2" id="headingOne">
                                        <h6 class="m-0 text-white">
                                            Imprimer
                                            <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                        </h6>
                                    </div>
                                </a>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-bs-parent="#accordion">
                                    <div class="card-body py-0">
                                        <button class="btn btn-outline-primary fw-bold col-12 mb-2 imp"  id="imprimerAcButton">Avec Calculs</button>
                                        <button class="btn btn-outline-primary fw-bold col-12 mb-2 imp" id="imprimerScButton">Sans Calculs</button>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="accordionTelecharger" class="custom-accordion">
                            <div class="card mb-1 shadow-none">
                                <a href="#collapseTwo" class="text-dark collapsed" data-bs-toggle="collapse"
                                                aria-expanded="false"
                                                aria-controls="collapseTwo">
                                    <div class="card-header mb-2" id="headingTwo">
                                        <h6 class="m-0 text-secondary">
                                            Télécharger
                                            <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                        </h6>
                                    </div>
                                </a>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-bs-parent="#accordion">
                                    <div class="card-body py-0">
                                        <button class="btn btn-outline-secondary fw-bold col-12 mb-2" id="telechargerAcButton">Avec Calculs</button>
                                        <button class="btn btn-outline-secondary fw-bold col-12 mb-2" id="telechargerScButton">Sans Calculs</button>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-light fw-bold text-secondary col-12 mb-2" id="confirmationButton">Confirmer</button>
                        <button id="genererBonLivraisonButton" class="btn btn-light fw-bold text-secondary col-12">Générer Bon Livraison</button>
                        {{-- @if( $allTransfert['bonLivraisonVente_id'] != null )
                            <a href="{{ route('showLivraisonVente', $dataBonCommande["bonLivraisonVente_id"] )}}" id="goLivraison" class="btn btn-warning fw-bold text-white col-12">Bon Livraison</a>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>

@endsection

@section('script')
