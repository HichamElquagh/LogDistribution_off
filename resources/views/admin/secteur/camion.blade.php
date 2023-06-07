@extends('admin.layouts.template')

@section('page-title')
    Camion | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Camion</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Camion</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-warning fw-bold text-white" data-bs-toggle="modal" onclick="changeBtn()" data-bs-target=".camionModal">Ajouter un Camion</button>
        </div>
        
        <span>
            @csrf
            <div class="modal fade camionModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Ajouter un Camion </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">    
                                 <input type="number" hidden name="id" id="id" >
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="matricule">Matricule</label>
                                <input type="text" class="form-control" name="matricule" id="matricule" required value="{{ old('matricule')}}"/>
                                @error('fournisseurnom')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="marque">Marque</label>
                                <input type="text" class="form-control" name="marque" id="marque" required  value="{{ old('marque')}}"/>
                                @error('fournisseurcode')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="modele">Modele</label>
                                <input type="text" class="form-control" name="modele" id="modele" value="{{ old('modele')}}"/>
                                @error('fournisseurice')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="Annee">Annee</label>
                                <input type="number" class="form-control" name="Annee" id="Annee" value="{{ old('Annee')}}"/>
                                @error('fournisseurif')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="Etat">Etat</label>
                                <input type="phone" class="form-control" name="Etat" id="Etat" value="{{ old('Etat')}}"/>
                                @error('fournisseurtelephone')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="km">Km</label>
                                <input type="number" class="form-control" name="km" id="km" value="{{ old('km')}}"/>
                                @error('fournisseuradress')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button onclick="storecamion()" class="btn btn-warning fw-bold text-white" id="add-btn">Ajouter</button>
                            <button onclick="updatecamion()" class="btn btn-warning fw-bold text-white" id="update-btn">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </span>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Matricule</th>
                                    <th>Marque</th>  
                                    <th>Modele</th>  
                                    <th>Annee</th>
                                    <th>Etat</th>
                                    <th>Km</th>
                                    <th>Détail</th>
                                </tr>
                            </thead>
                            
                            <tbody class="text-center">
                              <tr></tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    
</div>
@endsection



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>


const backendUrl = "{{ app('backendUrl') }}";

        $(document).ready(function(){ 
            displaydatacamion()
                                    });


            function  changeBtn() {
            $('input[type="text"]').each(function() {
              $(this).val('');
            });
            $('input[type="number"]').each(function() {
              $(this).val('');
            });
            $('input[type="phone"]').each(function() {
              $(this).val('');
            });
            $('input[type="date"]').each(function() {
              $(this).val('');
            });


            $("#add-btn").show()
            $("#update-btn").hide()
            $("#myLargeModalLabel").text('Ajouter un Vendeur');
       }
 
       function displaydatacamion() {
  $.ajax({
    url: backendUrl +"/camion",
    type: "GET",
    dataType: "json",
    success: function(response) {
      console.log(response);
      var tableBody = $(".table tbody");

      // Clear existing table rows
      tableBody.empty();

      // Iterate over the data and populate the table
      for (var i = 0; i < response.length; i++) {
        var camion = response[i];
        var row = $("<tr>");

        row.append("<td>" + camion.id + "</td>");
        row.append("<td>" + camion.matricule + "</td>");
        row.append("<td>" + camion.marque + "</td>");
        row.append("<td>" + camion.modele + "</td>");
        row.append("<td>" + camion.annee + "</td>");
        row.append("<td>" + camion.etat + "</td>");
        row.append("<td>" + camion.km + "</td>");
        row.append(
          '<td>' +
            '<button onclick="editdatacamion(' +
            camion.id +
            ')" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
            '<i class="ri-edit-line"></i></button>' +
            '<div class="mx-1"><button onclick="deletecamion(' +
            camion.id +
            ')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button></div>' +
            '</td>'
        );

        tableBody.append(row);
      }


    },
    error: function(response) {
      console.log(response);
    }
  });
}

function storecamion() {
  var matricule = $("#matricule").val();
  var marque = $("#marque").val();
  var modele = $("#modele").val();
  var annee = $("#Annee").val();
  var etat = $("#Etat").val();
  var km = $("#km").val();

  var data = {
    matricule: matricule,
    marque: marque,
    modele: modele,
    annee: annee,
    etat: etat,
    km: km
  };

  $.ajax({
    url: backendUrl +"/camion",
    type: "POST",
    dataType: "json",
    data: data,
    success: function(response) {
      $(".camionModal").modal("hide");
      swal(response.message, "", "success");
      displaydatacamion();    
    },
    error: function(response) {
      // Handle error response here
      swal(response.responseJSON.message, "", "warning");
    }
  });
}
function editdatacamion(id) {
    // console.log(id);
  $.ajax({
    url: backendUrl +"/camion/" + id,
    type: "GET",
    dataType: "json",
    success: function(response) {
        console.log(response['camion']);
      // Populate the form fields with camion data
      $("#id").val(response['camion'].id);
      $("#matricule").val(response['camion'].matricule);
      $("#marque").val(response['camion'].marque);
      $("#modele").val(response['camion'].modele);
      $("#Annee").val(response['camion'].annee);
      $("#Etat").val(response['camion'].etat);
      $("#km").val(response['camion'].km);

      // Show the update button and hide the add button
      $("#update-btn").show();
      $("#add-btn").hide();

      // Show the camion modal
      $(".camionModal").modal("show");
    },
    error: function(response) {
        swal(response.responseJSON.message, "", "warning");
    }
  });
}



    function deletecamion(id){
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
            url: backendUrl +'/camion/' + id,
            type: "delete",
                dataType: "json",
                success: function(response) {
                 swal(response.message, "", "success");
                 displaydatacamion();             
                         },
                error: function() {
                console.error("cccccccccccc");
                }
            });
            } else {
                swal("Your imaginary file is safe!");
            }
            });
    }

</script>