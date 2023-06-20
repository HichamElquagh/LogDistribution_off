@extends('admin.layouts.template')

@section('page-title')
    Facture Achat | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Facture Achat</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Facture Achat</li>
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
                        <a href="{{ route('achatFacture')}}" class="btn btn-outline-secondary btn-sm" type="submit">
                            <i class="ri-arrow-go-back-line"></i>
                        </a>
                    </div>
                    <span>
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="facturenumero">Numéro du facture</label>
                                    <input type="text" class="form-control" name="facturenumero" id="facturenumero" value="{{ old('facturenumero')}}"/>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="facturebonlivraison">Bon livraison</label>
                                    <select class="form-select" name="facturebonlivraison" id="facturebonlivraison">
                                        <option>Selectionner un bon livraison</option>
                                        @foreach($dataBl as $bl)
                                            <option value="{{$bl['id']}}">{{$bl['Numero_bonLivraison']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="facturedate">Date</label>
                                    <input type="date" class="form-control" name="facturedate" id="facturedate" value="{{ old('facturedate')}}"/>
                                </div>
                            </div>
                            <table id="facturetable" class="table table-striped table-bordered dt-responsive nowrap mb-4" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                            <table id="avoirTable" style="display:none;">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Total TTC</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="row">
                                <div class="mb-4 col-lg-2">
                                    <label class="form-label" for="facturecondit">Condition Paiement</label>
                                    <input type="number" class="form-control" name="facturecondit" id="facturecondit" value=""/>
                                </div>
                                <div class="mb-4 col-lg-1">
                                    <label class="form-label" for="factureremise">Remise</label>
                                    <input type="number" class="form-control" name="factureremise" id="factureremise" value=""/>
                                </div>
                                <div class="mb-4 col-lg-1">
                                    <label class="form-label" for="facturetva">TVA</label>
                                    <input type="number" class="form-control" name="facturetva" id="facturetva" value=""/>
                                </div>
                                <div class="mb-3 col-lg-3">
                                    <label class="form-label" for="factureavoir">Avoir</label>
                                    <select class="form-select" name="factureavoir" id="factureavoir" disabled>
                                        <option>Selectionner une avoir</option>
                                    </select>
                                </div>
                                <div class="mb-4 col-lg-5">
                                    <label class="form-label" for="factureimage">Image facture</label>
                                    <input type="file" class="form-control" name="factureimage" id="factureimage" value="{{ old('factureimage')}}"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <div class="mb-4">
                                        <label class="form-label" for="facturenote">Notes</label>
                                        <textarea class="form-control" name="facturenote" id="facturenote" rows="4"></textarea>
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
                                                <td width="50" class="text-end fw-normal" data-summary-field="remise">0,00 dhs</td>
                                            </tr>
                                            <tr>
                                                <th width="50" class="fw-normal">Total TVA Global</th>
                                                <td width="50" class="text-end" data-summary-field="totaltva">0,00 dhs</td>
                                            </tr>
                                            <tr>
                                                <th width="50" class="fw-bold">Total TTC Global</th>
                                                <td width="50" class="text-end fw-bold" data-summary-field="totalttc">0,00 dhs</td>
                                            </tr>
                                            <tr style="display: none" id="totalAvoirRow">
                                                <th width="50" class="fw-normal">Total Avoirs Global</th>
                                                <td width="50" class="text-end" data-summary-field="totalAvoir">- 0,00 dhs</td>
                                            </tr>
                                            <tr style="display: none" id="totalPayerRow">
                                                <th width="50" class="fw-bold">Total À Payé</th>
                                                <td width="50" class="text-end fw-bold" data-summary-field="totalPayé">0,00 dhs</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="fournisseurId" id="fournisseurId"/>
                        <div class="card-footer text-center">
                            <button onclick="sendFacture()" class="btn btn-warning fw-bold text-white">Ajouter la facture</button>
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
            Cet Avoir a déjà été sélectionné. Veuillez sélectionner une autre avoir si elle existe!.
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
    
    const bonLivraisonSelect = document.getElementById('facturebonlivraison');
    const numeroInput = document.getElementById('facturenumero');
    const dateInput = document.getElementById('facturedate');
    const noteTextarea = document.getElementById('facturenote');
    const tableBody = document.getElementById('facturetable').getElementsByTagName('tbody')[0];
    const imageInput = document.getElementById('factureimage');
    const factureAvoirSelect = document.getElementById('factureavoir');
    const conditionInput = document.getElementById('facturecondit');
    const backendUrl = "{{ app('backendUrl') }}";

    bonLivraisonSelect.addEventListener('change', function() {
        const bonLivraisonId = this.value;

        fetch(backendUrl +`/bonlivraison/${bonLivraisonId}`)
        .then(response => response.json())
        .then(data => {
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
                totalHTCell.textContent = '0,00 dhs';
                
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
                        totalHTCell.textContent = '0,00 dhs';
                    updateGlobalTotals();
                }
                calculTotalHt();
            });
            let remiseInput = document.getElementById('factureremise');
            remiseInput.value = data.remise;

            let tvaInput = document.getElementById('facturetva');
            tvaInput.value = data.TVA;

            updateGlobalTotals();
        })

        factureAvoirSelect.innerHTML = '<option value="">Sélectionner une avoir</option>';
    
        fetch(backendUrl + `/getunlinkedavoirs/${bonLivraisonId}`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                factureAvoirSelect.disabled = false;
            } else {
                factureAvoirSelect.disabled = true;
            }
            
            data.forEach(avoir => {
                const option = document.createElement('option');
                option.value = avoir.id;
                option.textContent = avoir.numero_avoirsAchat;
                factureAvoirSelect.appendChild(option);
            });
        });
    });

    let selectedAvoirIds = [];
    let table = document.querySelector("#avoirTable");
    let totalHtGlobalCell = document.querySelector('[data-summary-field="totalht"]');
    let totalRemiseCell = document.querySelector('[data-summary-field="remise"]');
    let totalTvaGlobalCell = document.querySelector('[data-summary-field="totaltva"]');
    let totalTtcGlobalCell = document.querySelector('[data-summary-field="totalttc"]');
    let totalAvoirGlobalCell = document.querySelector('[data-summary-field="totalAvoir"]');
    let totalPayerCell = document.querySelector('[data-summary-field="totalPayé"]');
    let totalAvoirTtc = 0;
    let totalAvoirRow = document.querySelector('#totalAvoirRow');
    let totalPayerRow = document.querySelector('#totalPayerRow');

    factureAvoirSelect.addEventListener("change", function(){
        
        let avoirId = this.value;

        if (selectedAvoirIds.includes(avoirId)) {
            document.querySelector("#showModalPopup").click();
            return;
        }

        fetch(backendUrl +'/avoirsachat/' + avoirId)
            .then(response => response.json())
            .then(data => {
            let row = table.insertRow();
            
            let idCell = row.insertCell();
            let totalHTCell = row.insertCell();

            idCell.innerHTML = data["data"].id;
            totalHTCell.innerHTML = data["data"].Total_TTC;

            selectedAvoirIds.push(avoirId); 
            totalAvoirTtc += parseFloat(data["data"].Total_TTC); // Ajouter le montant de l'avoir au totalAvoirTtc
            
            totalAvoirGlobalCell.textContent = "- " +totalAvoirTtc.toFixed(2) + " dhs";
            totalAvoirRow.style.display = "table-row";
            updateGlobalTotals();
        });
    });

    function updateGlobalTotals() {
        let remiseInput = document.querySelector('[name="factureremise"]');
        let tvaInput = document.querySelector('[name="facturetva"]');
        remiseInput.addEventListener("input", updateGlobalTotals);
        tvaInput.addEventListener("input", updateGlobalTotals);
        let totalHtGlobal = 0;
        let totalTvaGlobal = 0;
        let totalTtcGlobal = 0;
        let totalAPayer = 0;

        let rows = tableBody.rows;

        for (let i = 0; i < rows.length; i++) {
            let cells = rows[i].cells;
            let totalHt = parseFloat(cells[5].textContent.replace(" dhs", "").trim());

            totalHtGlobal += totalHt;
            totalTvaGlobal += totalHt * (tvaInput.value / 100);
        }

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

        totalHtGlobalCell.textContent = totalHtGlobal.toFixed(2) + " dhs";

        if (remise && remise > totalHtGlobal) {
            totalRemiseCell.textContent = totalHtGlobal.toFixed(2) + " dhs";
        } else if (remise) {
            totalRemiseCell.textContent = remise.toFixed(2) + " dhs";
        } else {
            totalRemiseCell.textContent = "0.00 dhs";
        }

        totalTvaGlobalCell.textContent = totalTvaGlobal.toFixed(2) + " dhs";
        totalTtcGlobalCell.textContent = totalTtcGlobal.toFixed(2) + " dhs";

        let totalAvoirGlobal = 0;
        let avoirRows = table.rows;

        for (let i = 1; i < avoirRows.length; i++) {
            let avoirCell = avoirRows[i].cells[1];
            let totalAvoir = parseFloat(avoirCell.textContent.replace("- ", "").replace(" dhs", ""));
            totalAvoirGlobal += totalAvoir;
        }

        totalAPayer = totalTtcGlobal - totalAvoirGlobal;
        totalPayerCell.textContent = totalAPayer.toFixed(2) + " dhs";

        if (selectedAvoirIds.length > 0) {
            totalPayerRow.style.display = "table-row";
        }
    }


    function sendFacture() {
        const formData = new FormData();

        formData.append('numero_Facture', numeroInput.value);
        formData.append('Total_HT', totalHtGlobalCell.textContent.replace("dhs", "").trim());
        formData.append('Total_TVA', totalTvaGlobalCell.textContent.replace("dhs", "").trim());
        formData.append('Confirme', 0);
        let hasAvoirs = selectedAvoirIds.length > 0 ? 1 : 0;
        formData.append('hasAvoirs', hasAvoirs);
        // formData.append('isChange', 0);
        formData.append('remise', totalRemiseCell.textContent.replace("dhs", "").trim());
        formData.append('date_Facture', dateInput.value);
        formData.append('Total_TTC', totalTtcGlobalCell.textContent.replace("dhs", "").trim());
        formData.append('fournisseur_id', document.getElementById('fournisseurId').value);
        formData.append('Commentaire', noteTextarea.value);
        formData.append('conditionPaiement', conditionInput.value);
        formData.append('TVA', document.getElementById('facturetva').value);
        formData.append('bonLivraison_id', bonLivraisonSelect.value);
        formData.append('Code_journal', 'Achat');
        const selectedImage = imageInput.files[0];
        formData.append('attachement', selectedImage);

        let rows = tableBody.rows;
        for (let i = 0; i < rows.length; i++) {
            let cells = rows[i].cells;
            let articleId = cells[0].textContent;
            let reference = cells[1].textContent;
            let articleName = cells[2].textContent;
            let prixUnitaire = cells[3].querySelector("input[name='prixUnitaire']").value;
            let quantite = cells[4].querySelector("input[name='quantite']").value;
            let totalHt = cells[5].textContent.replace("dhs", "").trim();

            formData.append(`Articles[${i}][article_id]`, articleId);
            formData.append(`Articles[${i}][reference]`, reference);
            formData.append(`Articles[${i}][article_libelle]`, articleName);
            formData.append(`Articles[${i}][Prix_unitaire]`, prixUnitaire);
            formData.append(`Articles[${i}][Quantity]`, quantite);
            formData.append(`Articles[${i}][Total_HT]`, totalHt);
        }

        let avoirRows = table.rows;
        let selectedAvoirs = [];

        for (let i = 0; i < avoirRows.length; i++) {
            let cells = avoirRows[i].cells;
            let avoirId = cells[0].textContent;

            if (avoirId && avoirId !== "id") {
                selectedAvoirs.push(avoirId);
                formData.append(`Avoirs[${i}]`, avoirId);
            }
        }

        const entries = formData.entries();
        const data = {};

        for (let pair of entries) {
        data[pair[0]] = pair[1];
        }

        console.log(data);

        $.ajax({
            url: backendUrl + '/facture',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                swal({
                    title: response.message,
                    icon: "success",
                    button: {
                        text: "OK",
                        className: "btn btn-success"
                    },
                    closeOnClickOutside: false
                }).then(function () {
                    window.location.href = "{{ env('APP_URL') }}/facture-achat/detail/" + response.id;
                });
            },
            error: function (response) {
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


</script>

@endsection