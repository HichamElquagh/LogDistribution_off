@extends('admin.layouts.template')

@section('page-title')
    Bon de Transfert | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bon de Transfert</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Bon de Transfert</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Créer un bon de Transfert
                        <a href="{{ route('admintransfert') }}" class="btn btn-outline-secondary btn-sm" type="submit">
                            <i class="ri-arrow-go-back-line"></i>
                        </a>
                    </div>
                    <span>
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label" for="bcnumero">Numéro du Transfert</label>
                                    <input type="text" class="form-control" name="bcnumero" id="bcnumero" disabled value="{{$nmTransfert['num_Transfert']}}" />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label" for="bcdate">Date</label>
                                    <input type="date" class="form-control" name="bcdate" id="bcdate" value="{{ old('bcdate')}}"/>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label" for="bcclient">Envoyé de l'entrepôt :</label>
                                    <select class="form-select" name="from_warehouse_id" id="from_warehouse_id">
                                        <option value="">Selectionner un entrepôt</option>
                                        @foreach($allwarhouse as $warhouse)
                                            <option value="{{$warhouse['id']}}">{{$warhouse['nom_Warehouse']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label" for="to_warehouse">À L'entrepôt :</label>
                                    <select class="form-select" name="to_warehouse" id="to_warehouse">
                                        <option value="">Selectionner un entrepôt</option>
                                        @foreach($allwarhouse as $warhouse)
                                            <option value="{{$warhouse['id']}}">{{$warhouse['nom_Warehouse']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3 ">
                                    <label class="form-label" for="article">Articles</label>
                                    <select class="form-select" name="bcarticle" id="bcarticle">
                                        
                                    </select>
                                </div>
                                
                            </div>
                           
                            <table id="bctable" class="table table-striped table-bordered dt-responsive nowrap mb-4" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Article</th>
                                        <th>Prix Unitaire</th>
                                        <th>Quantité</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>                                   
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer text-center">
                            <button onclick="" class="btn btn-warning fw-bold text-white">Transfert</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>

<script>
    
    $(document).ready(function() {
    // When the warehouse selection changes
    $('#from_warehouse_id').change(function() {
        var warehouseId = $(this).val();
        $('#bcarticle').empty();

        if (warehouseId) {
            // Send an AJAX request to fetch the articles for the selected warehouse
            $.ajax({
                url: 'https://iker.wiicode.tech/api/getartbyware/' + warehouseId,
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    if (response && response.length > 0) {
                        // Clear the existing options in the article select dropdown
                        // Append the new options based on the response
                        $('#bcarticle').append(' <option selected value="">Selectionner un article</option> ');
                        $.each(response, function(index, article) {
                            $('#bcarticle').append('<option value="' + article.article_id + '">' + article.article_libelle + '</option>');
                        });

                    } else {
                        // If no articles found, display a message or perform any desired action
                        console.log('No articles found for the selected warehouse.');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error case
                    console.log('Error:', error);
                }
            });

        } 
        else {
            // If no warehouse is selected, clear the article select dropdown
            $('#bcarticle').empty();
        }
    });
    var selectedArticles = []; // Array to store the selected articles

// Function to remove a row from the table
function removeRow(row) {
    var articleId = row.attr('data-articleid');
    // Remove the row from the table
    row.remove();
    // Remove the corresponding article from the selectedArticles array
    var removedArticleIndex = -1;
    selectedArticles.forEach(function(article, index) {
        if (article.id === articleId) {
            removedArticleIndex = index;
        }
    });
    if (removedArticleIndex !== -1) {
        var removedArticle = selectedArticles.splice(removedArticleIndex, 1)[0];
        // Add the removed article back to the select dropdown
        var selectDropdown = $('#bcarticle');
        var optionHtml = '<option value="' + removedArticle.id + '">' + removedArticle.article_libelle + '</option>';
        selectDropdown.append(optionHtml);
    }
}

$('#bcarticle').change(function() {
    var articleId = $(this).val();
    console.log(articleId);

    if (articleId) {
        // Send an AJAX request to fetch the data for the selected article
        $.ajax({
            url: 'https://iker.wiicode.tech/api/articles/' + articleId,
            type: 'GET',
            success: function(articleData) {
                console.log(articleData);
                // Get the existing table body
                var tableBody = $('#bctable tbody');

                // Check if the article is already added to the table
                var existingArticle = tableBody.find('tr[data-articleid="' + articleData['Article Requested'].id + '"]');

                if (existingArticle.length === 0) {
                    // Append a new row with the article data to the table
                    var newRow = '<tr data-articleid="' + articleData['Article Requested'].id + '">' +
                        '<td>' + articleData['Article Requested'].reference + '</td>' +
                        '<td>' + articleData['Article Requested'].article_libelle + '</td>' +
                        '<td>' + articleData['Article Requested'].prix_unitaire + '</td>' +
                        '<td><input type="text" class="form-control" name="quantity[]" id="quantity"></td>' +
                        '<td><button class="btn btn-danger btn-sm btn-delete-row">Supprimer</button></td>' +
                        '</tr>';
                    tableBody.append(newRow);

                    // Store the selected article in the array
                    selectedArticles.push(articleData['Article Requested']);

                    // Remove the selected article from the select dropdown
                    $('#bcarticle option[value="' + articleId + '"]').remove();
                } else {
                    // If the article is already added, display an error message
                    Swal.fire('Error', 'The selected article is already added to the table.', 'error');
                }
            },
            error: function(xhr, status, error) {
                // Handle the error case
                console.log('Error:', error);
            }
        });
    }
});

// Delete button click event within the table
$('#bctable').on('click', '.btn-delete-row', function() {
    var row = $(this).closest('tr');
    removeRow(row);
});

// Function to populate the table with the selected articles
function populateTable() {
    var tableBody = $('#bctable tbody');
    tableBody.empty();

    // Loop through the selected articles and add rows to the table
    selectedArticles.forEach(function(article) {
        var newRow = '<tr data-articleid="' + article.id + '">' +
            '<td>' + article.reference + '</td>' +
            '<td>' + article.article_libelle + '</td>' +
            '<td>' + article.prix_unitaire + '</td>' +
            '<td><input type="text" class="form-control" name="quantity[]" id="quantity"></td>' +
            '<td><button class="btn btn-danger btn-sm btn-delete-row">Supprimer</button></td>' +
            '</tr>';
        tableBody.append(newRow);
    });
}

// Call the populateTable function initially to display any previously selected articles
populateTable();


});

</script>
@endsection
