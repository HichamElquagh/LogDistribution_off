@extends('admin.layouts.template')

@section('page-title')
    Bon Retour | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bon Retour</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Bon Retour</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Créer une facture
                        <a href="{{ route('listeRetour')}}" class="btn btn-outline-secondary btn-sm" type="submit">
                            <i class="ri-arrow-go-back-line"></i>
                        </a>
                    </div>
                    <span>
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="brnumero">Numéro du bon retour</label>
                                    <input type="text" class="form-control" name="brnumero" id="brnumero" value="{{ old('brnumero')}}" disabled/>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="brlivraison">Bon livraison</label>
                                    <select class="form-select" name="brlivraison" id="brlivraison">
                                        <option>Selectionner un bon livraison</option>
                                        @foreach($dataBl as $bl)
                                            <option value="{{$bl['id']}}">{{$bl['Numero_bonLivraison']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="brdate">Date</label>
                                    <input type="text" class="form-control" name="brdate" id="brdate" value="{{ old('brdate')}}" disabled/>
                                </div>
                            </div>
                            <table id="brtable" class="table table-striped table-bordered dt-responsive nowrap mb-4" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Article</th>
                                        <th>Prix Unitaire</th>
                                        <th>Quantité</th>
                                        <th>Total HT</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>                           
                            <div class="row">
                                <div class="mb-4 col-lg-2">
                                    <label class="form-label" for="brtva">TVA</label>
                                    <input type="number" class="form-control" name="brtva" id="brtva" value="" disabled/>
                                </div>
                                <div class="mb-4 col-lg-4">
                                    <label class="form-label" for="brraison">Raison</label>
                                    <input type="text" class="form-control" name="brraison" id="brraison" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <div class="mb-4">
                                        <label class="form-label" for="brnote">Notes</label>
                                        <textarea class="form-control" name="brnote" id="brnote" rows="4"></textarea>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="checkbox" id="brconfirme">
                                        <label class="form-check-label ms-2" for="formCheck1">
                                            Confirmer le bon retour
                                        </label>
                                    </div>
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
                        <input type="hidden" class="form-control" name="fournisseurId" id="fournisseurId"/>
                        <div class="card-footer text-center">
                            <button onclick="sendRetour()" class="btn btn-warning fw-bold text-white">Ajouter le bon retour</button>
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
    
    const bonLivraisonSelect = document.getElementById('brlivraison');
    const numeroInput = document.getElementById('brnumero');
    const dateInput = document.getElementById('brdate');
    const noteTextarea = document.getElementById('brnote');
    const raison = document.getElementById('brraison');
    const tableBody = document.getElementById('brtable').getElementsByTagName('tbody')[0];
    const backendUrl = "{{ app('backendUrl') }}";

    bonLivraisonSelect.addEventListener('change', function() {
        const bonLivraisonId = this.value;

        fetch(backendUrl +`/bonlivraison/${bonLivraisonId}`)
        .then(response => response.json())
        .then(data => {
            console.log(data.Articles);
            tableBody.innerHTML = '';

            const fournisseurId = data.fournisseur_id;
            let fournisseurIdInput = document.getElementById("fournisseurId");
            fournisseurIdInput.value = fournisseurId

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
                prixUnitaireInput.value = article.Prix_unitaire;
                prixUnitaireCell.appendChild(prixUnitaireInput);

                let quantiteCell = row.insertCell();
                let quantiteInput = document.createElement('input');
                quantiteInput.type = 'number';
                quantiteInput.name = 'quantite';
                quantiteInput.classList.add('form-control');
                quantiteInput.value = article.Quantity;
                quantiteCell.appendChild(quantiteInput);
                
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
                quantiteInput.addEventListener("input", calculTotalHt);  

                function calculTotalHt() {
                    let prixUnitaire = parseFloat(prixUnitaireInput.value);
                    let quantite = parseInt(quantiteInput.value);
                    
                    let totalHt = prixUnitaire * quantite;
                    if(prixUnitaireInput.value > 0 && quantiteInput.value > 0)
                        totalHTCell.textContent = totalHt.toFixed(2) + " dhs";
                    if(prixUnitaireInput.value == 0 || quantiteInput.value== 0)
                        totalHTCell.textContent = '0.00 dhs';
                    updateGlobalTotals();
                }
                calculTotalHt();
            });

            let tvaInput = document.getElementById('brtva');
            tvaInput.value = data.TVA;

            updateGlobalTotals();
        })
    });

let totalHtGlobalCell = document.querySelector('[data-summary-field="totalht"]');
let totalRemiseCell = document.querySelector('[data-summary-field="remise"]');
let totalTvaGlobalCell = document.querySelector('[data-summary-field="totaltva"]');
let totalTtcGlobalCell = document.querySelector('[data-summary-field="totalttc"]');

function updateGlobalTotals() {

    let tvaInput = document.querySelector('[name="brtva"]');
    let totalHtGlobal = 0;
    let totalTvaGlobal = 0;
    let totalTtcGlobal = 0;

    let rows = tableBody.rows;
    
    for (let i = 0; i < rows.length; i++) {
        let cells = rows[i].cells;
        let totalHt = parseFloat(cells[5].textContent.replace("dhs", "").trim());

        totalHtGlobal += totalHt;
        totalTvaGlobal += totalHt * (tvaInput.value / 100);
        totalTtcGlobal += totalHtGlobal + totalTvaGlobal;
    }

    totalHtGlobalCell.textContent = totalHtGlobal.toFixed(2) + " dhs";
    totalTvaGlobalCell.textContent = totalTvaGlobal.toFixed(2) + " dhs";
    totalTtcGlobalCell.textContent = totalTtcGlobal.toFixed(2) + " dhs";
}

function sendRetour() {

    const numeroBonRetour = numeroInput.value;
    const totalHtGlobal = totalHtGlobalCell.textContent.replace("dhs", "").trim();
    const totalTvaGlobal = totalTvaGlobalCell.textContent.replace("dhs", "").trim();
    const totalTtcGlobal = totalTtcGlobalCell.textContent.replace("dhs", "").trim();
    const bonLivraisonId = bonLivraisonSelect.value;
    const dateBonRetour = dateInput.value;
    const noteBonRetour = noteTextarea.value;
    const raisonBonRetour = raison.value;
    const tvaBonRetour = document.getElementById('brtva').value;
    const fournisseurId = document.getElementById('fournisseurId').value;

    let articles = [];
    let rows = tableBody.rows;
    for (let i = 0; i < rows.length; i++) {
        let cells = rows[i].cells;
        let articleId = cells[0].textContent;
        let reference = cells[1].textContent;
        let articleName = cells[2].textContent;
        let prixUnitaire = cells[3].querySelector("input[name='prixUnitaire']").value;
        let quantite = cells[4].querySelector("input[name='quantite']").value;
        let totalHt = cells[5].textContent.replace("dhs", "").trim();

        let article = {
            article_id: articleId,
            Prix_unitaire: prixUnitaire,
            Quantity: quantite,
            Total_HT: totalHt,
        };
        articles.push(article);
    }
    let confirmation;
    if(document.getElementById('brconfirme').checked) confirmation = 1;
    else confirmation = 0;

    let retour = {
        Numero_bonRetour: numeroBonRetour,
        Total_HT: totalHtGlobal,
        Total_TVA: totalTvaGlobal,
        Confirme: confirmation,
        date_BRetour: dateBonRetour,
        Total_TTC: totalTtcGlobal,
        Commentaire: noteBonRetour,
        raison: raisonBonRetour,
        TVA : tvaBonRetour,
        bonLivraison_id: bonLivraisonId,
        Articles: articles,
    };
   
    console.log(retour);

    $.ajax({
        url: backendUrl +'/bonretourachat',
        type: 'POST',
        data: retour,
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
                window.location.href = "{{ env('APP_URL') }}/bon-retour-achat/detail/" + response.id;
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

    $.ajax({
        url: backendUrl +'/getnbretour',
        type: 'GET',
        success: function(response) {
            console.log(response);
            document.getElementById("brnumero").value = response.num_bonRetour;
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0');
            let yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("brdate").value = today;
        },
    });

});

</script>

@endsection