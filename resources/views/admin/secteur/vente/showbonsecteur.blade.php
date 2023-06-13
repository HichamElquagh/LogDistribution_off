@extends('admin.layouts.template')

@section('page-title')
    Vente Secteur | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Vente Secteur</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Vente Secteur</li>
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
                                <h4 class="fw-semibold mb-2">BON SECTEUR {{$bsc['reference']}}</h4>
                                <div class="mb-1 d-flex align-items-center">
                                    <p class="pe-2 fw-bold mb-0">Date d'entrée: </p>
                                    <span class="fw-semibold pe-3">
                                        {{\Carbon\Carbon::parse($bsc['dateEntree'])->isoFormat("LL") }}
                                    </span>
                                    <span class="statut-dispo d-flex align-items-center badge text-white">
                                    </span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <p class="pe-2 fw-bold mb-0">Heure :</p>
                                    <span class="fw-semibold pe-3">
                                        {{ \Carbon\Carbon::parse($bsc['dateEntree'])->isoFormat('LT') }}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <p class="mb-0 me-2 fw-bold">Secteur :</p>
                                    <p class="mb-0">{{ $bsc['secteur'] }}</p>
                                </div>
                                <div class="d-flex align-items-center mb-1">
                                    <p class="mb-0 me-2 fw-bold">Vendeur :</p>
                                    <p class="mb-0">{{ $bsc['nomComplet1'] }}</p>
                                </div>
                                @if($bsc['nomComplet2'] != null)
                                    <div class="d-flex align-items-center mb-1">
                                        <p class="mb-0 me-2 fw-bold">Aide Vendeur :</p>
                                        <p class="mb-0">{{ $bsc['nomComplet2'] }}</p>
                                    </div>
                                @else
                                    <p class="mb-0 me-2 fw-bold">Aide Vendeur :</p>
                                @endif
                                @if($bsc['nomComplet3'] != null)
                                    <div class="d-flex align-items-center mb-1">
                                        <p class="mb-0 me-2 fw-bold">Aide Vendeur :</p>
                                        <p class="mb-0">{{ $bsc['nomComplet3'] }}</p>
                                    </div>
                                @else
                                    <p class="mb-0 me-2 fw-bold">Aide Vendeur :</p>
                                @endif
                                <div class=" mb-2 d-flex align-items-center mt-2">
                                    <p class="mb-0 me-2 fw-bold">Camion :</p>
                                    <p class="mb-0">{{ $bsc['marque'] }} - {{ $bsc['matricule'] }}</p>
                                </div>
                                <div class="d-flex align-items-center statut-paye">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table id="bonsecteurtable" class="table table-centered mb-0 align-middle table-hover table-nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Article</th>
                                    <th>Prix Unitaire</th>
                                    <th>Quantité Sortie</th>
                                    <th>Quantité Retour</th>
                                    <th>Quantité Périmé</th>
                                    <th>Quantité Gratuite</th>
                                    <th>Quantité Echange</th>
                                    <th>Quantité Crédit</th>
                                    <th>Quantité Vendu</th>
                                    <th>Total HT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bsc['Articles'] as $article)
                                    <tr>
                                        <td class="text-nowrap">{{$article['reference']}}</td>
                                        <td class="text-nowrap">{{$article['article_libelle']}}</td>
                                        <td>{{$article['qte_sortie']}}</td>
                                        <td>{{$article['qte_retourV']}}</td>
                                        <td>{{$article['qte_perime']}}</td>
                                        <td>{{$article['qte_echange']}}</td>
                                        <td>{{$article['qte_gratuit']}}</td>
                                        <td>{{$article['qte_credit']}}</td>
                                        <td>{{$article['qte_vendu']}}</td>
                                        <td>{{$article['Prix_unitaire']}}</td>
                                        <td>{{$article['Total_Vendu']}}</td>
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
                                    <td class="ps-2 py-4 text-end" width="800">
                                        <p class="fw-semibold mb-2 pt-3">{{number_format($bsc['Total_HT'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-2">{{number_format($bsc['Total_TVA'], 2, ',', ' ')}} Dhs</p>
                                        <p class="fw-semibold mb-0 pb-3">{{number_format($bsc['Total_TTC'], 2, ',', ' ')}} Dhs</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card mb-3">
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
                        <div id="accordionPaiement">
                            <button class="btn btn-light text-secondary fw-bold col-12 mb-2" id="paiementButton">Ajouter Paiement</button>
                        </div>
                        <a href="{{ route('showBonSortie', $bsc["bonSortie_id"] )}}" id="retourBonLivraison" class="btn btn-warning fw-bold text-white col-12">Bon Sortie</a>

                        <div class="modal fade" id="modalPaiement" tabindex="-1" aria-labelledby="modalPaiementLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalPaiementLabel">Ajouter Paiement</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="modal-header py-0 mb-3">
                                                <div class="row">
                                                    <div class=" col-lg-6 mb-3">
                                                        <p class=" fw-bold mb-0">Montant Du Bon Secteur</p>
                                                    </div>
                                                    <div class=" col-lg-6 text-end mb-3">   
                                                        <p class="fw-bold mb-0">{{number_format($bsc['Total_TTC'], 2, ',', ' ')}} Dhs</p>
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
                                                <label for="montant" class="form-label">Montant</label>
                                                <input type="number" class="form-control" id="montantTransaction">
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
                                                <label for="montant" class="form-label">Montant</label>
                                                <input type="text" class="form-control" id="montantTransactionDetail">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
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

    let confirme = {{ $bsc['Confirme'] }};
    let etatPaiement = '{{ $bsc['EtatPaiement']}}'; 
    let ttcBonSecteur = {{ $bsc['Total_TTC']}};
    let $statutBadge = $('.statut-dispo');
    let $badgeBonSecteur = $('.statut-paye');
    let bonSecteurId = {{ $bsc["id"] }};
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
            $badgeBonSecteur.html('<span class="fw-bold">Statut :</span><span class=" badge bg-danger text-white ms-2"><i class="ri-close-circle-line align-middle font-size-14 text-white pe-1"></i> Impayé</span>');
        } else if (etatPaiement === "En Cours") {
            $badgeBonSecteur.html('<span class="fw-bold">Statut :</span><span class=" badge bg-info text-white ms-2"><i class="ri-radio-button-line align-middle font-size-14 text-white pe-1"></i> EnCours</span>');         
        } else if (etatPaiement === "Paye") {
            $badgeBonSecteur.html('<span class="fw-bold">Statut :</span><span class=" badge bg-success text-white ms-2"><i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i> Payé</span>');
        }
    }

    $('#confirmationButton').on('click', function() {
        
        $.ajax({
            url: backendUrl +'/ventesecteur/confirme/' + bonSecteurId,
            method: 'PUT',
            success: function(response) {
                swal({
                    title: 'Confirmation réussie',
                    text: 'Le bon Secteur a été confirmé',
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
                    text: 'Une erreur s\'est produite lors de la confirmation du bon du bon secteur.',
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
            url: backendUrl +'/facture/transactions/' + bonSecteurId +'/ventesecteur' ,
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

                    const smallDate = $('<small></small>').addClass('fw-bold text-warning ms-3').text(transactionDate);

                    const card = $('<div></div>').addClass('card mb-2 mt-2');

                    const cardBody = $('<div></div>').addClass('card-body p-3');

                    const row = $('<div></div>').addClass('row align-items-center');

                    const cardTitleCol = $('<div></div>').addClass('col-lg-6');
                    const cardTextCol = $('<div></div>').addClass('col-lg-6 text-end');

                    const cardTitle = $('<span></span>').addClass('card-title mb-0 fw-bolder');

                    const badge = $('<span></span>').addClass('badge me-2');
                    badge.addClass('bg-success').text('R');
                    cardTitle.append(badge);


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
    const montantTransactionDetail = document.getElementById('montantTransactionDetail');

    let $badgeTransaction = $('#statutTransaction');

    function afficherDetailTransaction(transactionId){
        $.ajax({
            url: backendUrl +'/transaction/' + transactionId,
            type: 'GET',
            success: function(response) {
                const transactionNumDetail = response.num_transaction;
                const transactionDateDetail = response.date_transaction;
                const transactionMontantDetail = response.montant;
               

                nrTransactionDetail.value = transactionNumDetail;
                dateTransactionDetail.value = transactionDateDetail
                montantTransactionDetail.value = transactionMontantDetail;
                $badgeTransaction.html('<span class=" badge bg-success text-white ms-3"><i class="ri-checkbox-circle-line align-middle font-size-14 text-white pe-1"></i>Reglé</span>');
                
            }
        })
    }

    function afficherMontantRester() {
        $.ajax({
            url: backendUrl +'/ventesecteur/' + bonSecteurId,
            type: 'GET',
            success: function(response) {
                const montantRester = response.data.Total_Rester;
                console.log(montantRester)
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
    const modalPaiement = new bootstrap.Modal(document.getElementById('modalPaiement'));
    const enregistrerPaiementButton = document.getElementById('enregistrerPaiementButton');

    paiementButton.addEventListener('click', function() {
        modalPaiement.show();
    });

    afficherDateEtNrTransaction();
    afficherMontantRester();

    enregistrerPaiementButton.addEventListener('click', function() {

        const nrTransaction = document.getElementById('nrTransaction').value;
        const dateTransaction = document.getElementById('dateTransaction').value;
        const montantTransaction = document.getElementById('montantTransaction').value;
        let transactionData = {};

        transactionData = {
            num_transaction: nrTransaction,
            date_transaction: dateTransaction,
            modePaiement: "espece",
            montant: montantTransaction,
            venteSecteur_id: bonSecteurId,
            journal_id: 3,
        };

        console.log(transactionData)

        $.ajax({
            url: backendUrl +'/transaction',
            type: 'POST',
            data: transactionData,
            success: function(response) { 
                const etatPaiement = response.EtatPaiement;  
                console.log(etatPaiement)           
                modalPaiement.hide();
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
                    document.getElementById('montantTransaction').value = '';
                    afficherDateEtNrTransaction();
                    afficherMontantRester();
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
        let url = backendUrl +'/printvs/' + bonSecteurId + '/false';    
        window.open(url, '_blank');
    });
    $('#telechargerAcButton').on('click', function() {
        let url = backendUrl +'/printvs/' + bonSecteurId + '/true';    
        window.location.href = url;
    });
});


</script>

@endsection