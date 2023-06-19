@extends('admin.layouts.template')

@section('page-title')
    Clients | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Clients</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Clients</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-warning fw-bold text-white" data-bs-toggle="modal" onclick="changeBtn()"  data-bs-target=".clientModal">Ajouter un client</button>
        </div>
        
        <span>
            @csrf
            <div class="modal fade clientModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Ajouter un client</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">    
                            <input type="number" hidden class="form-control" name="clientId" id="clientId" value="{{ old('articlelibelle')}}"/>


                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="clientnom">Nom</label>
                                <input type="text" class="form-control" name="clientnom" id="clientnom" value="{{ old('clientnom')}}"/>
                                @error('clientnom')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="clientcode">Code client</label>
                                <input type="text" class="form-control" name="clientcode" id="clientcode" value="{{ old('clientcode')}}"/>
                                @error('clientcode')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="clientcin">CIN</label>
                                <input type="text" class="form-control" name="clientcin" id="clientcin" value="{{ old('clientcin')}}"/>
                                @error('clientcin')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="clientice">ICE</label>
                                <input type="text" class="form-control" name="clientice" id="clientice" value="{{ old('clientice')}}"/>
                                @error('clientice')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="clientpatente">Patente</label>
                                <input type="text" class="form-control" name="clientpatente" id="clientpatente" value="{{ old('clientpatente')}}"/>
                                @error('clientpatente')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="clientrc">RC</label>
                                <input type="text" class="form-control" name="clientrc" id="clientrc" value="{{ old('clientrc')}}"/>
                                @error('clientrc')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="clienttelephone">Téléphone</label>
                                <input type="phone" class="form-control" name="clienttelephone" id="clienttelephone" value="{{ old('clienttelephone')}}"/>
                                @error('clienttelephone')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="clientmail">Adress Mail</label>
                                <input type="email" class="form-control" name="clientmail" id="clientmail" value="{{ old('clientmail')}}"/>
                                @error('clientmail')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="clientadress">Adresse</label>
                                <input type="text" class="form-control" name="clientadress" id="clientadress" value="{{ old('clientadress')}}"/>
                                @error('clientadress')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button onclick="storeclient()" class="btn btn-warning fw-bold text-white" id="add-btn" >Ajouter</button>
                            <button onclick="updateclient()"  class="btn btn-warning fw-bold text-white" id="update-btn">Update</button>
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
                                    <th>Nom</th>
                                    <th>Code</th>  
                                    <th>CIN</th>  
                                    <th>ICE</th>
                                    <th>RC</th>
                                    <th>Pattente</th>
                                    <th>Adresse</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Date</th>
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

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
        const backendUrl = "{{ app('backendUrl') }}";
    
    $(document).ready(function(){ 
        displaydataClient();
                            });

function displaydataClient() {
  $.ajax({
    url: backendUrl + "/client",
    type: "GET",
    dataType: "json",
    success: function(data) {
        console.log(data);
      var tbody = $(".table tbody");
      tbody.empty(); // Clear the existing table body
      // Loop through the data and create table rows
      for (var i = 0; i < data.length; i++) {
        var client = data[i];
        var row = $("<tr></tr>");
        row.append('<td>' + client.id + '</td>');
        row.append('<td>' + client.nom_Client + '</td>');
        row.append('<td>' + client.code_Client + '</td>');
        row.append('<td>' + client.CIN_Client + '</td>');
        row.append('<td>' + client.ICE_Client + '</td>');
        row.append('<td>' + client.RC_Client + '</td>');
        row.append('<td>' + client.Pattent_Client + '</td>');
        row.append('<td>' + client.adresse_Client + '</td>');
        row.append('<td>' + client.email_Client + '</td>');
        row.append('<td>' + client.telephone_Client + '</td>');
        row.append("<td>" + moment(client.created_at).format("LL") + "</td>");
        row.append('<td>' +
            '<a href="/detail/' + client.id + '" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
                '<i class="fas fa-info-circle"></i></a>' +
                    '<div class="mx-1"><button onclick="deleteclient(' +client.id + ')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button></div>' +
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
$("#myLargeModalLabel").text('Ajouter un Client');
}
function storeclient() {
  var clientData = {
    nom_Client: $("#clientnom").val(),
    code_Client: $("#clientcode").val(),
    CIN_Client: $("#clientcin").val(),
    ICE_Client: $("#clientice").val(),
    RC_Client: $("#clientrc").val(),
    telephone_Client: $("#clienttelephone").val(),
    email_Client: $("#clientmail").val(),
    adresse_Client: $("#clientadress").val(),
    Pattent_Client: $("#clientpatente").val()
  };

  $.ajax({
    url: backendUrl + "/client",
    type: "POST",
    dataType: "json",
    data: clientData,
    success: function(response) {
      console.log(response);
      // Close the modal after successful creation
     
      swal(response.message, "", "success");
           $(".clientModal").modal("hide");
           displaydataClient();
    },
    error: function(response) {
        swal(response.responseJSON.message, "", "warning");      // Handle the error
    }
  });
}

function editclient(clientId) {

    $(".clientModal").modal("show");
       $("#add-btn").hide()
   $("#update-btn").show()
   $("#myLargeModalLabel").text('Edit Client');
  $.ajax({
    url: backendUrl + "/client/" + clientId,
    type: "GET",
    dataType: "json",
    success: function(client) {
      // Populate the modal fields with the client data

      $("#clientId").val(client['client'].id);
      $("#clientnom").val(client['client'].nom_Client);
      $("#clientcode").val(client['client'].code_Client);
      $("#clientcin").val(client['client'].CIN_Client);
      $("#clientice").val(client['client'].ICE_Client);
      $("#clientrc").val(client['client'].RC_Client);
      $("#clienttelephone").val(client['client'].telephone_Client);
      $("#clientmail").val(client['client'].email_Client);
      $("#clientadress").val(client['client'].adresse_Client);
      $("#clientpatente").val(client['client'].Pattent_Client);

      // Show the edit modal
   
    },
    error: function(client) {
        swal(client.responseJSON.message, "", "warning");      // Handle the error
    }
  });
}

function updateclient() {
   var  clientId = $("#clientId").val();

  var clientData = {
    nom_Client: $("#clientnom").val(),
    code_Client: $("#clientcode").val(),
    CIN_Client: $("#clientcin").val(),
    ICE_Client: $("#clientice").val(),
    RC_Client: $("#clientrc").val(),
    telephone_Client: $("#clienttelephone").val(),
    email_Client: $("#clientmail").val(),
    adresse_Client: $("#clientadress").val(),
    Pattent_Client: $("#clientpatente").val()
  };

  $.ajax({
    url: backendUrl + "/client/" + clientId,
    type: "PUT",
    dataType: "json",
    data: clientData,
    success: function(response) {
      console.log(response);
      swal(response.message, "", "success");
           $(".clientModal").modal("hide");
           displaydataClient();
    },
    error: function(response) {
        swal(response.responseJSON.message,"","warning");      // Handle the error
    }
  });
}
function deleteclient(id){
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
                url: backendUrl + "/client/" + id,  
                type: "delete",
                dataType: "json",
                success: function(response) {
                    swal(response.message, {
                icon: "success",
            });
            displaydataClient();        
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