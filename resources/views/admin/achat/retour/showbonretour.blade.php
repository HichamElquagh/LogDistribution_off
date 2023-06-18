@extends('admin.layouts.template')

@section('page-title')
    Bon de Retour | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bon de Retour</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Bon de Retour</li>
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
                                <h4 class="fw-semibold mb-2">BON RETOUR {{$dataBonRetour['Numero_bonRetour']}}</h4>
                                <div class="mb-4 pt-1 d-flex">
                                    <span class="pe-2">Date: </span>
                                    <span class="fw-semibold pe-3">
                                        {{\Carbon\Carbon::parse($dataBonRetour['date_BRetour'])->isoFormat("LL") }}
                                    </span>
                                    <span class="statut-dispo d-flex align-items-center badge text-white">

                                    </span>
                                </div>
                                <div class="">
                                    @php
                                        $fournisseurs = Http::get(app('backendUrl').'/fournisseurs/'.$dataBonRetour['fournisseur_id']);
                                        $dataFournisseur = $fournisseurs->json()['Fournisseur Requested'];
                                    @endphp
                                    <h6 class="mb-3">Envoyé à:</h6>
                                    <p class="mb-2">{{ $dataFournisseur['fournisseur'] }}</p>
                                    <p class="mb-2">{{ $dataFournisseur['Adresse'] }}</p>
                                    <p class="mb-2">{{ $dataFournisseur['Telephone'] }}</p>
                                    <p class="mb-0">{{ $dataFournisseur['email'] }}</p>
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
                                @foreach($dataBonRetour['Articles'] as $article)
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
                                        <p class="mb-2 fw-bold">Total TVA</p>
                                        <p class="mb-0 pb-3 fw-bold">Total TTC</p>
                                    </td>
                                    <td class="ps-2 pe-5 py-4 text-end" width="800">
                                        <p class="fw-semibold mb-2 pt-3">{{number_format($dataBonRetour['Total_HT'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-2">{{number_format($dataBonRetour['Total_TVA'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-0 pb-3">{{number_format($dataBonRetour['Total_TTC'], 2, ',', ' ')}} Dhs</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body mx-3">
                        <div class="row">
                            <div class="col-12 text-center">
                                <span class="fw-bold">Note : </span>
                                <span>{{$dataBonRetour['Commentaire']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Actions
                        <a href="{{ route('listeRetour') }}" class="btn btn-outline-secondary btn-sm" type="submit">
                            <i class="ri-arrow-go-back-line"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div id="accordionImprimer">
                            <button class="btn btn-warning text-white fw-bold col-12 mb-2 imp"  id="imprimerAcButton">Imprimer</button>
                        </div>
                        <div id="accordionTelecharger">
                            <button class="btn btn-light text-secondary fw-bold col-12 mb-2" id="telechargerAcButton">Télécharger</button>
                        </div>
                        <button id="genererBonChange" class="btn btn-light fw-bold text-secondary col-12 mb-2">Generer Bon Change</button>
                        @if( $dataBonRetour['bonLivraisonChange_id'] != null )
                            <a href="{{ route('showChange', $dataBonRetour["bonLivraisonChange_id"] )}}" id="goChange" class="btn btn-light fw-bold text-secondary mb-2 col-12">Bon Change</a>
                        @endif
                        <a href="{{ route('showLivraison', $dataBonRetour["bonLivraison_id"] )}}" id="retourBonLivraison" class="btn btn-warning fw-bold text-white col-12">Bon Livraison</a>
                        <button class="btn btn-light fw-bold text-secondary col-12 mb-2" id="confirmationButton">Confirmer</button>
                        <button class="btn btn-danger fw-bold text-white col-12 mb-2" id="annulationButton">Annuler</button>
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

$(document).ready(function() {
    $('#accordionImprimer, #accordionTelecharger, #retourBonLivraison, #genererBonChange').hide();

    let confirme = {{ $dataBonRetour['Confirme'] }};
    let $statutBadge = $('.statut-dispo');
    let existe = {{ $dataBonRetour['id'] }};
    const backendUrl = "{{ app('backendUrl') }}";
    
    if (confirme == 1) {
        $('#accordionImprimer, #accordionTelecharger, #retourBonLivraison').show();
        $('#confirmationButton, #annulationButton').hide();
        $statutBadge.html('<i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Confirmé');
        $statutBadge.removeClass('bg-danger').addClass('bg-success');
        console.log($statutBadge)
    } else {
        $('#accordionImprimer, #accordionTelecharger, #retourBonLivraison').hide();
        $('#confirmationButton, #annulationButton').show();
        $statutBadge.html('<i class="ri-close-circle-line align-middle font-size-14 text-white pe-1"></i> Non Confirmé');
        $statutBadge.removeClass('bg-success').addClass('bg-danger');
        console.log($statutBadge)
    }

    $.ajax({
        url: backendUrl +'/getchangebr',
        method: 'GET',
        success: function(response) { 
           response.forEach(e => {
            
            console.log(e.id)
                if (e.id == existe) {
                    $('#genererBonChange').show();
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    }); 

    $('#confirmationButton').on('click', function() {
        let bonRetourId = '{{ $dataBonRetour["id"] }}';
        
        swal({
            title: 'Confirmation',
            text: 'Voulez-vous vraiment confirmer le bon de retour ?',
            icon: 'warning',
            buttons: {
                cancel: {
                    text: 'Non',
                    value: false,
                    visible: true,
                    className: '',
                    closeModal: true,
                },
                confirm: {
                    text: 'Oui',
                    value: true,
                    visible: true,
                    className: 'bg-success',
                    closeModal: true
                }
            },
            dangerMode: true,
        }).then(function(confirm) {
            if (confirm) {
                $.ajax({
                    url: backendUrl + '/bonretourachat/confirme/' + bonRetourId,
                    method: 'PUT',
                    success: function(response) {
                        swal({
                            title: 'Confirmation réussie',
                            text: 'Le bon de retour a été confirmé.',
                            icon: 'success',
                            buttons: false,
                            timer: 1500,
                        }).then(function() {
                            $('#accordionImprimer, #accordionTelecharger, #retourBonLivraison, #genererBonChange').show();
                            $('#confirmationButton, #annulationButton').hide();
                            $statutBadge.removeClass('bg-danger').addClass('bg-success');
                            $statutBadge.html('<i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Confirmé');
                        });
                    },
                    error: function(xhr, status, error) {
                        swal({
                            title: 'Erreur',
                            text: 'Une erreur s\'est produite lors de la confirmation du bon de retour.',
                            icon: 'error',
                            buttons: false,
                            timer: 2000,
                        });
                        console.error(error);
                    }
                });
            } 
        });
    });

    $('#annulationButton').on('click', function() {
        let bonRetourId = '{{ $dataBonRetour["id"] }}';

        swal({
            title: 'Annulation',
            text: 'Voulez-vous vraiment annuler le bon de retour ?',
            icon: 'warning',
            buttons: {
                cancel: {
                    text: 'Non',
                    value: false,
                    visible: true,
                    className: '',
                    closeModal: true,
                },
                confirm: {
                    text: 'Oui',
                    value: true,
                    visible: true,
                    className: 'bg-success',
                    closeModal: true
                }
            },
            dangerMode: true,
        }).then(function(confirm) {
            if (confirm) {
                $.ajax({
                    url: backendUrl + '/bonretourachat/' + bonRetourId,
                    method: 'DELETE',
                    success: function(response) {
                        swal({
                            title: 'Annulation réussie',
                            text: 'Le bon de retour a été annulé.',
                            icon: 'success',
                            buttons: false,
                            timer: 1500,
                        }).then(function() {
                            window.location.href = "{{ env('APP_URL') }}/bon-retour-achat";
                        });
                    },
                    error: function(xhr, status, error) {
                        swal({
                            title: 'Erreur',
                            text: 'Une erreur s\'est produite lors de l\'annulation du bon de retour.',
                            icon: 'error',
                            buttons: false,
                            timer: 2000,
                        });
                        console.error(error);
                    }
                });
            } 
        });
    });

    $('#telechargerAcButton').on('click', function() {
        let bonRetourId = '{{ $dataBonRetour["id"] }}';
        let url = backendUrl +'/printbretour/' + bonRetourId + '/true';
        
        window.location.href = url;
    });
    $('#imprimerAcButton').on('click', function() {
        let bonRetourId = '{{ $dataBonRetour["id"] }}';
        let url = backendUrl +'/printbretour/' + bonRetourId + '/false';
        
        window.open(url, '_blank');
    });

    $('#genererBonChange').on('click', function() {
        let url = '{{ route("createChange") }}';
        window.location.href = url;
    });
});


</script>

@endsection