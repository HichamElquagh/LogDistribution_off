@extends('admin.layouts.template')

@section('page-title')
    Bon de Commande | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bon de Commande</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Bon de Commande</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-xl-9 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-xl-row  flex-sm-row flex-column m-sm-3 m-0">
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
                                <h4 class="fw-semibold mb-2">BON COMMANDE {{$dataBonCommande['Numero_bonCommandeVente']}}</h4>
                                <div class="mb-4 pt-1 d-flex">
                                    <span class="pe-2">Date: </span>
                                    <span class="fw-semibold pe-3">
                                        {{\Carbon\Carbon::parse($dataBonCommande['date_BCommandeVente'])->isoFormat("LL") }}
                                    </span>
                                    <span class="statut-dispo d-flex align-items-center badge text-white">

                                    </span>
                                </div>
                                <div class="">
                                    @php
                                        $client = Http::get(app('backendUrl').'/client/'.$dataBonCommande['client_id']);
                                        $dataClient = $client->json()['client'];
                                    @endphp
                                    <h6 class="mb-3">Envoyé à:</h6>
                                    <p class="mb-2">{{ $dataClient['nom_Client'] }}</p>
                                    <p class="mb-2">{{ $dataClient['adresse_Client'] }}</p>
                                    <p class="mb-2">{{ $dataClient['telephone_Client'] }}</p>
                                    <p class="mb-0">{{ $dataClient['email_Client'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive border-top mt-4">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Article</th>
                                    <th>Quantité</th>
                                    <th>P.U</th>
                                    <th>Total HT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataBonCommande['Articles'] as $article)
                                    <tr>
                                        <td class="text-nowrap" width="300">{{$article['reference']}}</td>
                                        <td class="text-nowrap" width="600">{{$article['article_libelle']}}</td>
                                        <td width="200">{{$article['Quantity']}}</td>
                                        <td width="200">{{$article['Prix_unitaire']}}</td>
                                        <td>{{$article['Total_HT']}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="align-top px-4 py-4">
                                        <p class="mb-2 mt-3">
                                        <span class="ms-3 fw-bold">Crée par:</span>
                                        <span>Alfie Solomons</span>
                                        </p>
                                    </td>
                                    <td class="text-start pe-3 py-4" width="250">
                                        <p class="mb-2 pt-3 fw-bold">Total HT</p>
                                        <p class="mb-2 fw-bold">Remise</p>
                                        <p class="mb-2 fw-bold">Total TVA</p>
                                        <p class="mb-0 pb-3 fw-bold">Total TTC</p>
                                    </td>
                                    <td class="ps-2 pe-5 py-4 text-end" width="800">
                                        <p class="fw-semibold mb-2 pt-3">{{number_format($dataBonCommande['Total_HT'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-2">{{number_format($dataBonCommande['remise'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-2">{{number_format($dataBonCommande['Total_TVA'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-0 pb-3">{{number_format($dataBonCommande['Total_TTC'], 2, ',', ' ')}} Dhs</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body mx-3">
                        <div class="row">
                            <div class="col-12 text-center">
                                <span class="fw-bold">Note : </span>
                                <span>{{$dataBonCommande['Commentaire']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Actions
                        <a href="{{ route('listeCommandeVente') }}" class="btn btn-outline-secondary btn-sm" type="submit">
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
                        <button id="genererBonLivraisonButton" class="btn btn-light fw-bold text-secondary col-12">Generer Bon Livraison</button>
                        @if( $dataBonCommande['bonLivraisonVente_id'] != null )
                            <a href="{{ route('showLivraisonVente', $dataBonCommande["bonLivraisonVente_id"] )}}" id="goLivraison" class="btn btn-warning fw-bold text-white col-12">Bon Livraison</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>

@endsection

@section('script')

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

const backendUrl = "{{ app('backendUrl') }}";

$(document).ready(function() {
    $('#accordionImprimer, #accordionTelecharger, #genererBonLivraisonButton').hide();

    let confirme = {{ $dataBonCommande['Confirme'] }};
    let $statutBadge = $('.statut-dispo');
    let bonCommandeId = {{ $dataBonCommande["id"] }};
    
    if (confirme == 1) {
        $('#accordionImprimer, #accordionTelecharger').show();
        $('#confirmationButton').hide();
        $statutBadge.html('<i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Confirmé');
        $statutBadge.removeClass('bg-danger').addClass('bg-success');
    } else {
        $('#accordionImprimer, #accordionTelecharger').hide();
        $('#confirmationButton').show();
        $statutBadge.html('<i class="ri-close-circle-line align-middle font-size-14 text-white pe-1"></i> Non Confirmé');
        $statutBadge.removeClass('bg-success').addClass('bg-danger');
    }

    $.ajax({
        url: backendUrl + '/getbcv',
        method: 'GET',
        success: function(response) {
           response.forEach(e => {
                if (e.id == bonCommandeId) {
                    $('#genererBonLivraisonButton').show();
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    }); 

    $('#confirmationButton').on('click', function() {
        
        $.ajax({
            url: backendUrl + '/boncommandevente/confirme/' + bonCommandeId,
            method: 'PUT',
            success: function(response) {
                swal({
                    title: 'Confirmation réussie',
                    text: response.message,
                    icon: 'success',
                    buttons: false,
                    timer: 1500,
                }).then(function() {
                    $('#accordionImprimer, #accordionTelecharger').show();
                    $('#confirmationButton').hide();
                    $statutBadge.removeClass('bg-danger').addClass('bg-success');
                    $statutBadge.html('<i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Confirmé');
                    $('#genererBonLivraisonButton').show();
                });
            },
            error: function(xhr, status, error) {
                swal({
                    title: 'Erreur',
                    text: 'Une erreur s\'est produite lors de la confirmation du bon de commande.',
                    icon: 'error',
                    buttons: false,
                    timer: 2000,
                });
                console.error(error);
            }
        });
    });

    $('#genererBonLivraisonButton').on('click', function() {
        let url = '{{ route("createLivraisonVente") }}';
        window.location.href = url;
    });



    $('#telechargerAcButton').on('click', function() {
        let url = backendUrl + '/printbcv/' + bonCommandeId + '/ac/true';
        
        window.location.href = url;
    });
    
    $('#telechargerScButton').on('click', function() {
        let url = backendUrl + '/printbcv/' + bonCommandeId + '/sc/true';
        
        window.location.href = url;
    });

    $('#imprimerAcButton').on('click', function() {
        let url = backendUrl + '/printbcv/' + bonCommandeId + '/ac/false';
        
        window.open(url, '_blank');
    });
    
    $('#imprimerScButton').on('click', function() {
        let url = backendUrl + '/printbcv/' + bonCommandeId + '/sc/false';
        
        window.open(url, '_blank');
    });

});


</script>

@endsection