@extends('admin.layouts.template')

@section('page-title')
    Articles | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Articles</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Articles</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-warning fw-bold text-white" data-bs-toggle="modal"  onclick="changeBtn()" data-bs-target=".articleModal">Ajouter un article</button>
        </div>  
        
        <span>
            @csrf
            <div class="modal fade articleModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Ajouter un article</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">    
                            <input type="number" hidden class="form-control" name="articleId" id="articleId" value="{{ old('articlelibelle')}}"/>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="articlelibelle">Article libellé</label>
                                <input type="text" class="form-control" name="articlelibelle" id="articlelibelle" value="{{ old('articlelibelle')}}"/>
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="articlefournisseurs">Fournisseurs</label>
                                <select class="form-select" name="articlefournisseurs" id="articlefournisseurs">
                                    <option > selectionnez un fournisseur</option>
                                    @foreach($dataFournisseurs as $fournisseurs)
                                        <option value="{{$fournisseurs['id']}}">{{$fournisseurs['fournisseur']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="articlereference">Référence</label>
                                <input type="number" class="form-control" name="articleReference" id="articleReference" value="{{ old('articleReference')}}"/>
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="articlecategory">Catégorie</label>
                                <select class="form-select" name="articlecategory" id="articlecategory">
                                    <option > selectionnez une category</option>
                                    @foreach($dataCategory as $category)
                                        <option value="{{$category['id']}}">{{$category['category']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="articlepu">Prix Unitaire</label>
                                <input type="number" class="form-control" name="articlepu" id="articlepu" value="{{ old('articlepu')}}"/>
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="articlepp">Prix Public</label>
                                <input type="number" class="form-control" name="articlepp" id="articlepp" value="{{ old('articlepp')}}"/>
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="articlepa">Prix D'achat</label>
                                <input type="number" class="form-control" name="articlepa" id="articlepa" value="{{ old('')}}"/>
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="articlesg">Semi-Grossiste</label>
                                <input type="number" class="form-control" name="articlesg" id="articlesg" value="{{ old('articlesg')}}"/>
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="articlecf">Client Fidéle</label>
                                <input type="number" class="form-control" name="articlecf" id="articlecf" value="{{ old('articlecf')}}"/>
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="articleunite">Unité</label>
                                <input type="text" class="form-control" name="articleunite" id="articleunite" value="{{ old('articleunite')}}"/>
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="articlealert">Alerte Stock</label>
                                <input type="number" class="form-control" name="articlealert" id="articlealert" value="{{ old('articlealert')}}"/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button onclick="storeArticle()" class="btn btn-warning fw-bold text-white" id="add-btn" >Ajouter</button>
                            <button onclick="updateArticle()"  class="btn btn-warning fw-bold text-white" id="update-btn">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </span>

        @if($message = Session::get('errorCatch'))
            <div class="alert alert-warning alert-dismissible fade show my-3" role="alert">
                <i class="mdi mdi-alert-outline me-2"></i>
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>article libellé</th>
                                        <th data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-title="Référence">ref</th>  
                                        <th>Categorie</th>
                                        <th data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-title="Prix Unitaire">P.U</th>  
                                        <th data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-title="Prix Public">P.P</th>
                                        <th data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-title="Semi-grossiste">S.G</th>
                                        <th data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-title="Client Fidéle">C.F</th>
                                        <th>Unité</th>
                                        <th>Date de creation</th>
                                        <th>Détail</th>
                                    </tr>
                                </thead>
                                
                                <tbody class="text-center">
                                
                                            <tr>
                                            
                                            </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  $(document).ready(function(){
    displaydataArticles();
  });



  function changeBtn(){

    $('input[type="text"]').each(function() {
              $(this).val('');
    });
     $('input[type="number"]').each(function() {
     $(this).val('');
    });
    $("#articlefournisseurs").val($("#articlefournisseurs option:first").val());
    $("#articlecategory").val($("#articlecategory option:first").val());
    $("#add-btn").show()
   $("#update-btn").hide()
   $("#myLargeModalLabel").text('Ajouter un  Article');
  }

  function displaydataArticles() {
    $.ajax({
      url: "https://iker.wiicode.tech/api/articles",
      type: "GET",
      dataType: "json",
      success: function(data) {
        var articleData = data.data ;
        var tbody = $(".table tbody");
        tbody.empty(); // Clear the existing table body

        // Loop over the data array
        for (var i = 0; i < articleData.length; i++) {
          var article = articleData[i];
          var row = $("<tr></tr>");
          row.append('<td class="text-warning fw-bold">#' + article.id + "</td>");
          row.append("<td>" + article.article_libelle + "</td>");
          row.append("<td>" + article.reference + "</td>");
          row.append("<td>" + article.category + "</td>");
          row.append("<td>" + numeral(article.prix_unitaire).format("0,0.00") + "</td>");
          row.append("<td>" + numeral(article.prix_public).format("0,0.00") + "</td>");
          row.append("<td>" + numeral(article.demi_grossiste).format("0,0.00") + "</td>");
          row.append("<td>" + numeral(article.client_Fedele).format("0,0.00") + "</td>");
          row.append("<td>" + article.unite + "</td>");
          row.append("<td>" + moment(article.created_at).format("LL") + "</td>");
          row.append('<td class="d-flex ">' +
            '<button onclick="editArticle(' + article.id + ')" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
            '<i class="ri-edit-line"></i></button>' +
            '<div class="mx-1"><button onclick="deleteArticle(' + article.id + ')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button></div>' +
            '</td>');

          tbody.append(row);
        }
      },
      error: function(data) {
        swal(data.responseJSON.message, "", "warning");
      }
    });
  }

  function storeArticle() {
    var articleLibelle = $('#articlelibelle').val();
    var articleReference = $('#articleReference').val();
    var articlePU = $('#articlepu').val();
    var articlePP = $('#articlepp').val();
    var articleCF = $('#articlecf').val();
    var articleSG = $('#articlesg').val();
    var articleUnite = $('#articleunite').val();
    var articleCategory = $('#articlecategory').val();
    var Selectefournisseur = $('#articlefournisseurs').val();
    var articleAlert = $('#articlealert').val();
    var articlePA = $('#articlepa').val();

    $.ajax({
        url: "https://iker.wiicode.tech/api/articles",  
      type: 'POST',
        data: {
            article_libelle: articleLibelle,
            reference: articleReference,
            prix_unitaire: articlePU,
            prix_public: articlePP,
            prix_achat: articlePA ,
            client_Fedele: articleCF,
            demi_grossiste : articleSG,
            unite: articleUnite,
            category_id: articleCategory,
            fournisseur_id : Selectefournisseur ,
            alert_stock: articleAlert

        },
        dataType: 'json',
        success: function(response) {
            swal(response.message, "", "success");
            $('.articleModal').modal('hide');
            $('input[type="text"]').val('');
            $('input[type="number"]').val('');

            displaydataArticles();
        },
        error: function(response) {
            console.log(response);
            swal(response.responseJSON.message, "", "warning");
        }
    });
}
 
function editArticle(id){
    
    console.log(id);
   $(".articleModal").modal('show')
   $("#add-btn").hide()
   $("#update-btn").show()
   $("#myLargeModalLabel").text('Edit Article');
   $.ajax({
    url: "https://iker.wiicode.tech/api/articles/" + id,
       type: 'GET',
       dataType: 'json',
      success: function(data) {
    console.log(data);
    $('input[name="articleId"]').val(data["Article Requested"]["id"]);
    $('input[name="articlelibelle"]').val(data["Article Requested"]["article_libelle"]);
    $('input[name="articleReference"]').val(data["Article Requested"]["reference"]);
    $('input[name="articlepu"]').val(data["Article Requested"]["prix_unitaire"]);
    $('input[name="articlepp"]').val(data["Article Requested"]["prix_public"]);
    $('input[name="articlecf"]').val(data["Article Requested"]["client_Fedele"]);
    $('input[name="articlesg"]').val(data["Article Requested"]["demi_grossiste"]);
    $('input[name="articleunite"]').val(data["Article Requested"]["unite"]);
    $('#articlecategory').val(data["Article Requested"]["category_id"]);
    $('#articlefournisseurs').val(data["Article Requested"]["fournisseur_id"]);
    $('input[name="articlealert"]').val(data["Article Requested"]["alert_stock"]);
    $('input[name="articlepa"]').val(data["Article Requested"]["prix_achat"]);
},

       error: function(data) {
        swal(data.responseJSON.message, "", "warning");
       }
   });
}


function updateArticle() {
    var articleId = $('#articleId').val();
    var articleLibelle = $('#articlelibelle').val();
    var articleReference = $('#articleReference').val();
    var articlePU = $('#articlepu').val();
    var articlePP = $('#articlepp').val();
    var articleCF = $('#articlecf').val();
    var articleSG = $('#articlesg').val();
    var articleUnite = $('#articleunite').val();
    var articleCategory = $('#articlecategory').val();
    var Selectefournisseur = $('#articlefournisseurs').val();
    var articleAlert = $('#articlealert').val();
    var articlePA = $('#articlepa').val();

    $.ajax({
        url: "https://iker.wiicode.tech/api/articles/" + articleId,  
        type: 'PUT',  // Use 'PUT' for update operation
        data: {
            article_libelle: articleLibelle,
            reference: articleReference,
            prix_unitaire: articlePU,
            prix_public: articlePP,
            prix_achat: articlePA ,
            client_Fedele: articleCF,
            demi_grossiste : articleSG,
            unite: articleUnite,
            category_id: articleCategory,
            fournisseur_id : Selectefournisseur ,
            alert_stock: articleAlert

        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            $('.articleModal').modal('hide');
            swal(response.message, "", "success");
            displaydataArticles();

        },
        error: function(response) {
            console.log(response);
            swal(response.responseJSON.message,"","warning");
        }
    });
}




  function deleteArticle(id){
            swal({
                title: "Are you sure to delete this ?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                           
            $.ajax({
                url: "https://iker.wiicode.tech/api/articles/" + id,  
                type: "delete",
                dataType: "json",
                success: function(response) {
                    swal(response.message, {
                icon: "success",
            });
            displaydataArticles();        
                },
                error: function() {
                }
            });
                
            } else {
                swal("Your imaginary file is safe!");
            }
            });
        }
   
</script>


@endsection