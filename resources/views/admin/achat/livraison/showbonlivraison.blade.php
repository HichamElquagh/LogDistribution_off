@extends('admin.layouts.template')

@section('page-title')
    Bon de Livraison | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bon de Livraison</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Bon de Livraison</li>
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
                                <h4 class="fw-semibold mb-2">BON LIVRAISON {{$dataBonLivraison['Numero_bonLivraison']}}</h4>
                                <div class="mb-4 pt-1 d-flex">
                                    <span class="pe-2">Date: </span>
                                    <span class="fw-semibold pe-3">
                                        {{\Carbon\Carbon::parse($dataBonLivraison['date_Blivraison'])->isoFormat("LL") }}
                                    </span>
                                    <span class="statut-dispo d-flex align-items-center badge text-white">

                                    </span>
                                </div>
                                <div class="">
                                    @php
                                        $fournisseurs = Http::get(app('backendUrl').'/fournisseurs/'.$dataBonLivraison['fournisseur_id']);
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
                                @foreach($dataBonLivraison['Articles'] as $article)
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
                                        <p class="fw-semibold mb-2 pt-3">{{number_format($dataBonLivraison['Total_HT'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-2">{{number_format($dataBonLivraison['remise'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-2">{{number_format($dataBonLivraison['Total_TVA'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-0 pb-3">{{number_format($dataBonLivraison['Total_TTC'], 2, ',', ' ')}} Dhs</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body mx-3">
                        <div class="row">
                            <div class="col-12 text-center">
                                <span class="fw-bold">Note : </span>
                                <span>{{$dataBonLivraison['Commentaire']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Actions
                        <a href="{{ route('listeLivraison') }}" class="btn btn-outline-secondary btn-sm" type="submit">
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
                        <button id="genererBonReceptionButton" class="btn btn-light fw-bold text-secondary col-12 mb-2">Generer Bon Récéption</button>
                        <button id="genererFacture" class="btn btn-light fw-bold text-secondary col-12 mb-2">Generer Facture</button>
                        <button id="genererBonRetour" class="btn btn-light fw-bold text-secondary col-12 mb-2">Generer Bon Retour</button>
                        @if( $dataBonLivraison['bonretour_id'] != null )
                            <a href="{{ route('showRetour', $dataBonLivraison["bonretour_id"] )}}" id="goRetour" class="btn btn-light fw-bold text-secondary mb-2 col-12">Bon Retour</a>
                        @endif
                        @if( $dataBonLivraison['facture_id'] != null )
                            <a href="{{ route('showFacture', $dataBonLivraison["facture_id"] )}}" id="goFacture" class="btn btn-light fw-bold text-secondary mb-2 col-12">Facture</a>
                        @endif
                        <a href="{{ route('showCommande', $dataBonLivraison["bonCommande_id"] )}}" id="retourBonCommande" class="btn btn-warning fw-bold text-white col-12">Bon Commande</a>
                        <button class="btn btn-light fw-bold text-secondary col-12 mb-2" id="confirmationButton">Confirmer</button>
                    </div>
                </div>
                
                <div class="card" id="imageCard">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Image
                    </div>
                    <div class="card-body">
                        <img class="img-fluid image-pointer" id="livraisonImage" src="" alt=""data-bs-toggle="modal" data-bs-target="#imageModal">
                    </div>

                    <!-- Modal pour afficher l'image agrandie -->
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img id="modalImage" class="img-fluid" src="" alt="">
                                </div>
                            </div>
                        </div>
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
    $('#accordionImprimer, #accordionTelecharger, #genererBonReceptionButton, #retourBonCommande, #genererFacture, #genererBonRetour, #imageCard').hide();

    let confirme = {{ $dataBonLivraison['Confirme'] }};
    let $statutBadge = $('.statut-dispo');
    let existe = {{ $dataBonLivraison['id'] }};
    const backendUrl = "{{ app('backendUrl') }}";
    
    if (confirme == 1) {
        $('#accordionImprimer, #accordionTelecharger, #genererBonReceptionButton , #retourBonCommande, #imageCard').show();
        $('#confirmationButton').hide();
        $statutBadge.html('<i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Confirmé');
        $statutBadge.removeClass('bg-danger').addClass('bg-success');
        console.log($statutBadge)
    } else {
        $('#accordionImprimer, #accordionTelecharger, #retourBonCommande').hide();
        $('#confirmationButton').show();
        $statutBadge.html('<i class="ri-close-circle-line align-middle font-size-14 text-white pe-1"></i> Non Confirmé');
        $statutBadge.removeClass('bg-success').addClass('bg-danger');
        console.log($statutBadge)
    }

    const livraisonImage = document.getElementById('livraisonImage');
    const imageUrl = backendUrl +'/getimage/bonLivraisonAchat/' + '{{ $dataBonLivraison["attachement"] }}';
    livraisonImage.src = imageUrl;

    $.ajax({
        url: backendUrl +'/getblf',
        method: 'GET',
        success: function(response) { 
           response.forEach(e => {
            
            console.log(e.id)
                if (e.id == existe) {
                    $('#genererFacture').show();
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    }); 

    $.ajax({
        url: backendUrl +'/getblr',
        method: 'GET',
        success: function(response) { 
           response.forEach(e => {
            
            console.log(e.id)
                if (e.id == existe) {
                    $('#genererBonRetour').show();
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    }); 

    $('#confirmationButton').on('click', function() {
        let bonLivraisonId = '{{ $dataBonLivraison["id"] }}';
        
        $.ajax({
            url: backendUrl +'/bonlivraison/confirme/' + bonLivraisonId,
            method: 'PUT',
            success: function(response) {
                swal({
                    title: 'Confirmation réussie',
                    text: 'Le bon de livraison a été confirmé.',
                    icon: 'success',
                    buttons: false,
                    timer: 1500,
                }).then(function() {
                    $('#accordionImprimer, #accordionTelecharger, #genererFacture, #retourBonCommande, #genererBonRetour').show();
                    $('#confirmationButton').hide();
                    $statutBadge.removeClass('bg-danger').addClass('bg-success');
                    $statutBadge.html('<i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Confirmé');
                    $('#genererBonReceptionButton').show();
                });
            },
            error: function(xhr, status, error) {
                swal({
                    title: 'Erreur',
                    text: 'Une erreur s\'est produite lors de la confirmation du bon de livraison.',
                    icon: 'error',
                    buttons: false,
                    timer: 2000,
                });
                console.error(error);
            }
        });
    });

    $('#genererFacture').on('click', function() {
        let url = '{{ route("createFacture") }}';
        window.location.href = url;
    });

    $('#genererBonRetour').on('click', function() {
        let url = '{{ route("createRetour") }}';
        window.location.href = url;
    });

    $('#telechargerAcButton').on('click', function() {
        let bonLivraisonId = '{{ $dataBonLivraison["id"] }}';
        let url = backendUrl +'/printbl/' + bonLivraisonId + '/true';
        
        window.location.href = url;
    });
    $('#imprimerAcButton').on('click', function() {
        let bonLivraisonId = '{{ $dataBonLivraison["id"] }}';
        let url = backendUrl +'/printbl/' + bonLivraisonId + '/false';
        
        window.open(url, '_blank');
    });

    $('#genererBonReceptionButton').on('click', function() {
        let bonLivraisonId = '{{ $dataBonLivraison["id"] }}';
        let url = backendUrl +'/printbr/' + bonLivraisonId + '/false';
        
        window.open(url, '_blank');
    });

    $('#livraisonImage').on('click', function() {
        // Récupérer l'URL de l'image à partir de la source de l'image cliquée
        let imageUrl = $(this).attr('src');
        
        // Mettre à jour l'URL de l'image dans le modal
        $('#modalImage').attr('src', imageUrl);
        
        // Afficher le modal agrandi
        $('#imageModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });

});


</script>

@endsection