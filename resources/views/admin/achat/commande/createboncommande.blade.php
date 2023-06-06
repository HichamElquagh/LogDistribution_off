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
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Créer un bon de commande
                        <a href="{{ route('listeCommande') }}" class="btn btn-outline-secondary btn-sm" type="submit">
                            <i class="ri-arrow-go-back-line"></i>
                        </a>
                    </div>
                    <span>
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="bcnumero">Numéro du bon de commande</label>
                                    <input type="text" class="form-control" name="bcnumero" id="bcnumero" value="{{ old('bcnumero')}}" disabled/>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="bcfournisseur">Fournisseurs</label>
                                    <select class="form-select" name="bcfournisseur" id="bcfournisseur">
                                        <option value="">Selectionner un fournisseur</option>
                                        @foreach($dataFournisseur as $fournisseur)
                                            <option value="{{$fournisseur['id']}}">{{$fournisseur['fournisseur']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="bcdate">Date</label>
                                    <input type="text" class="form-control" name="bcdate" id="bcdate" value="{{ old('bcdate')}}" disabled/>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="bcarticle">Articles</label>
                                <select class="form-select" name="bcarticle" id="bcarticle">
                                    <option>Selectionner un article</option>
                                </select>
                            </div>
                            <table id="bctable" class="table table-striped table-bordered dt-responsive nowrap mb-4" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                            </table>
                            <div class="row">
                                <div class="col-lg-4 mb-4">
                                    <label class="form-label" for="bcremise">Remise</label>
                                    <input type="number" class="form-control" name="bcremise" id="bcremise" value="{{ old('bcremise')}}"/>
                                </div>
                                <div class="col-lg-2 mb-4">
                                    <label class="form-label" for="bctva">Taux TVA</label>
                                    <input type="number" class="form-control" name="bctva" id="bctva" value="{{ old('bctva')}}"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <div class="mb-4">
                                        <label class="form-label" for="bcnote">Notes</label>
                                        <textarea class="form-control" name="bcnote" id="bcnote" rows="4"></textarea>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="checkbox" id="bcconfirm">
                                        <label class="form-check-label ms-2" for="formCheck1">
                                            Confirmer le bon commande
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <table id="summary" class="table stacked mb-0">
                                        <tbody>
                                            <tr>
                                                <th width="50" class="fw-normal">Total HT Global</th>
                                                <td width="50" class="text-end" data-summary-field="totalht">0,00 dhs</td>
                                            </tr>
                                            <tr>
                                                <th width="50" class="fw-normal">Remise</th>
                                                <td width="50" class="text-end" data-summary-field="remise" class="fw-normal">0,00 dhs</td>
                                            </tr>
                                            <tr>
                                                <th width="50" class="fw-normal">Total TVA Global</th>
                                                <td width="50" class="text-end" data-summary-field="totaltva">0,00 dhs</td>
                                            </tr>
                                            <tr>
                                                <th width="50" class="fw-bold">Total TTC Global</th>
                                                <td width="50" class="text-end" data-summary-field="totalttc" class="fw-bold">0,00 dhs</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button onclick="sendCommande()" class="btn btn-warning fw-bold text-white">Ajouter le bon de commande</button>
                        </div>
                    </span>
                </div>
            </div>
        </div>

    </div> 
</div>

<!-- Button trigger modal -->
<span id="showModalPopup" class="hide" data-bs-toggle="modal" data-bs-target="#exampleModal"></span>
  
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Erreur</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Cet article a déjà été sélectionné. Veuillez sélectionner un autre article.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-warning text-white" data-bs-dismiss="modal">Ok</button>
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

    const articleSelect = document.getElementById('bcarticle');
    const referenceInput = document.getElementById('bcnumero');
    const fournisseurSelect = document.getElementById('bcfournisseur');
    const dateSelect = document.getElementById('bcdate');
    const backendUrl = "{{ app('backendUrl') }}";

    function disableArticleSelect() {
        articleSelect.disabled = true;
    }

    function enableArticleSelect() {
        articleSelect.disabled = false;
    }

    function checkConditions() {
        if (referenceInput.value == '' || fournisseurSelect.value == '' || dateSelect.value == '') {
            disableArticleSelect();
        } else {
            enableArticleSelect();
        }
    }

    fournisseurSelect.addEventListener('change', checkConditions);

    checkConditions();


    let selectedArticleIds = [];
    let table = document.querySelector("#bctable");
    let totalHtGlobalCell = document.querySelector('[data-summary-field="totalht"]');
    let totalRemiseCell = document.querySelector('[data-summary-field="remise"]');
    let totalTvaGlobalCell = document.querySelector('[data-summary-field="totaltva"]');
    let totalTtcGlobalCell = document.querySelector('[data-summary-field="totalttc"]');

    document.getElementById("bcarticle").addEventListener("change", function(){
        
        let articleId = this.value;

        if (selectedArticleIds.includes(articleId)) {
            document.querySelector("#showModalPopup").click();
            return;
        }

        fetch(backendUrl +'/articles/' + articleId)
        .then(response => response.json())
        .then(data => {

            let row = table.insertRow();
            
            let idCell = row.insertCell();
            let referenceCell = row.insertCell();
            let articleCell = row.insertCell();
            let prixUnitaireCell = row.insertCell();
            let quantiteCell = row.insertCell();
            let totalHTCell = row.insertCell();
            let deleteCell = row.insertCell();

            idCell.innerHTML = data["Article Requested"].id;
            referenceCell.innerHTML = data["Article Requested"].reference;
            idCell.style.display = 'none'
            articleCell.innerHTML = data["Article Requested"].article_libelle;
            prixUnitaireCell.innerHTML = '<input type="number" class="form-control" name="prixUnitaire" value="" />';
            quantiteCell.innerHTML = '<input type="number" class="form-control" name="quantite" value="" />';
            totalHTCell.innerHTML = '0,00 dhs';



            let deleteButton = document.createElement("button");
            deleteButton.classList.add("btn", "btn-sm", "btn-outline-danger");
            
            let deleteIcon = document.createElement("i");
            deleteIcon.classList.add("fas", "fa-trash-alt");
            deleteButton.appendChild(deleteIcon);
            deleteButton.addEventListener("click", function() {
                row.remove();
                let index = selectedArticleIds.indexOf(articleId);
                if (index > -1) {
                    selectedArticleIds.splice(index, 1);
                }
                updateGlobalTotals()
            });

            deleteCell.appendChild(deleteButton);

            selectedArticleIds.push(articleId); 

            let prixUnitaireInput = prixUnitaireCell.querySelector("input[name='prixUnitaire']");
            let quantiteInput = quantiteCell.querySelector("input[name='quantite']");
            prixUnitaireInput.addEventListener("input", calculTotalHt);
            quantiteInput.addEventListener("input", calculTotalHt);  

            function calculTotalHt() {
                let prixUnitaire = parseFloat(prixUnitaireInput.value);
                let quantite = parseInt(quantiteInput.value);
                
                let totalHt = prixUnitaire * quantite;
                if(prixUnitaireInput.value > 0 && quantiteInput.value > 0)
                    totalHTCell.innerHTML = totalHt.toFixed(2) + " dhs";
                if(prixUnitaireInput.value == 0 || quantiteInput.value== 0)
                    totalHTCell.innerHTML = '0,00 dhs';
                updateGlobalTotals();
            }
            updateGlobalTotals()
        });
        
    });
    
function updateGlobalTotals() {
    let remiseInput = document.querySelector('[name="bcremise"]')
    let tvaInput = document.querySelector('[name="bctva"]');
    remiseInput.addEventListener("input", updateGlobalTotals);
    tvaInput.addEventListener("input", updateGlobalTotals);
    let totalHtGlobal = 0;
    let totalTvaGlobal = 0;
    let totalTtcGlobal = 0;

    let rows = table.rows;
    for (let i = 1; i < rows.length; i++) {
        let cells = rows[i].cells;
        let totalHt = parseFloat(cells[5].textContent.replace("dhs", "").trim());

        totalHtGlobal += totalHt;
        totalTvaGlobal += totalHt * (tvaInput.value / 100);

        let remise = parseFloat(remiseInput.value);

        if (remise && remise <= totalHtGlobal) {
            totalTvaGlobal = totalHtGlobal * (tvaInput.value / 100);
            totalTtcGlobal = totalHtGlobal - remise + totalTvaGlobal;
        } else if (remise && remise > totalHtGlobal) {
            remise = totalHtGlobal;
            totalTvaGlobal = totalHtGlobal * (tvaInput.value / 100);
            totalTtcGlobal = totalHtGlobal - remise + totalTvaGlobal;
        } else {
            totalTtcGlobal = totalHtGlobal + totalTvaGlobal;
        }
    }

    totalHtGlobalCell.textContent = totalHtGlobal.toFixed(2) + " dhs";

    if (remiseInput.value && parseFloat(remiseInput.value) > totalHtGlobal) {
        totalRemiseCell.textContent = totalHtGlobal.toFixed(2) + " dhs";
    } else if (remiseInput.value) {
        totalRemiseCell.textContent = parseFloat(remiseInput.value).toFixed(2) + " dhs";
    } else {
        totalRemiseCell.textContent = "0.00 dhs";
    }
    
    totalTvaGlobalCell.textContent = totalTvaGlobal.toFixed(2) + " dhs";
    totalTtcGlobalCell.textContent = totalTtcGlobal.toFixed(2) + " dhs";
}
    

function sendCommande() {
    let selectedValues = [];
    let selectBox = document.getElementById("bcarticle");
    for (let i = 0; i < selectBox.options.length; i++) {
        if (selectBox.options[i].selected) {
            selectedValues.push(selectBox.options[i].value);
        }
    }
    const numeroBonCommande = document.getElementById('bcnumero').value;
    const totalHtGlobal = totalHtGlobalCell.textContent.replace("dhs", "").trim();
    const totalTvaGlobal = totalTvaGlobalCell.textContent.replace("dhs", "").trim();
    const totalRemiseGlobal = totalRemiseCell.textContent.replace("dhs", "").trim();
    const totalTtcGlobal = totalTtcGlobalCell.textContent.replace("dhs", "").trim();
    const fournisseurId = fournisseurSelect.value;
    const dateBonCommande = dateSelect.value;
    const noteBonCommande = document.getElementById('bcnote').value;
    const tvaBonCommande = document.getElementById('bctva').value;

    let articles = [];
    let rows = table.rows;
    for (let i = 1; i < rows.length; i++) {
        let cells = rows[i].cells;
        let idarticle = cells[0].textContent;
        let reference = cells[1].textContent;
        let articleName = cells[2].textContent;
        let prixUnitaire = cells[3].querySelector("input[name='prixUnitaire']").value;
        let quantite = cells[4].querySelector("input[name='quantite']").value;
        let totalHt = cells[5].textContent.replace("dhs", "").trim();

        let article = {
            article_id: idarticle,
            Prix_unitaire: prixUnitaire,
            Quantity: quantite,
            Total_HT: totalHt,
        };
        articles.push(article);
    }
    let confirmation;
    if(document.getElementById('bcconfirm').checked) confirmation = 1;
    else confirmation = 0;

    let commande = {
        Numero_bonCommande: numeroBonCommande,
        Total_HT: totalHtGlobal,
        Total_TVA: totalTvaGlobal,
        Confirme: confirmation,
        remise: totalRemiseGlobal,
        date_BCommande: dateBonCommande,
        Total_TTC: totalTtcGlobal,
        fournisseur_id: fournisseurId,
        Commentaire: noteBonCommande,
        TVA : tvaBonCommande,
        Articles: articles
    };
   
    console.log(commande);

    $.ajax({
        url: backendUrl +'/boncommande',
        type: 'POST',
        data: commande,
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
                window.location.href = "{{ env('APP_URL') }}/bon-commande-achat/detail/" + response.id;
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

    $('#bcfournisseur').on('change', function() {
        const fournisseurId = $(this).val();
        
        $.ajax({
            url: backendUrl +'/articlefr/' + fournisseurId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#bcarticle').empty();
                $('#bcarticle').append('<option value="">Selectionner un article</option>');
                $.each(response.articles, function(index, article) {
                    $('#bcarticle').append('<option value="' + article.id + '">' + article.article_libelle + '</option>');
                });
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    $.ajax({
        url: backendUrl +'/getnbc',
        type: 'GET',
        success: function(response) {
            console.log(response);
            document.getElementById("bcnumero").value = response.Numero_bonCommande;
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0');
            let yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("bcdate").value = today;
        },
    });

});

</script>
    
@endsection
