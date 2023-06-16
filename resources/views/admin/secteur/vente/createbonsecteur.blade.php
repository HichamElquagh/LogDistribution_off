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
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Créer une vente secteur
                        <a href="{{ route('listeBonSecteur')}}" class="btn btn-outline-secondary btn-sm" type="submit">
                            <i class="ri-arrow-go-back-line"></i>
                        </a>
                    </div>
                    <span>
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="ventesecteurnum">Numéro du vente secteur</label>
                                    <input type="text" class="form-control" name="ventesecteurnum" id="ventesecteurnum" value="{{ old('ventesecteurnum')}}" disabled/>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="ventesecteursortie">Bon sortie</label>
                                    <select class="form-select" name="ventesecteursortie" id="ventesecteursortie">
                                        <option>Selectionner un bon sortie</option>
                                        @foreach($dataBs as $bs)
                                            <option value="{{$bs['id']}}">{{$bs['reference']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="ventesecteurdate">Date</label>
                                    <input type="text" class="form-control" name="ventesecteurdate" id="ventesecteurdate" value="{{ old('ventesecteurdate')}}" disabled/>
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
                                            <th>Supprimer</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="mb-4 col-lg-3">
                                    <label class="form-label" for="bonsecteurkilometrage">Kilométrage d'entrée</label>
                                    <input type="number" class="form-control" name="bonsecteurkilometrage" id="bonsecteurkilometrage" value=""/>
                                </div>
                                <div class="mb-4 col-lg-3">
                                    <label class="form-label" for="bonsecteurtva">TVA</label>
                                    <input type="number" class="form-control" name="bonsecteurtva" id="bonsecteurtva" value=""/>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <table id="summary" class="table stacked mb-0">
                                        <tbody>
                                            <tr>
                                                <th width="50" class="fw-normal">Total HT Global</th>
                                                <td width="50" class="text-end" data-summary-field="totalht">0.00 dhs</td>
                                            </tr>
                                            <tr>
                                                <th width="50" class="fw-normal">Total TVA Global</th>
                                                <td width="50" class="text-end" data-summary-field="totaltva">0.00 dhs</td>
                                            </tr>
                                            <tr>
                                                <th width="50" class="fw-bold">Total TTC Global</th>
                                                <td width="50" class="text-end" data-summary-field="totalttc" class="fw-bold">0.00 dhs</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="vendeurId" id="vendeurId"/>
                        <input type="hidden" class="form-control" name="aideVendeurIdOne" id="aideVendeurIdOne"/>
                        <input type="hidden" class="form-control" name="aideVendeurIdTwo" id="aideVendeurIdTwo"/>
                        <div class="card-footer text-center">
                            <button onclick="sendBonSecteur()" class="btn btn-warning fw-bold text-white">Ajouter le bon secteur</button>
                        </div>
                    </span>
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
    
    const bonSortieSelect = document.getElementById('ventesecteursortie');
    const numeroInput = document.getElementById('ventesecteurnum');
    const dateInput = document.getElementById('ventesecteurdate');
    const noteTextarea = document.getElementById('bonsecteurnote');
    const tableBody = document.getElementById('bonsecteurtable').getElementsByTagName('tbody')[0];
    const backendUrl = "{{ app('backendUrl') }}";
    
    bonSortieSelect.addEventListener('change', function() {
        const bonSortieId = this.value;

        fetch(backendUrl +`/bonsortie/${bonSortieId}`)
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = '';

            let numeroBonSortie = data.reference;
        
            numeroInput.value = numeroBonSortie;

            let vendeurId = data.vendeur_id;
            let vendeurIdInput = document.getElementById("vendeurId");
            vendeurIdInput.value = vendeurId

            let aideVendeurIdOne = data.aideVendeur_id;
            let aideVendeurIdOneInput = document.getElementById("aideVendeurIdOne");
            aideVendeurIdOneInput.value = (aideVendeurIdOne) ? aideVendeurIdOne : null;

            let aideVendeurIdTwo = data.aideVendeur2_id;
            let aideVendeurIdTwoInput = document.getElementById("aideVendeurIdTwo");
            aideVendeurIdTwoInput.value = (aideVendeurIdTwo) ? aideVendeurIdTwo : null;

            data.Articles.forEach(article => {
                let row = tableBody.insertRow();

                let idCell = row.insertCell();
                idCell.innerHTML = article.article_id;
                idCell.style.display = 'none'

                let referenceCell = row.insertCell();
                referenceCell.textContent = article.reference;
                
                let articleCell = row.insertCell();
                articleCell.textContent = article.article_libelle;
                
                let prixUnitaireCell = row.insertCell();
                let prixUnitaireInput = document.createElement('input');
                prixUnitaireInput.type = 'number';
                prixUnitaireInput.name = 'prixUnitaire';
                prixUnitaireInput.classList.add('form-control');
                prixUnitaireCell.appendChild(prixUnitaireInput);

                let quantiteSortieCell = row.insertCell();
                let quantiteSortieInput = document.createElement('input');
                quantiteSortieInput.type = 'number';
                quantiteSortieInput.name = 'quantiteSortie';
                quantiteSortieInput.classList.add('form-control');
                quantiteSortieInput.value = article.QuantitySortie;
                quantiteSortieCell.appendChild(quantiteSortieInput);

                let quantiteRetourCell = row.insertCell();
                let quantiteRetourInput = document.createElement('input');
                quantiteRetourInput.type = 'number';
                quantiteRetourInput.name = 'quantiteRetour';
                quantiteRetourInput.classList.add('form-control');
                quantiteRetourCell.appendChild(quantiteRetourInput);

                let quantitePerimeCell = row.insertCell();
                let quantitePerimeInput = document.createElement('input');
                quantitePerimeInput.type = 'number';
                quantitePerimeInput.name = 'quantitePerime';
                quantitePerimeInput.classList.add('form-control');
                quantitePerimeCell.appendChild(quantitePerimeInput);

                let quantiteGratuitCell = row.insertCell();
                let quantiteGratuitInput = document.createElement('input');
                quantiteGratuitInput.type = 'number';
                quantiteGratuitInput.name = 'quantiteGratuit';
                quantiteGratuitInput.classList.add('form-control');
                quantiteGratuitCell.appendChild(quantiteGratuitInput);

                let quantiteEchangeCell = row.insertCell();
                let quantiteEchangeInput = document.createElement('input');
                quantiteEchangeInput.type = 'number';
                quantiteEchangeInput.name = 'quantiteEchange';
                quantiteEchangeInput.classList.add('form-control');
                quantiteEchangeCell.appendChild(quantiteEchangeInput);

                let quantiteCreditCell = row.insertCell();
                let quantiteCreditInput = document.createElement('input');
                quantiteCreditInput.type = 'number';
                quantiteCreditInput.name = 'quantiteCredit';
                quantiteCreditInput.classList.add('form-control');
                quantiteCreditCell.appendChild(quantiteCreditInput);

                let quantiteVenduCell = row.insertCell();
                let quantiteVenduInput = document.createElement('input');
                quantiteVenduInput.type = 'number';
                quantiteVenduInput.name = 'quantiteVendu';
                quantiteVenduInput.classList.add('form-control');
                quantiteVenduCell.appendChild(quantiteVenduInput);
                
                let totalHTCell = row.insertCell();
                totalHTCell.textContent = '0.00 dhs';
                
                let deleteCell = row.insertCell();
                let deleteButton = document.createElement("button");
                deleteButton.classList.add("btn", "btn-sm", "btn-outline-danger");
                
                let deleteIcon = document.createElement("i");
                deleteIcon.classList.add("fas", "fa-trash-alt");
                deleteButton.appendChild(deleteIcon);
                
                deleteButton.addEventListener('click', function() {
                    tableBody.removeChild(row);
                    updateGlobalTotals()
                });
                deleteCell.appendChild(deleteButton);

                prixUnitaireInput.addEventListener("input", calculTotalHt);
                quantiteVenduInput.addEventListener("input", calculTotalHt);  

                function calculTotalHt() {
                    let prixUnitaire = parseFloat(prixUnitaireInput.value);
                    let quantite = parseInt(quantiteVenduInput.value);
                    
                    let totalHt = prixUnitaire * quantite;
                    if(prixUnitaireInput.value > 0 && quantiteVenduInput.value > 0)
                        totalHTCell.textContent = totalHt.toFixed(2) + " dhs";
                    if(prixUnitaireInput.value == 0 || quantiteVenduInput.value== 0)
                        totalHTCell.textContent = '0.00 dhs';
                    updateGlobalTotals();
                }
                calculTotalHt();
            });

            let tvaInput = document.getElementById('bonsecteurtva');
            tvaInput.value = data.TVA;

            updateGlobalTotals();
        })
    });

let totalHtGlobalCell = document.querySelector('[data-summary-field="totalht"]');
let totalTvaGlobalCell = document.querySelector('[data-summary-field="totaltva"]');
let totalTtcGlobalCell = document.querySelector('[data-summary-field="totalttc"]');

function updateGlobalTotals() {

    let tvaInput = document.querySelector('[name="bonsecteurtva"]');
    tvaInput.addEventListener("input", updateGlobalTotals);
    let totalHtGlobal = 0;
    let totalTvaGlobal = 0;
    let totalTtcGlobal = 0;

    let rows = tableBody.rows;
    
    for (let i = 0; i < rows.length; i++) {
        let cells = rows[i].cells;
        let totalHt = parseFloat(cells[11].textContent.replace("dhs", "").trim());

        totalHtGlobal += totalHt;
        totalTvaGlobal += totalHt * (tvaInput.value / 100);
        totalTtcGlobal += totalHtGlobal + totalTvaGlobal;
    }

    totalHtGlobalCell.textContent = totalHtGlobal.toFixed(2) + " dhs";
    totalTvaGlobalCell.textContent = totalTvaGlobal.toFixed(2) + " dhs";
    totalTtcGlobalCell.textContent = totalTtcGlobal.toFixed(2) + " dhs";
}

function sendBonSecteur() {

    const numeroBonSecteur = numeroInput.value;
    const totalHtGlobal = totalHtGlobalCell.textContent.replace("dhs", "").trim();
    const totalTvaGlobal = totalTvaGlobalCell.textContent.replace("dhs", "").trim();
    const totalTtcGlobal = totalTtcGlobalCell.textContent.replace("dhs", "").trim();
    const bonSecteurId = bonSortieSelect.value;
    const dateBonSecteur = dateInput.value;
    const tvaBonSecteur = document.getElementById('bonsecteurtva').value;
    const vendeurId = document.getElementById('vendeurId').value;
    const kilometrageEntree = document.getElementById('bonsecteurkilometrage').value;

    let articles = [];
    let rows = tableBody.rows;
    for (let i = 0; i < rows.length; i++) {
        let cells = rows[i].cells;
        let articleId = cells[0].textContent;
        let prixUnitaire = cells[3].querySelector("input[name='prixUnitaire']").value;
        let quantiteSortie = cells[4].querySelector("input[name='quantiteSortie']").value;
        let quantiteRetour = cells[5].querySelector("input[name='quantiteRetour']").value;
        let quantitePerime = cells[6].querySelector("input[name='quantitePerime']").value;
        let quantiteGratuit = cells[7].querySelector("input[name='quantiteGratuit']").value;
        let quantiteEchange = cells[8].querySelector("input[name='quantiteEchange']").value;
        let quantiteCredit = cells[9].querySelector("input[name='quantiteCredit']").value;
        let quantiteVendu = cells[10].querySelector("input[name='quantiteVendu']").value;
        let totalHt = cells[11].textContent.replace("dhs", "").trim();

        let article = {
            article_id: articleId,
            Prix_unitaire: prixUnitaire,
            qte_sortie: quantiteSortie,
            qte_retourV: (quantiteRetour) ? quantiteRetour : "0",
            qte_perime: (quantitePerime) ? quantitePerime : "0",
            qte_gratuit: (quantiteGratuit) ? quantiteGratuit : "0",
            qte_echange: (quantiteEchange) ? quantiteEchange : "0",
            qte_credit: (quantiteCredit) ? quantiteCredit : "0",
            qte_vendu: (quantiteVendu) ? quantiteVendu : "0",
            Total_Vendu: totalHt,
        };
        articles.push(article);
    }

    let bonsecteur = {
        Total_HT: totalHtGlobal,
        Total_TVA: totalTvaGlobal,
        Confirme: 0,
        dateEntree: dateBonSecteur,
        Total_TTC: totalTtcGlobal,
        TVA : tvaBonSecteur,
        bonSortie_id: bonSecteurId,
        kilometrageFait: kilometrageEntree,
        Articles: articles,
    };
   
    console.log(bonsecteur);

    $.ajax({
        url: backendUrl +'/ventesecteur',
        type: 'POST',
        data: bonsecteur,
        success: function(response) {
            swal({
                title: response.message,
                icon: "success",
                button: {
                    text: "OK",
                    className: "btn btn-success" 
                },
                closeOnClickOutside: false
            }).then(function() {
                window.location.href = "{{ env('APP_URL') }}/bon-vente-secteur/detail/" + response.id;
            });
        },
        error: function(response) {
            swal({
                title: response.responseJSON.message,
                icon: "warning",

                button: "OK",
                dangerMode: true,
                closeOnClickOutside: false
            });
        }        
    });
}

$(document).ready(function() {

    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0');
    let yyyy = today.getFullYear();
    let h = String(today.getHours()).padStart(2, '0');
    let m = String(today.getMinutes()).padStart(2, '0');
    let s = String(today.getSeconds()).padStart(2, '0');

    today = yyyy + '-' + mm + '-' + dd + ' ' + h + ':' + m + ':' + s;
    document.getElementById("ventesecteurdate").value = today;

});

</script>

@endsection