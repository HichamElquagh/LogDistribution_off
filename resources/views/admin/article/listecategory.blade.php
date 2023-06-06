@extends('admin.layouts.template')

@section('page-title')
    Categories | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Categories</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Categorie</th>
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

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Ajouter une categorie
                    </div>
                    <span>
                        @csrf
                        <div class="card-body">
                            @if($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                                    <i class="mdi mdi-check-all me-2"></i>
                                    {{$message}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                                    <i class="mdi mdi-block-helper me-2"></i>
                                    {{$message}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label" for="categoryname">Categorie</label>
                                <input type="text" class="form-control" name="storecategoryname" id="stotecategoryname" value="{{ old('categoryname')}}"/>
                            </div> 
                        </div>
                        <div class="card-footer text-center">
                            <button  onclick="storecategory()" class="btn btn-warning fw-bold text-white">Ajouter la categorie</button>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade categoryModal" id="categoryModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Modifier la categorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <span>
                    @csrf
                    <div class="modal-body row">  
                        <input type="hidden" value="" name="editcategoryId" id="editcategoryId">
                        <div class="mb-3">
                            <label class="form-label" for="categoryname">Categorie</label>
                            <input type="text" class="form-control" name="categoryname" id="categoryname" value=""/>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                        <button  onclick="updatecategory()" class="btn btn-warning fw-bold text-white">Modifier</button>
                    </div>
                </span>
            </div>
        </div>
    </div>
    
</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        function showModel(nom,id){
            document.querySelector("#category").value = nom;
            document.querySelector("#categoryId").value = id;
        }

        $(document).ready(function(){ 
            displaydatacategory();
            });


      function displaydatacategory(){
        $.ajax({
            url: "https://iker.wiicode.tech/api/categories",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                var tbody = $('.table tbody');
                tbody.empty(); // Clear the existing table body
                // Loop over the data array
                for (var i = 0; i < data.length; i++) {
                    let category = data[i];
                var row = $('<tr></tr>');

                row.append('<td class="text-warning fw-bold">' + category.id + '</td>');
                row.append('<td class="TdBanque">' + category.category + '</td>');   
                row.append("<td>" + moment(category.created_at).format("LL") + "</td>");
                row.append('<td>' +
                    '<a onclick="editcategory(' + category.id + ')" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
                    '<i class="fas fa-info-circle"></i></a>' +
                    '<div><button onclick="deletecategory(' + category.id + ')" class="btn btn-outline-danger btn-sm"> <i class="fas fa-trash-alt"></i></button></div>' +
                    '</td>');

                tbody.append(row);
            }
        },
        error: function() {
            console.error("Error fetching category");
        }
            });
      }
     
  function storecategory() {
    var category_name = $('#stotecategoryname').val();
    $.ajax({
        url: "https://iker.wiicode.tech/api/categories",
      type: 'POST',
        data: {
            category:category_name,
        },
        dataType: 'json',
        success: function(response) {
            swal(response.message, "", "success");
            $('input[type="text"]').val('');
            $('input[type="number"]').val('');
            displaydatacategory();
        },
        error: function(response) {
            console.log(response);
            swal(response.responseJSON.message, "", "warning");
        }
    });
}

        function editcategory(id){
    
    console.log(id);
   $(".categoryModal").modal('show')
   $.ajax({
    url: "https://iker.wiicode.tech/api/categories/"  + + id,
       type: 'GET',
       dataType: 'json',
      success: function(data) {
    console.log(data);
    $('input[name="editcategoryId"]').val(data['Category Requested'].id);
    $('input[name="categoryname"]').val(data['Category Requested'].category);


},
       error: function(data) {
        swal(data.responseJSON.message, "", "warning");
       }
   });
}



        function updatecategory() {
           var categoryId =  $('#editcategoryId').val();
           var category_name = $('#categoryname').val();

    $.ajax({
        url: "https://iker.wiicode.tech/api/categories/"  + categoryId,  
        type: 'PUT',  // Use 'PUT' for update operation
        data: {
            category: category_name,

        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            $('.categoryModal').modal('hide');
            swal(response.message, "", "success");
            displaydatacategory();

        },
        error: function(response) {
            console.log(response);
            swal(response.responseJSON.message,"","warning");
        }
    });
}



        function deletecategory(id){
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
                url: "https://iker.wiicode.tech/api/categories/" + id,  
                type: "delete",
                dataType: "json",
                success: function(response) {
                    swal(response.message, {
                icon: "success",
            });
            displaydatacategory();   
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