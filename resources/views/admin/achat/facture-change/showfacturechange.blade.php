@extends('admin.layouts.template')

@section('page-title')
    Facture Change | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Facture Change</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Facture Change</li>
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
                                <h4 class="fw-semibold mb-2">FACTURE CHANGE {{$dataFactureChange['numero_Facture']}}</h4>
                                <div class="mb-4 pt-1 d-flex">
                                    <span class="pe-2">Date: </span>
                                    <span class="fw-semibold pe-3">
                                        {{\Carbon\Carbon::parse($dataFactureChange['date_Facture'])->isoFormat("LL") }}
                                    </span>
                                    <span class="statut-dispo d-flex align-items-center badge text-white">

                                    </span>
                                </div>
                                <div class="">
                                    @php
                                        $fournisseurs = Http::get(app('backendUrl').'/fournisseurs/'.$dataFactureChange['fournisseur_id']);
                                        $dataFournisseur = $fournisseurs->json()['Fournisseur Requested'];
                                    @endphp
                                    <h6 class="mb-3">Envoyé par:</h6>
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
                                @foreach($dataFactureChange['Articles'] as $article)
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
                                        <p class="fw-semibold mb-2 pt-3">{{number_format($dataFactureChange['Total_HT'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-2">{{number_format($dataFactureChange['remise'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-2">{{number_format($dataFactureChange['Total_TVA'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-0 pb-3">{{number_format($dataFactureChange['Total_TTC'], 2, ',', ' ')}} Dhs</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body mx-3">
                        <div class="row">
                            <div class="col-12 text-center">
                                <span class="fw-bold">Note : </span>
                                <span>{{$dataFactureChange['Commentaire']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Actions
                        <a href="{{ route('achatFacture') }}" class="btn btn-outline-secondary btn-sm" type="submit">
                            <i class="ri-arrow-go-back-line"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        {{-- <button id="genererFacture" class="btn btn-light fw-bold text-secondary col-12 mb-2">Generer Facture Change</button> --}}
                        {{-- @if( $dataFactureChange['facture_id'] != null )
                            <a href="{{ route('showFacture', $dataFactureChange["facture_id"] )}}" id="goFacture" class="btn btn-light fw-bold text-secondary mb-2 col-12">Facture</a>
                        @endif --}}
                        <a href="{{ route('showRetour', $dataFactureChange['bonLivraison_id'] )}}" id="retourBonChange" class="btn btn-warning fw-bold text-white col-12">Bon Change</a>
                        <button class="btn btn-light fw-bold text-secondary col-12 mb-2" id="confirmationButton">Confirmer</button>
                        <button class="btn btn-danger fw-bold text-white col-12 mb-2" id="annulationButton">Annuler</button>
                    </div>
                </div>
                
                <div class="card" id="imageCard">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Image
                    </div>
                    <div class="card-body">
                        <img class="img-fluid image-pointer" id="factureimage" src="" alt="">
                        @if( $dataFactureChange['attachement'] == null )
                            <button class="btn btn-warning fw-bold text-white col-12 mb-2" id="imageButton" disabled>Ajouter l'image</button>
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

$(document).ready(function() {
    $('#accordionImprimer, #accordionTelecharger, #accordionPaiement, #retourBonChange, #imageCard').hide();

    let confirme = {{ $dataFactureChange['Confirme'] }};
    let etatPaiement = '{{ $dataFactureChange['EtatPaiement']}}'; 
    let ttcFacture = {{ $dataFactureChange['Total_TTC']}};
    let $statutBadge = $('.statut-dispo');
    let $badgeFacture = $('.statut-paye');
    let factureId = {{ $dataFactureChange["id"] }};
    let imageName = '{{ $dataFactureChange['attachement'] }}';
    const backendUrl = "{{ app('backendUrl') }}";

    if (confirme == 1) {
        $('#accordionImprimer, #accordionTelecharger, #retourBonChange, #imageCard').show();
        $('#confirmationButton, #annulationButton').hide();
        $statutBadge.html('<i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Confirmé');
        $statutBadge.removeClass('bg-danger').addClass('bg-success');       
        
    } else {
        $('#accordionImprimer, #accordionTelecharger, #accordionPaiement, #imageCard').hide();
        $('#confirmationButton, #annulationButton').show();
        $statutBadge.html('<i class="ri-close-circle-line align-middle font-size-14 text-white pe-1"></i> Non Confirmé');
        $statutBadge.removeClass('bg-success').addClass('bg-danger');
    }

    afficherBadgePaiement(etatPaiement);

    function afficherBadgePaiement(etatPaiement) {

        if (etatPaiement === "impaye") {
            $badgeFacture.html('<span class="fw-bold">Statut :</span><span class=" badge bg-danger text-white ms-2"><i class="ri-close-circle-line align-middle font-size-14 text-white pe-1"></i> Impayé</span>');
        } else if (etatPaiement === "En Cours") {
            $badgeFacture.html('<span class="fw-bold">Statut :</span><span class=" badge bg-info text-white ms-2"><i class="ri-radio-button-line align-middle font-size-14 text-white pe-1"></i> EnCours</span>');         
        } else if (etatPaiement === "Paye") {
            $badgeFacture.html('<span class="fw-bold">Statut :</span><span class=" badge bg-success text-white ms-2"><i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Payé</span>');
        }
    }

    const factureImage = document.getElementById('factureimage');
    const imageUrl = backendUrl +'/getimage/FactureAchat/' + imageName;
    factureImage.src = imageUrl;

    $('#confirmationButton').on('click', function() {

        swal({
            title: 'Confirmation',
            text: 'Voulez-vous vraiment confirmer la facture change ?',
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
                    url: backendUrl + '/facture/confirme/' + factureId,
                    method: 'PUT',
                    success: function(response) {
                        swal({
                            title: 'Confirmation réussie',
                            text: 'La facture change a été confirmé.',
                            icon: 'success',
                            buttons: false,
                            timer: 1500,
                        }).then(function() {
                            $('#accordionImprimer, #accordionTelecharger, #accordionPaiement, #retourBonChange, #imageCard').show();
                            $('#confirmationButton, #annulationButton').hide();
                            $statutBadge.removeClass('bg-danger').addClass('bg-success');
                            $statutBadge.html('<i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Confirmé');     
                        });
                    },
                    error: function(xhr, status, error) {
                        swal({
                            title: 'Erreur',
                            text: 'Une erreur s\'est produite lors de la confirmation du facture.',
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

        swal({
            title: 'Annulation',
            text: 'Voulez-vous vraiment annuler la facture change ?',
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
                    url: backendUrl + '/facture/' + factureId,
                    method: 'DELETE',
                    success: function(response) {
                        swal({
                            title: 'Annulation réussie',
                            text: 'La facture change a été annulé.',
                            icon: 'success',
                            buttons: false,
                            timer: 1500,
                        }).then(function() {
                            window.location.href = "{{ env('APP_URL') }}/facture-change-achat";
                        });
                    },
                    error: function(xhr, status, error) {
                        swal({
                            title: 'Erreur',
                            text: 'Une erreur s\'est produite lors de l\'annulation du facture.',
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

    $('#livraisonImage').on('click', function() {
        let imageUrl = $(this).attr('src');
        window.open(imageUrl, '_blank');
    });


});


</script>

@endsection