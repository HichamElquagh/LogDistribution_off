@extends('admin.layouts.template')

@section('page-title')
    Facture Vente | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Facture Vente</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Facture Vente</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-xl-8 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-xl-row  flex-sm-row flex-column m-0">
                            <div class="mb-xl-0 mb-3">
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
                                <h4 class="fw-semibold mb-2">FACTURE {{$dataFacturee['numero_FactureVente']}}</h4>
                                <div class="mb-3 pt-1 d-flex">
                                    <span class="pe-2">Date: </span>
                                    <span class="fw-semibold pe-3">
                                        {{\Carbon\Carbon::parse($dataFacturee['date_FactureVente'])->isoFormat("LL") }}
                                    </span>
                                    <span class="statut-dispo d-flex align-items-center badge text-white"></span>
                                </div>
                                <div class="">
                                    @php
                                        $client = Http::get(app('backendUrl').'/client/'.$dataFacturee['client_id']);
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
                    <div class="card-body py-0 mt-3">
                        <div class="row">
                            <div class="mb-2 col-lg-6">
                                <div class="mb-2">
                                    <span class="fw-bold">Bon Livraison : </span>
                                    <span >{{$dataFacturee['Numero_bonLivraisonVente']}}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="fw-bold">Bon Commande : </span>
                                    <span >{{$dataFacturee['Numero_bonCommandeVente']}}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="fw-bold">Date Commande : </span>
                                    <span >12 mai 2023</span>
                                </div>
                            </div>
                            <div class="mb-2 col-lg-6">
                                <div class="mb-2 d-flex align-items-center statut-paye">
                                </div>
                                <div class="mb-2">
                                    <span class="fw-bold">Cond. Paiement : </span>
                                    <span >60 JOURS FIN DE MOIS</span>
                                </div>
                                <div class="mb-2">
                                    <span class="fw-bold">Date Echéance : </span>
                                    <span >23 juin 2023</span>
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
                                @foreach($dataFacturee['Articles'] as $article)
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
                                        <p class="fw-semibold mb-2 pt-3">{{number_format($dataFacturee['Total_HT'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-2">{{number_format($dataFacturee['remise'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-2">{{number_format($dataFacturee['Total_TVA'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-0 pb-3">{{number_format($dataFacturee['Total_TTC'], 2, ',', ' ')}} Dhs</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body mx-3">
                        <div class="row">
                            <div class="col-12 text-center">
                                <span class="fw-bold">Note : </span>
                                <span>{{$dataFacturee['Commentaire']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card mb-3">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Actions
                        <a href="{{ route('venteFacture') }}" class="btn btn-outline-secondary btn-sm" type="submit">
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
                        <div id="accordionPaiement">
                            <button class="btn btn-light text-secondary fw-bold col-12 mb-2" id="paiementButton">Ajouter Paiement</button>
                        </div>
                        <a href="{{ route('showLivraisonVente', $dataFacturee["bonLivraisonVente_id"] )}}" id="retourBonLivraison" class="btn btn-warning fw-bold text-white col-12">Bon Livraison</a>

                        {{-- Modal  --}}
                        <div class="modal fade" id="paiementModal" tabindex="-1" aria-labelledby="paiementModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paiementModalLabel">Ajouter Paiement</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="modal-header py-0 mb-3">
                                                <div class="row">
                                                    <div class=" col-lg-6 mb-3">
                                                        <p class=" fw-bold mb-0">Montant Du Facture</p>
                                                    </div>
                                                    <div class=" col-lg-6 text-end mb-3">   
                                                        <p class="fw-bold mb-0">{{number_format($dataFacturee['Total_TTC'], 2, ',', ' ')}} Dhs</p>
                                                    </div>
                                                    <div class=" col-lg-6 mb-3">
                                                        <p class=" fw-bold mb-0">Montant Rester</p>
                                                    </div>
                                                    <div class=" col-lg-6 text-end mb-3">   
                                                        <p class="fw-bold mb-0" id="montantRester"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-6">
                                                <label for="nrTransaction" class="form-label">Nr° Transaction</label>
                                                <input type="text" class="form-control" id="nrTransaction" disabled>
                                            </div>
                                            <div class="mb-3 col-lg-6">
                                                <label for="dateTransaction" class="form-label">Date Transaction</label>
                                                <input type="text" class="form-control" id="dateTransaction" disabled>
                                            </div>
                                            <div class="mb-3 col-lg-12">
                                                <label for="modePaiement" class="form-label">Mode de Paiement</label>
                                                <select class="form-select" id="modePaiement">
                                                    <option>Selectionner un mode</option>
                                                    <option value="cheque">Chèque</option>
                                                    <option value="virement">Virement</option>
                                                    <option value="espece">Espèce</option>
                                                </select>
                                            </div>
                                            <div id="chequeInputs" class="mb-3 col-lg-8">
                                                <label for="chequeNr" class="form-label">Nr° Chèque</label>
                                                <input type="text" class="form-control" id="chequeNr">
                                            </div>
                                            <div id="virementInputs" class="mb-3 col-lg-8">
                                                <label for="virementNr" class="form-label">Nr° Virement</label>
                                                <input type="text" class="form-control" id="virementNr">
                                            </div>
                                            <div id="montantInput" class="mb-3 col-lg-4">
                                                <label for="montant" class="form-label">Montant</label>
                                                <input type="number" class="form-control" id="montantTransaction">
                                            </div>
                                            <div id="dateChequeInputs" class="mb-3 col-lg-6">
                                                <label for="dateCheque" class="form-label">Date du chéque</label>
                                                <input type="date" class="form-control" id="dateCheque">
                                            </div>
                                            <div id="imgChequeInputs" class="mb-3 col-lg-6">
                                                <label for="imgCheque" class="form-label">Image du Chéque</label>
                                                <input type="file" class="form-control" id="imgCheque">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                        <button type="button" class="btn btn-warning text-white" id="enregistrerPaiementButton">Effectuer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal 2 -->
                        <div class="modal fade" id="transactionModalDetail" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="transactionModalLabel">Détails de la transaction</h5>
                                        <div id="statutTransaction">

                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="mb-3 col-lg-6">
                                                <label for="nrTransactionDetail" class="form-label">Nr° Transaction</label>
                                                <input type="text" class="form-control" id="nrTransactionDetail" disabled>
                                            </div>
                                            <div class="mb-3 col-lg-6">
                                                <label for="dateTransactionDetail" class="form-label">Date Transaction</label>
                                                <input type="text" class="form-control" id="dateTransactionDetail" disabled>
                                            </div>
                                            <div class="mb-3 col-lg-6">
                                                <label for="modePaiementDetail" class="form-label">Mode de Paiement</label>
                                                <input type="text" class="form-control" id="modePaiementDetail" disabled>
                                            </div>
                                            <div class="mb-3 col-lg-6">
                                                <label for="montant" class="form-label">Montant</label>
                                                <input type="text" class="form-control" id="montantTransactionDetail" disabled>
                                            </div>
                                            <div id="chequeInputsDetail" class="mb-3 col-lg-12">
                                                <label for="chequeNr" class="form-label">Nr° Chèque</label>
                                                <input type="text" class="form-control" id="chequeNrDetail" disabled>
                                            </div>
                                            <div id="virementInputsDetail" class="mb-3 col-lg-7">
                                                <label for="virementNr" class="form-label">Nr° Virement</label>
                                                <input type="text" class="form-control" id="virementNrDetail" disabled>
                                            </div>
                                            <div id="dateChequeInputsDetail" class="mb-3 col-lg-7">
                                                <label for="dateCheque" class="form-label">Date du chéque</label>
                                                <input type="text" class="form-control" id="dateChequeDetail" disabled>
                                            </div>
                                            <div id="banqueInputsDetail" class="mb-3 col-lg-5">
                                                <label for="banqueDetail" class="form-label">Banque</label>
                                                <input type="text" class="form-control" id="banqueDetail" disabled>
                                            </div>
                                            <div id="imageInputsDetail" class="mb-3 col-lg-12">
                                                <label for="imageDetail" class="form-label">Image Chéque</label>
                                                <img class="w-100" src="https://raw.githubusercontent.com/yanliang12/cheque_detection/master/WeChat%20Screenshot_20200820081723.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                        <button type="button" class="btn btn-warning text-white" id="reglerBoutonConfirmation">Régler</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-light fw-bold text-secondary col-12 mb-2" id="confirmationButton">Confirmer</button>
                    </div>
                </div>
              
                <div class="cardTr overflow-scroll" style="height: 600px">
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
    $('#accordionImprimer, #accordionTelecharger, #accordionPaiement, #retourBonLivraison').hide();

    let confirme = {{ $dataFacturee['Confirme'] }};
    let etatPaiement = '{{ $dataFacturee['EtatPaiement']}}'; 
    let ttcFacture = {{ $dataFacturee['Total_TTC']}};
    let $statutBadge = $('.statut-dispo');
    let $badgeFacture = $('.statut-paye');
    let factureId = {{ $dataFacturee["id"] }};
    const backendUrl = "{{ app('backendUrl') }}";
    
    if (confirme == 1) {
        $('#accordionImprimer, #accordionTelecharger, #retourBonLivraison').show();
        if(etatPaiement === "Paye"){
            $('#accordionPaiement').hide();
        }else {
            $('#accordionPaiement').show();
        }
        $('#confirmationButton').hide();
        $statutBadge.html('<i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Confirmé');
        $statutBadge.removeClass('bg-danger').addClass('bg-success');       
        
    } else {
        $('#accordionImprimer, #accordionTelecharger, #accordionPaiement').hide();
        $('#confirmationButton').show();
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

    $('#confirmationButton').on('click', function() {
        
        $.ajax({
            url: backendUrl +'/facturevente/confirme/' + factureId,
            method: 'PUT',
            success: function(response) {
                swal({
                    title: 'Confirmation réussie',
                    text: 'La facture a été confirmé',
                    icon: 'success',
                    buttons: false,
                    timer: 1500,
                }).then(function() {
                    $('#accordionImprimer, #accordionTelecharger, #accordionPaiement, #retourBonLivraison').show();
                    $('#confirmationButton').hide();
                    $statutBadge.removeClass('bg-danger').addClass('bg-success');
                    $statutBadge.html('<i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Confirmé');                   
                });
            },
            error: function(xhr, status, error) {
                swal({
                    title: 'Erreur',
                    text: 'Une erreur s\'est produite lors de la confirmation du bon du facture.',
                    icon: 'error',
                    buttons: false,
                    timer: 2000,
                });
            }
        });
    });

    afficherTransactions()

    function afficherTransactions() {       
        $.ajax({
            url: backendUrl +'/facture/transactions/' + factureId +'/vente' ,
            type: 'GET',
            success: function(response) {
                const cardTr = $('.cardTr');
                const transactions = response;
                cardTr.empty();

                transactions.forEach(function(transaction) {
                    const transactionId = transaction.id;
                    const transactionDate = transaction.date_transaction;
                    const transactionText = transaction.description;
                    const transactionMontant = transaction.montant;
                    const modePaiement = transaction.modePaiement;
                    const etatCheque = transaction.etat_cheque;

                    const smallDate = $('<small></small>').addClass('fw-bold text-warning ms-3').text(transactionDate);

                    const card = $('<div></div>').addClass('card mb-2 mt-2');

                    const cardBody = $('<div></div>').addClass('card-body p-3');

                    const row = $('<div></div>').addClass('row align-items-center');

                    const cardTitleCol = $('<div></div>').addClass('col-lg-6');
                    const cardTextCol = $('<div></div>').addClass('col-lg-6 text-end');

                    const cardTitle = $('<span></span>').addClass('card-title mb-0 fw-bolder');

                    if (modePaiement === 'cheque') {
                        const badge = $('<span></span>').addClass('badge me-2');

                        if (etatCheque === 'portfeuille') {
                            badge.addClass('bg-danger').text('PF');
                        } else if (etatCheque === 'regler') {
                            badge.addClass('bg-success').text('R');
                        }

                        cardTitle.append(badge);
                    } else {
                        const badge = $('<span></span>').addClass('badge me-2');
                        badge.addClass('bg-success').text('R');
                        cardTitle.append(badge);
                    }

                    cardTitle.append(transactionText);
                    const cardText = $('<span></span>').addClass('card-text mb-0 text-success fw-bold').text('+ MAD ' + transactionMontant.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));

                    cardTitleCol.append(cardTitle);
                    cardTextCol.append(cardText);

                    row.append(cardTitleCol);
                    row.append(cardTextCol);

                    cardBody.append(row);

                    const infoButton = $('<button></button>').addClass('btn btn-sm btn-warning text-white position-absolute top-0 end-0 translate-middle px-1 py-0');
                    const infoIcon = $('<i></i>').addClass('fas fa-info-circle pt-1');
                    infoButton.append(infoIcon);

                    infoButton.on('click', function() {
                        afficherDetailTransaction(transactionId);
                        $('#transactionModalDetail').modal('show');
                        $('#reglerBoutonConfirmation').on('click', function() {      
                            $.ajax({
                                url: backendUrl +'/transactions/confirme/' + transactionId,
                                method: 'PUT',
                                success: function(response) {
                                    const etatPaiement = response.EtatPaiement;
                                    console.log(response)
                                    swal({
                                        title: 'Confirmation réussie',
                                        text: 'Le chéque a été régler',
                                        icon: 'success',
                                        buttons: false,
                                        timer: 1500,
                                    }).then(function() {
                                        $('#transactionModalDetail').modal('hide');
                                        afficherTransactions();
                                        afficherBadgePaiement(etatPaiement)
                                        if(etatPaiement === 'Paye'){
                                            $('#accordionPaiement').hide();
                                        }
                                        $('#reglerBoutonConfirmation').hide();
                                        $badgeTransaction.html('<span class=" badge bg-success text-white ms-3"><i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i>Reglé</span>');
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
                    });

                    card.append(cardBody);
                    card.append(infoButton);

                    cardTr.append(smallDate);
                    cardTr.append(card);
                });
            },

            error: function(response) {
                swal({
                    title: response.responseJSON.message,
                    icon: 'warning',
                    button: 'OK',
                    dangerMode: true,
                    closeOnClickOutside: false
                });
            }
        });
    }

    const nrTransactionDetail = document.getElementById('nrTransactionDetail');
    const dateTransactionDetail = document.getElementById('dateTransactionDetail');
    const modePaiementDetail = document.getElementById('modePaiementDetail');
    const montantTransactionDetail = document.getElementById('montantTransactionDetail');

    const chequeInputsDetail = document.getElementById('chequeInputsDetail');
    const virementInputsDetail = document.getElementById('virementInputsDetail');
    const dateChequeInputsDetail = document.getElementById('dateChequeInputsDetail');
    const banqueInputsDetail = document.getElementById('banqueInputsDetail');
    const imageInputsDetail = document.getElementById('imageInputsDetail');  

    const chequeNrDetail = document.getElementById('chequeNrDetail');
    const virementNrDetail = document.getElementById('virementNrDetail');
    const dateChequeDetail = document.getElementById('dateChequeDetail');
    const banqueDetail = document.getElementById('banqueDetail');
    const reglerBoutonConfirmation = document.getElementById('reglerBoutonConfirmation');

    let $badgeTransaction = $('#statutTransaction');

    function afficherDetailTransaction(transactionId){
        $.ajax({
            url: backendUrl +'/transaction/' + transactionId,
            type: 'GET',
            success: function(response) {
                const transactionNumDetail = response.num_transaction;
                const transactionDateDetail = response.date_transaction;
                const transactionMontantDetail = response.montant;
                const transactionModePaiementDetail = response.modePaiement;
                const transactionEtatChequeDetail = response.etat_cheque;
                const transactionNumeroChequeDetail = response.numero_cheque;
                const transactionNumeroVirementDetail = response.num_virement;
                const transactionDelaiChequeDetail = response.delais_cheque;
               

                nrTransactionDetail.value = transactionNumDetail;
                dateTransactionDetail.value = transactionDateDetail
                modePaiementDetail.value = transactionModePaiementDetail;
                montantTransactionDetail.value = transactionMontantDetail;

                if (transactionModePaiementDetail === 'cheque'){
                    chequeInputsDetail.style.display = 'block';
                    chequeNrDetail.value = transactionNumeroChequeDetail;

                    virementInputsDetail.style.display = 'none';

                    dateChequeInputsDetail.style.display = 'block';
                    dateChequeDetail.value = transactionDelaiChequeDetail;

                    banqueInputsDetail.style.display = 'block';
                    banqueDetail.value = 'Attijari';

                    imageInputsDetail.style.display = 'block';

                    if(transactionEtatChequeDetail === 'portfeuille'){
                        reglerBoutonConfirmation.style.display = 'block';
                        $badgeTransaction.html('<span class=" badge bg-danger text-white ms-3"><i class="ri-close-circle-line align-middle font-size-14 text-white pe-1"></i>PortFeuille</span>');
                    }
                    else {
                        reglerBoutonConfirmation.style.display = 'none';
                        $badgeTransaction.html('<span class=" badge bg-success text-white ms-3"><i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i>Reglé</span>');
                    }
                }

                else if(transactionModePaiementDetail === 'virement'){
                    chequeInputsDetail.style.display = 'none';
                    dateChequeInputsDetail.style.display = 'none';
                    imageInputsDetail.style.display = 'none';

                    virementInputsDetail.style.display = 'block';
                    virementNrDetail.value = transactionNumeroVirementDetail;

                    banqueInputsDetail.style.display = 'block';
                    banqueDetail.value = 'Attijari';

                    reglerBoutonConfirmation.style.display = 'none';
                    $badgeTransaction.html('<span class=" badge bg-success text-white ms-3"><i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i>Reglé</span>');
                }

                else {
                    chequeInputsDetail.style.display = 'none';
                    dateChequeInputsDetail.style.display = 'none';
                    imageInputsDetail.style.display = 'none';
                    virementInputsDetail.style.display = 'none';
                    banqueInputsDetail.style.display = 'none';
                    reglerBoutonConfirmation.style.display = 'none';
                    $badgeTransaction.html('<span class=" badge bg-success text-white ms-3"><i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i>Reglé</span>');
                }
                

            }
        })
    }

    function afficherMontantRester() {
        $.ajax({
            url: backendUrl +'/facturevente/paymentrest/' + factureId,
            type: 'GET',
            success: function(response) {
                console.log(response)
                const montantRester = response.rest;
                const montantResterFormatted = montantRester.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' Dhs';
                $('#montantRester').text(montantResterFormatted);
            },
            error: function(error) {
                console.log('Une erreur s\'est produite lors de la récupération du montant restant:', error);
            }
        });
    }

    function afficherDateEtNrTransaction(){
        $.ajax({
        url: backendUrl +'/transactions/get',
        type: 'GET',
            success: function(response) {
                console.log(response);
                document.getElementById("nrTransaction").value = response.num_transaction;
                let today = new Date();
                let dd = String(today.getDate()).padStart(2, '0');
                let mm = String(today.getMonth() + 1).padStart(2, '0');
                let yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                document.getElementById("dateTransaction").value = today;
            },
        });
    }

    const paiementButton = document.getElementById('paiementButton');
    const paiementModal = new bootstrap.Modal(document.getElementById('paiementModal'));
    const modePaiementSelect = document.getElementById('modePaiement');
    const chequeInputs = document.getElementById('chequeInputs');
    const virementInputs = document.getElementById('virementInputs');
    const montantInput = document.getElementById('montantInput');
    const dateChequeInputs = document.getElementById('dateChequeInputs');
    const imgChequeInputs = document.getElementById('imgChequeInputs');
    const enregistrerPaiementButton = document.getElementById('enregistrerPaiementButton');

    paiementButton.addEventListener('click', function() {
        paiementModal.show();
    });

    afficherDateEtNrTransaction();
    afficherMontantRester();

    modePaiementSelect.addEventListener('change', function() {
        const selectedMode = this.value;

        if (selectedMode === 'cheque') {
            chequeInputs.style.display = 'block';
            virementInputs.style.display = 'none';
            montantInput.style.display = 'block';
            dateChequeInputs.style.display = 'block';
            imgChequeInputs.style.display = 'block';
        } 
        else if (selectedMode === 'virement') {
            chequeInputs.style.display = 'none';
            dateChequeInputs.style.display = 'none';
            imgChequeInputs.style.display = 'none';
            virementInputs.style.display = 'block';
            montantInput.style.display = 'block';
        } 
        else {
            chequeInputs.style.display = 'none';
            dateChequeInputs.style.display = 'none';
            imgChequeInputs.style.display = 'none';
            virementInputs.style.display = 'none';
            montantInput.style.display = 'block';
        }
    });

    enregistrerPaiementButton.addEventListener('click', function() {

        const nrTransaction = document.getElementById('nrTransaction').value;
        const dateTransaction = document.getElementById('dateTransaction').value;
        const modePaiement = document.getElementById('modePaiement').value;
        const chequeNr = document.getElementById('chequeNr').value;
        const virementNr = document.getElementById('virementNr').value;
        const montantTransaction = document.getElementById('montantTransaction').value;
        const dateCheque = document.getElementById('dateCheque').value;
        const imgCheque = document.getElementById('imgCheque').value;

        const selectedMode = modePaiementSelect.value;
        let transactionData = {};

        if (selectedMode === 'cheque') {
            transactionData = {
                num_transaction: nrTransaction,
                date_transaction: dateTransaction,
                modePaiement: modePaiement,
                numero_cheque: chequeNr,
                montant: montantTransaction,
                delais_cheque: dateCheque,
                imgCheque: imgCheque,
                factureVente_id: factureId,
                journal_id: 1,
                bank_id: 1,
                etat_cheque: 'portfeuille'
            };
        } 
        else if (selectedMode === 'virement') {
            transactionData = {
                num_transaction: nrTransaction,
                date_transaction: dateTransaction,
                modePaiement: modePaiement,
                num_virement: virementNr,
                montant: montantTransaction,
                factureVente_id: factureId,
                journal_id: 1,
                bank_id: 1
            };
        } 
        else {
            transactionData = {
                num_transaction: nrTransaction,
                date_transaction: dateTransaction,
                modePaiement: modePaiement,
                montant: montantTransaction,
                factureVente_id: factureId,
                journal_id: 1,
            };
        }
        console.log(transactionData)

        $.ajax({
            url: backendUrl +'/transaction',
            type: 'POST',
            data: transactionData,
            success: function(response) { 
                const etatPaiement = response.EtatPaiement;  
                console.log(etatPaiement)           
                paiementModal.hide();
                swal({
                    title: response.message,
                    icon: 'success',
                    button: {
                        text: 'OK',
                        className: 'btn btn-success'
                    },
                    closeOnClickOutside: false
                }).then(function() { 
                    if(etatPaiement === "Paye"){
                        $('#accordionPaiement').hide();
                    }else {
                        $('#accordionPaiement').show();
                    }
                    afficherTransactions();    
                    afficherBadgePaiement(etatPaiement);
                    document.getElementById('nrTransaction').value = '';
                    document.getElementById('dateTransaction').value = '';
                    document.getElementById('modePaiement').value = 'Selectionner un mode';
                    document.getElementById('chequeNr').value = '';
                    document.getElementById('virementNr').value = '';
                    document.getElementById('montantTransaction').value = '';
                    document.getElementById('dateCheque').value = '';
                    document.getElementById('imgCheque').value = '';
                    afficherMontantRester();
                    afficherDateEtNrTransaction()
                });
            },
            error: function(response) {
                swal({
                    title: response.responseJSON.message,
                    icon: 'warning',
                    button: 'OK',
                    dangerMode: true,
                    closeOnClickOutside: false
                });
            }
        });
    });

    $('#imprimerAcButton').on('click', function() {
        let url = backendUrl +'/printfv/' + factureId + '/false';    
        window.open(url, '_blank');
    });
    $('#telechargerAcButton').on('click', function() {
        let url = backendUrl +'/printfv/' + factureId + '/true';    
        window.location.href = url;
    });
});


</script>

@endsection