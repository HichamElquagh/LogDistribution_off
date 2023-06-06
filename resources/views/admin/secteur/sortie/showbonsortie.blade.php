@extends('admin.layouts.template')

@section('page-title')
    Bon de Sortie | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bon de Sortie</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Bon de Sortie</li>
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
                                <h4 class="fw-semibold mb-2">BON SORTIE {{$dataBonSortie['reference']}}</h4>
                                <div class="mb-1 d-flex align-items-center">
                                    <p class="pe-2 fw-bold mb-0">Date de sortie: </p>
                                    <span class="fw-semibold pe-3">
                                        {{\Carbon\Carbon::parse($dataBonSortie['dateSortie'])->isoFormat("LL") }}
                                    </span>
                                    <span class="statut-dispo d-flex align-items-center badge text-white">
                                    </span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <p class="pe-2 fw-bold mb-0">Heure :</p>
                                    <span class="fw-semibold pe-3">
                                        {{ \Carbon\Carbon::parse($dataBonSortie['dateSortie'])->isoFormat('LT') }}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <p class="mb-0 me-2 fw-bold">Secteur :</p>
                                    <p class="mb-0">{{ $dataBonSortie['secteur'] }}</p>
                                </div>
                                <div class="d-flex align-items-center mb-1">
                                    <p class="mb-0 me-2 fw-bold">Vendeur :</p>
                                    <p class="mb-0">{{ $dataBonSortie['nomComplet1'] }}</p>
                                </div>
                                @if($dataBonSortie['nomComplet2'] != null)
                                    <div class="d-flex align-items-center mb-1">
                                        <p class="mb-0 me-2 fw-bold">Aide Vendeur :</p>
                                        <p class="mb-0">{{ $dataBonSortie['nomComplet2'] }}</p>
                                    </div>
                                @else
                                    <p class="mb-0 me-2 fw-bold">Aide Vendeur :</p>
                                @endif
                                @if($dataBonSortie['nomComplet3'] != null)
                                    <div class="d-flex align-items-center mb-1">
                                        <p class="mb-0 me-2 fw-bold">Aide Vendeur :</p>
                                        <p class="mb-0">{{ $dataBonSortie['nomComplet3'] }}</p>
                                    </div>
                                @else
                                    <p class="mb-0 me-2 fw-bold">Aide Vendeur :</p>
                                @endif
                                <div class="d-flex align-items-center mt-2">
                                    <p class="mb-0 me-2 fw-bold">Camion :</p>
                                    <p class="mb-0">{{ $dataBonSortie['marque'] }} - {{ $dataBonSortie['matricule'] }}</p>
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
                                    <th>Unité</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataBonSortie['Articles'] as $article)
                                    <tr>
                                        <td class="text-nowrap" width="300">{{$article['reference']}}</td>
                                        <td class="text-nowrap" width="600">{{$article['article_libelle']}}</td>
                                        <td width="200">{{$article['QuantitySortie']}}</td>
                                        <td width="200">{{$article['unite']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body mx-3">
                        <div class="row">
                            <div class="col-12 text-center">
                                <span class="fw-bold">Note : </span>
                                <span>{{$dataBonSortie['Commentaire']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Actions
                        <a href="{{ route('listeSortieSecteur') }}" class="btn btn-outline-secondary btn-sm" type="submit">
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
                        <button id="genererBonSecteur" class="btn btn-light fw-bold text-secondary col-12 mb-2">Generer BonSecteur</button>
                        @if( $dataBonSortie['vente_secteur_id'] != null )
                            <a href="{{ route('showBonSecteur', $dataBonSortie["vente_secteur_id"] )}}" id="goVenteSecteur" class="btn btn-light fw-bold text-secondary mb-2 col-12">Bon Secteur</a>
                        @endif
                        <button class="btn btn-light fw-bold text-secondary col-12 mb-2" id="confirmationButton">Confirmer</button>
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
    $('#accordionImprimer, #accordionTelecharger, #genererBonReceptionButton, #retourBonCommande, #genererBonSecteur').hide();

    let confirme = {{ $dataBonSortie['Confirme'] }};
    let $statutBadge = $('.statut-dispo');
    let existe = {{ $dataBonSortie['id'] }};
    const backendUrl = "{{ app('backendUrl') }}";
    
    if (confirme == 1) {
        $('#accordionImprimer, #accordionTelecharger, #genererBonReceptionButton , #retourBonCommande').show();
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

    $.ajax({
        url: backendUrl +'/getbs',
        method: 'GET',
        success: function(response) { 
           response.forEach(e => {
                if (e.id == existe) {
                    $('#genererBonSecteur').show();
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    }); 

    $('#confirmationButton').on('click', function() {
        let BonSortieId = '{{ $dataBonSortie["id"] }}';
        
        $.ajax({
            url: backendUrl +'/bonsortie/confirme/' + BonSortieId,
            method: 'PUT',
            success: function(response) {
                swal({
                    title: 'Confirmation réussie',
                    text: 'Le bon de sortie a été confirmé.',
                    icon: 'success',
                    buttons: false,
                    timer: 1500,
                }).then(function() {
                    $('#accordionImprimer, #accordionTelecharger, #genererBonSecteur').show();
                    $('#confirmationButton').hide();
                    $statutBadge.removeClass('bg-danger').addClass('bg-success');
                    $statutBadge.html('<i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Confirmé');
                });
            },
            error: function(response) {
                swal({
                    title: 'Erreur',
                    text: response.responseJSON.message,
                    icon: 'error',
                    buttons: false,
                    timer: 2000,
                });
            }
        });
    });

    $('#genererBonSecteur').on('click', function() {
        let url = '{{ route("createBonSecteur") }}';
        window.location.href = url;
    });

    $('#telechargerAcButton').on('click', function() {
        let BonSortieId = '{{ $dataBonSortie["id"] }}';
        let url = backendUrl +'/printbs/' + BonSortieId + '/true';
        
        window.location.href = url;
    });
    $('#imprimerAcButton').on('click', function() {
        let BonSortieId = '{{ $dataBonSortie["id"] }}';
        let url = backendUrl +'/printbs/' + BonSortieId + '/false';
        
        window.open(url, '_blank');
    });
});


</script>

@endsection