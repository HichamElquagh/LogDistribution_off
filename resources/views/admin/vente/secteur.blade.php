@extends('admin.layouts.template')

@section('page-title')
    Secteur | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Secteur</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Secteur</li>
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
                                        <th>secteur</th>
                                        <th>warehouse Distrubtion</th>
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
                        Ajouter un Secteur
                    </div>
                    <span>
                        @csrf
                        <div class="card-body">
                            <div class="mb-3 col-lg-12">
                                <label class="form-label" for="secteur">Secteur</label>
                                <input type="text" class="form-control" name="secteur" id="secteur" value="{{ old('secteur')}}"/>
                                @error('secteur')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-12" id="label_warehouse">
                                <label class="form-label"  for="warehouse">Warehouses</label>
                                <select class="form-select" name="warehouse" id="warehouse">
                                    <option value="">choisir un warhouse</option>
                                    <!-- Add more options as needed -->
                                    @foreach ($allWarehouses as $warehouse )
                                    <option value="{{$warehouse['id']}}">{{$warehouse['nom_Warehouse']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button  onclick="storesecteur()" class="btn btn-warning fw-bold text-white">Ajouter</button>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade secteurModal" id="categoryModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Modifier la categorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <span>
                    @csrf
                    <div class="modal-body row">  
                        <input type="hidden" value="" name="upsecteurId" id="upsecteurId">
                        
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="upSecteur">Secteur</label>
                            <input type="text" class="form-control" name="upSecteur" id="upSecteur" value="{{ old('upSecteur')}}"/>
                            @error('secteur')
                                <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-16" id="label_warehouse">
                            <label class="form-label"  for="upwarehouse">upwarehouses</label>
                            <select class="form-select" name="upwarehouse" id="upwarehouse">
                                <option value="">choisir un warhouse</option>
                                <!-- Add more options as needed -->
                                @foreach ($allWarehouses as $warehouse )
                                <option value="{{$warehouse['id']}}">{{$warehouse['nom_Warehouse']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                        <button  onclick="updatesecteur()" class="btn btn-warning fw-bold text-white">Modifier</button>
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
            const backendUrl = "{{ app('backendUrl') }}";

   
            $(document).ready(function(){ 
        displaydatasecteur()
                            });

              
function displaydatasecteur() {
  $.ajax({
    url: backendUrl + "/secteur",
    type: "GET",
    dataType: "json",
    success: function(data) {
      console.log(data);
      var tbody = $(".table tbody");
      tbody.empty(); // Clear the existing table body

      // Loop through the data and create table rows
      for (var i = 0; i < data.length; i++) {
        var secteur = data[i];
        var row = $("<tr></tr>");
        row.append('<td>' + secteur.id + '</td>');
        row.append('<td>' + secteur.secteur + '</td>');
        row.append('<td>' + secteur.nom_Warehouse + '</td>');
        row.append('<td>' +
                    '<button onclick="editsecteur(' + secteur.id + ')" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
                    '<i class="ri-edit-line"></i></button>' +
                    '<div class="mx-1"><button onclick="deletesecteur(' + secteur.id + ')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button></div>' +
                    '</td>');
        tbody.append(row);
      }
    },
    error: function(data) {
      swal("Error", "Failed to fetch data from the API.", "error");
    }
  });
}


function changeBtn(){

$('input[type="text"]').each(function() {
          $(this).val('');
});
 $('input[type="number"]').each(function() {
 $(this).val('');
});

$("#add-btn").show()
$("#update-btn").hide()
$("#myLargeModalLabel").text('Ajouter un Secteur');
}
function storesecteur() {
  var secteur = $("#secteur").val();
  var warehouse = $("#warehouse").val();

  var newSecteur = {
    secteur: secteur,
    warehouseDistrubtion_id: warehouse
  };

  $.ajax({
    url: backendUrl + "/secteur",
    type: "POST",
    dataType: "json",
    data: newSecteur,
    success: function(response) {
      swal("Success", "Secteur created successfully.", "success");
      displaydatasecteur();
      $("#secteur").val("");
      $("#warehouse").val("");
    },
    error: function(response) {
      swal("Error", "Failed to create secteur.", "error");
    }
  });
}


function editsecteur(id) {
    console.log(id);
    $(".secteurModal").modal("show");
  // Make a GET request to fetch the secteur data by its ID
  $.ajax({
    url: backendUrl + "/secteur/" + id,
    type: "GET",
    dataType: "json",
    success: function(response) {
        console.log(response);
      // Populate the form fields with the retrieved data
     $("#upsecteurId").val(response['secteur'].id);
      $("#upSecteur").val(response['secteur'].secteur);
      $("#upwarehouse").val(response['secteur'].warehouseDistrubtion_id);

      // Show the update button and hide the add button
      $("#add-btn").hide();
      $("#update-btn").show();
    },
    error: function(response) {
      swal("Error", "Failed to fetch secteur data.", "error");
    }
  });
}

function updatesecteur() {
  var id = $("#upsecteurId").val();
  var secteur = $("#upSecteur").val();
  var warehouse = $("#upwarehouse").val();

  var updatedSecteur = {
    secteur: secteur,
    warehouseDistrubtion_id: warehouse
  };

  $.ajax({
    url: backendUrl + "/secteur/" + id,
    type: "PUT",
    dataType: "json",
    data: updatedSecteur,
    success: function(response) {
        swal(response.message, "", "success");
           $(".secteurModal").modal("hide");
      displaydatasecteur();
    },
    error: function(response) {
        swal(response.responseJSON.message,"","warning");      // Handle the error
    }
  });
}




        function deletesecteur(id){
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
                url: backendUrl +"/secteur/" + id,  
                type: "delete",
                dataType: "json",
                success: function(response) {
                    swal(response.message, {
                icon: "success",
            });
            displaydatasecteur();
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