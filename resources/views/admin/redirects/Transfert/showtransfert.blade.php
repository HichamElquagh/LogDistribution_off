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
                                    <h6 class="mb-2">Livrer par : {{ $allTransfert['nom_employee'] }}</h6>
                                   <h6 class="mb-2">Camion : <span>{{ $allTransfert['marque'] }}</span></h6>
                                   <h6 class="mb-2">Matricule : <span>{{ $allTransfert['matricule'] }}</span></h6>
                                   <h6 class="mb-0">Modele : <span>{{ $allTransfert['modele'] }}</span></h6>
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
                        <a href="{{ route('admintransfert') }}" class="btn btn-outline-secondary btn-sm" type="submit">
                            <i class="ri-arrow-go-back-line"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div id="accordionImprimer" class="custom-accordion">
                            <div class="card mb-1 shadow-none">
                              <div class="card-header bg-warning mb-2 text-center" id="headingOne">
                                <button type="submit" class="m-0 text-white border-0 bg-warning text-dark " id="print_transfert">
                                  Imprimer
                                </button>
                              </div>
                            </div>
                          </div>
                        <button class="btn btn-light fw-bold text-secondary col-12 mb-2" id="confirmationButton">Confirmer</button>
                         {{-- @if( $allTransfert['bonLivraisonVente_id'] != null )
                            <a href="{{ route('showLivraisonVente', $dataBonCommande["bonLivraisonVente_id"] )}}" id="goLivraison" class="btn btn-warning fw-bold text-white col-12">Bon Livraison</a>
                        @endif  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    const backendUrl = "{{ app('backendUrl') }}";
    let TransfertId = {{ $allTransfert["id"] }};
    let statutBadge = $('.statut-dispo');
    let confirme = {{ $allTransfert['Confirme'] }};



    $(document).ready(function() {
        // console.log(TransfertId);
        if (confirme == 1) {
            $('#accordionImprimer, #accordionTelecharger').show();
            $('#confirmationButton').hide();
            statutBadge.html('<i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Confirmé');
            statutBadge.removeClass('bg-danger').addClass('bg-success');
        } else {
            $('#accordionImprimer, #accordionTelecharger').hide();
            $('#confirmationButton').show();
            statutBadge.html('<i class="ri-close-circle-line align-middle font-size-14 text-white pe-1"></i> Non Confirmé');
            statutBadge.removeClass('bg-success').addClass('bg-danger');
        }
        $('#print_transfert').on('click', function() {
            let url = backendUrl + '/printt/' + TransfertId + '/isDownloaded';
            let newWindow = window.open(url, '_blank');

            if (newWindow) {
                // Popup blocked, fallback to opening in the same window
                newWindow.focus();
            } else {
                // Opening in a new window was blocked, display an error message
                console.log('Popup blocked. Enable popups in your browser settings to proceed.');
            }
        });

        $('#confirmationButton').on('click', function() {
            swal({
                title: "Confirmation",
                text: "Êtes-vous sûr de vouloir confirmer le transfert ?",
                icon: "warning",
                buttons: ["Annuler", "Confirmer"],
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    let url = backendUrl + '/transfert/confirme/' + TransfertId;
                    $.ajax({
                        url: url,
                        type: 'put',
                        success: function(response) {
                            swal("Succès", "Le transfert a été confirmé avec succès.", "success").then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            swal("Erreur", "Une erreur s'est produite lors de la confirmation du transfert.", "error");
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
