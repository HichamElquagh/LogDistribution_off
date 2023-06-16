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
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Créer un bon de sortie
                        <a href="{{ route('listeSortieSecteur') }}" class="btn btn-outline-secondary btn-sm" type="submit">
                            <i class="ri-arrow-go-back-line"></i>
                        </a>
                    </div>
                    <span>
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="bsnumero">Numéro du bon de sortie</label>
                                    <input type="text" class="form-control" name="bsnumero" id="bsnumero" value="{{ old('bsnumero')}}" disabled/>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="bssecteur">Secteur</label>
                                    <select class="form-select" name="bssecteur" id="bssecteur">
                                        <option value="">Selectionner un secteur</option>
                                        @foreach($datasecteur as $secteur)
                                            <option value="{{$secteur['id']}}">{{$secteur['secteur']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="bsdate">Date</label>
                                    <input type="text" class="form-control" name="bsdate" id="bsdate" value="{{ old('bsdate')}}" disabled/>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="bsvendeur">Vendeurs</label>
                                    <select class="form-select" name="bsvendeur" id="bsvendeur">
                                        <option value="">Selectionner un vendeur</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="bsaidvendeur1">Aide Vendeurs</label>
                                    <select class="form-select" name="bsaidvendeur1" id="bsaidvendeur1">
                                        <option value="">Selectionner un aide vendeur</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="bsaidvendeur2">Aide Vendeurs</label>
                                    <select class="form-select" name="bsaidvendeur2" id="bsaidvendeur2">
                                        <option value="">Selectionner un aide vendeur</option>
                                    </select>
                                </div>
                                <div class="mb-4 col-lg-4">
                                    <label class="form-label" for="bsarticle">Articles</label>
                                    <select class="form-select" name="bsarticle" id="bsarticle">
                                        <option>Selectionner un article</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="bscamion">Camion</label>
                                    <select class="form-select" name="bscamion" id="bscamion" disabled>
                                        <option value="">Selectionner un camion</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="bskilometrage">Kilométrage de sortie</label>
                                    <input type="number" class="form-control" name="bskilometrage" id="bskilometrage" value="{{ old('bskilometrage')}}" disabled/>
                                </div>
                            </div>
                            <table id="bstable" class="table table-striped table-bordered dt-responsive nowrap mb-4" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Article</th>
                                        <th>Quantité</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="row">
                                <div class="mb-3 col-lg-12">
                                    <div class="mb-4">
                                        <label class="form-label" for="bsnote">Notes</label>
                                        <textarea class="form-control" name="bsnote" id="bsnote" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button onclick="sendSortie()" class="btn btn-warning fw-bold text-white">Ajouter le bon de sortie</button>
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

    const secteurSelect = document.getElementById('bssecteur');
    const vendeurSelect = document.getElementById('bsvendeur');
    const aideVendeurOneSelect = document.getElementById('bsaidvendeur1');
    const aideVendeurTwoSelect = document.getElementById('bsaidvendeur2');
    const articleSelect = document.getElementById('bsarticle');
    const referenceInput = document.getElementById('bsnumero');
    const dateSelect = document.getElementById('bsdate');
    const camionSelect = document.getElementById('bscamion');
    const kilometrageInput = document.getElementById('bskilometrage');
    const backendUrl = "{{ app('backendUrl') }}";

    camionSelect.disabled = true;
    kilometrageInput.disabled = true;

    function disableVendeurSelect() {
        vendeurSelect.disabled = true;
    }

    function enableVendeurSelect() {
        vendeurSelect.disabled = false;
    }

    function disableAideVendeurOneSelect() {
        aideVendeurOneSelect.disabled = true;
    }

    function enableAideVendeurOneSelect() {
        aideVendeurOneSelect.disabled = false;
    }

    function disableAideVendeurTwoSelect() {
        aideVendeurTwoSelect.disabled = true;
    }

    function enableAideVendeurTwoSelect() {
        aideVendeurTwoSelect.disabled = false;
    }

    function disableArticleSelect() {
        articleSelect.disabled = true;
    }

    function enableArticleSelect() {
        articleSelect.disabled = false;
    }

    function checkConditions() {
        if (referenceInput.value == '' || secteurSelect.value == '' || dateSelect.value == '') {
            disableArticleSelect();
            disableVendeurSelect();
            disableAideVendeurOneSelect();
            disableAideVendeurTwoSelect()
        } else {
            enableArticleSelect();
            enableVendeurSelect();
        }
    }

    secteurSelect.addEventListener('change', function() {
        
        fetch(backendUrl +'/vendeur')
        .then(response => response.json())
        .then(vendeurs => {
            vendeurSelect.innerHTML = '';

            const emptyOption = document.createElement('option');
            emptyOption.value = '';
            emptyOption.textContent = 'Selectionner un vendeur';
            vendeurSelect.appendChild(emptyOption);

            vendeurs.forEach(vendeur => {
                const option = document.createElement('option');
                option.value = vendeur.id;
                option.textContent = vendeur.nomComplet;
                vendeurSelect.appendChild(option);
            });
        });
        checkConditions();
    });

    vendeurSelect.addEventListener('change', function() {
        fetch(backendUrl + '/vendeur')
        .then(response => response.json())
        .then(vendeurs => {
            aideVendeurOneSelect.innerHTML = '';

            const emptyOptionAideVendeur1 = document.createElement('option');
            emptyOptionAideVendeur1.value = '';
            emptyOptionAideVendeur1.textContent = 'Selectionner un aide vendeur';
            aideVendeurOneSelect.appendChild(emptyOptionAideVendeur1);

            const selectedVendeurId = vendeurSelect.value;
            
            vendeurs.forEach(vendeur => {
                if (vendeur.id != selectedVendeurId) {
                    const option = document.createElement('option');
                    option.value = vendeur.id;
                    option.textContent = vendeur.nomComplet;
                    aideVendeurOneSelect.appendChild(option);
                }
            });
        });  
        enableAideVendeurOneSelect();     
        checkConditions();
    });

    aideVendeurOneSelect.addEventListener('change', function() {
        fetch(backendUrl + '/vendeur')
        .then(response => response.json())
        .then(vendeurs => {
            aideVendeurTwoSelect.innerHTML = '';

            const emptyOptionAideVendeur2 = document.createElement('option');
            emptyOptionAideVendeur2.value = '';
            emptyOptionAideVendeur2.textContent = 'Selectionner un aide vendeur';
            aideVendeurTwoSelect.appendChild(emptyOptionAideVendeur2);

            const selectedVendeurId = vendeurSelect.value;
            const selectedAideVendeurId = aideVendeurOneSelect.value;
            
            vendeurs.forEach(vendeur => {
                if (vendeur.id != selectedAideVendeurId && vendeur.id != selectedVendeurId) {
                    const option = document.createElement('option');
                    option.value = vendeur.id;
                    option.textContent = vendeur.nomComplet;
                    aideVendeurTwoSelect.appendChild(option);
                }
            });
        });
        enableAideVendeurTwoSelect();
        checkConditions();
    });

    checkConditions();

    let selectedArticleIds = [];
    let table = document.querySelector("#bstable");

    articleSelect.addEventListener("change", function(){
        
        let articleId = this.value;
        let selectedCount = selectedArticleIds.filter(function(id) {
            return id === articleId;
        }).length;

        if (selectedCount >= 2) {
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
            let quantiteCell = row.insertCell();
            let deleteCell = row.insertCell();

            idCell.innerHTML = data["Article Requested"].id;
            referenceCell.innerHTML = data["Article Requested"].reference;
            idCell.style.display = 'none'
            articleCell.innerHTML = data["Article Requested"].article_libelle;
            quantiteCell.innerHTML = '<input type="number" class="form-control" name="quantite" value="" />';

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

                if (selectedArticleIds.length < 1) {

                    camionSelect.innerHTML = '';

                    const emptyOptionCamion = document.createElement('option');
                    emptyOptionCamion.value = '';
                    emptyOptionCamion.textContent = 'Selectionner un camion';
                    camionSelect.appendChild(emptyOptionCamion);
                    camionSelect.disabled = true;
                    kilometrageInput.disabled = true;

                }
            });

            deleteCell.appendChild(deleteButton);

            selectedArticleIds.push(articleId); 
        });

        fetch(backendUrl +'/camion')
        .then(response => response.json())
        .then(camions => {
            camionSelect.innerHTML = '';

            const emptyOption = document.createElement('option');
            emptyOption.value = '';
            emptyOption.textContent = 'Selectionner un camion';
            camionSelect.appendChild(emptyOption);

            camions.forEach(camion => {
                const option = document.createElement('option');
                option.value = camion.id;
                option.textContent = camion.marque +'-'+ camion.matricule;
                camionSelect.appendChild(option);
            });

            camionSelect.disabled = false;
            kilometrageInput.disabled = false;
        });
        
    });
    

function sendSortie() {
    let selectedValues = [];
    let selectBox = document.getElementById("bsarticle");
    for (let i = 0; i < selectBox.options.length; i++) {
        if (selectBox.options[i].selected) {
            selectedValues.push(selectBox.options[i].value);
        }
    }
    const numeroBonsortie = document.getElementById('bsnumero').value;
    const secteurId = secteurSelect.value;
    const vendeurId = vendeurSelect.value;
    const aideVendeurOneId = aideVendeurOneSelect.value;
    const aideVendeurTwoId = aideVendeurTwoSelect.value;
    const camion = camionSelect.value;
    const kilometrage = kilometrageInput.value;
    const dateBonsortie = dateSelect.value;
    const noteBonsortie = document.getElementById('bsnote').value;

    let articles = [];
    let rows = table.rows;
    for (let i = 1; i < rows.length; i++) {
        let cells = rows[i].cells;
        let idarticle = cells[0].textContent;
        let reference = cells[1].textContent;
        let articleName = cells[2].textContent;
        let quantite = cells[3].querySelector("input[name='quantite']").value;

        let article = {
            article_id: idarticle,
            QuantitySortie: quantite,
            article_libelle: articleName,
            unite: 'P12',
        };
        articles.push(article);
    }

    let sortie = {
        reference: numeroBonsortie,
        Confirme: 0,
        dateSortie: dateBonsortie,
        secteur_id: secteurId,
        vendeur_id: vendeurId,
        aideVendeur_id: (aideVendeurOneId) ? aideVendeurOneId : null,
        aideVendeur2_id: (aideVendeurTwoId) ? aideVendeurTwoId : null,
        camion_id: camion,
        camionKM: kilometrage,
        Commentaire: noteBonsortie,
        Articles: articles
    };
   
    console.log(sortie);

    $.ajax({
        url: backendUrl +'/bonsortie',
        type: 'POST',
        data: sortie,
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
                window.location.href = "{{ env('APP_URL') }}/bon-sortie-secteur/detail/" + response.id;
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

    $('#bssecteur').on('change', function() {
        const secteurId = $(this).val();
        
        $.ajax({
            url: backendUrl +'/articlewr/' + secteurId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#bsarticle').empty();
                $('#bsarticle').append('<option value="">Selectionner un article</option>');
                $.each(response, function(index, article) {
                    $('#bsarticle').append('<option value="' + article.id + '">' + article.article_libelle + '</option>');
                });
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    $.ajax({
        url: backendUrl +'/getnbs',
        type: 'GET',
        success: function(response) {
            console.log(response);
            document.getElementById("bsnumero").value = response.num_bs;
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0');
            let yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("bsdate").value = today;
        },
    });

});

</script>
    
@endsection
