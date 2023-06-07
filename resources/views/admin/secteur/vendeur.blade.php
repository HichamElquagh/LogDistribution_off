@extends('admin.layouts.template')

@section('page-title')
    Vendeur | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Vendeur</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Vendeur</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-warning fw-bold text-white" data-bs-toggle="modal" onclick="changeBtn()" data-bs-target=".vendeurModal">Ajouter un Vendeur</button>
        </div>
        
        <span>
            @csrf
            <div class="modal fade vendeurModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Ajouter un Vendeur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">    
                                 <input type="number" hidden name="id" id="id" >
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="vendeurnom">Nom Complete</label>
                                <input type="text" class="form-control" name="vendeurnom" id="vendeurnom" required value="{{ old('vendeurnom')}}"/>
                                @error('fournisseurnom')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="vendeurcin">CIN</label>
                                <input type="text" class="form-control" name="vendeurcin" id="vendeurcin" required  value="{{ old('vendeurcin')}}"/>
                                @error('fournisseurcode')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="dateEmbauche">Date D'embauche</label>
                                <input type="date" class="form-control" name="dateEmbauche" id="dateEmbauche" value="{{ old('dateEmbauche')}}"/>
                                @error('fournisseurice')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="dateNaissance">Date de Naissance</label>
                                <input type="date" class="form-control" name="dateNaissance" id="dateNaissance" value="{{ old('dateNaissance')}}"/>
                                @error('fournisseurif')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="vendeurtelephone">Téléphone</label>
                                <input type="phone" class="form-control" name="vendeurtelephone" id="vendeurtelephone" value="{{ old('vendeurtelephone')}}"/>
                                @error('fournisseurtelephone')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="vendeuradress">Adresse</label>
                                <input type="text" class="form-control" name="vendeuradress" id="vendeuradress" value="{{ old('vendeuradress')}}"/>
                                @error('fournisseuradress')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button onclick="storevendeur()" class="btn btn-warning fw-bold text-white" id="add-btn">Ajouter</button>
                            <button onclick="updatevendeur()" class="btn btn-warning fw-bold text-white" id="update-btn">Update</button>
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
                                    <th>Nom complet</th>
                                    <th>CIN</th>  
                                    <th>Date d'enbauche</th>  
                                    <th>Date de naissance</th>
                                    <th>Tel</th>
                                    <th>Adresse</th>
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



        $(document).ready(function(){ 
            displaydatavendeur()
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

            $("#add-btn").show()
            $("#update-btn").hide()
            $("#myLargeModalLabel").text('Ajouter un Vendeur');
       }
 
       function displaydatavendeur() {
  $.ajax({
    url: "https://iker.wiicode.tech/api/vendeur",
    type: 'GET',
    dataType: 'json',
    success: function(response) {
        console.log(response);
      var tableBody = $('.table tbody');
      
      // Clear existing table rows
      tableBody.empty();
      
      // Iterate over the data and populate the table
      for (var i = 0; i < response.length; i++) {
        var vendeur = response[i];
        var row = $('<tr></tr>');
        
        row.append('<td>' + vendeur.id + '</td>');
        row.append('<td>' + vendeur.nomComplet + '</td>');
        row.append('<td>' + vendeur.cin + '</td>');
        row.append('<td>' + vendeur.dateEmbauche + '</td>');
        row.append('<td>' + vendeur.dateNaissance + '</td>');
        row.append('<td>' + vendeur.telephone + '</td>');
        row.append('<td>' + vendeur.adresse + '</td>');
        row.append('<td>' +
                    '<button onclick="editdatavendeur(' + vendeur.id + ')" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
                    '<i class="ri-edit-line"></i></button>' +
                    '<div class="mx-1"><button onclick="deletevendeur(' + vendeur.id + ')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button></div>' +
                    '</td>');
        
        tableBody.append(row);
      }
      
      // Initialize the DataTable
      $('#datatable-buttons').DataTable();
    },
    error: function(response) {
      console.log(response);
    }
  });
}

function storevendeur() {

  var formData = {
    nomComplet: $('#vendeurnom').val(),
    cin: $('#vendeurcin').val(),
    dateEmbauche: $('#dateEmbauche').val(),
    dateNaissance: $('#dateNaissance').val(),
    telephone: $('#vendeurtelephone').val(),
    adresse: $('#vendeuradress').val(),
  };

  $.ajax({
    url: 'https://iker.wiicode.tech/api/vendeur',
    type: 'POST',
    data: formData,
    dataType: 'json',
    success: function(response) {
      // Handle the success response here
      $('.vendeurModal').modal('hide');
      swal(response.message, "", "success");
      displaydatavendeur();
    
    },
    error: function(response) {
      // Handle the error response here
          swal(response.responseJSON.message, "", "warning");
    }
  });
}
function editdatavendeur(id) {
  console.log(id);
  $('.vendeurModal').modal('show');

  $('#update-btn').show();
  $('#add-btn').hide();
  $("#myLargeModalLabel").text('Edite info Vendeur');

  $.ajax({
    url: "https://iker.wiicode.tech/api/vendeur/" + id,
    type: 'GET',
    dataType: 'json',
    success: function(response) {
        // console.log(response['vendeur'].dateEmbauche);
      // Populate the form fields with the retrieved data
      $('#id').val(response['vendeur'].id);
      $('#vendeurnom').val(response['vendeur'].nomComplet);
      $('#vendeurcin').val(response['vendeur'].cin);
      $('#dateEmbauche').val(response['vendeur'].dateEmbauche);
      $('#dateNaissance').val(response['vendeur'].dateNaissance);
      $('#vendeurtelephone').val(response['vendeur'].telephone);
      $('#vendeuradress').val(response['vendeur'].adresse);
    },
    error: function(response) {
        swal(response.responseJSON.message, "", "warning");
    }
    
  });
}

function updatevendeur() {
  var id = $('#id').val();
  var nomComplet = $('#vendeurnom').val();
  var cin = $('#vendeurcin').val();
  var dateEmbauche = $('#dateEmbauche').val();
  var dateNaissance = $('#dateNaissance').val();
  var telephone = $('#vendeurtelephone').val();
  var adresse = $('#vendeuradress').val();

  $.ajax({
    url: "https://iker.wiicode.tech/api/vendeur/" + id,
    type: 'PUT',
    dataType: 'json',
    data: {
    nomComplet: nomComplet,
      cin: cin,
      dateEmbauche: dateEmbauche,
      dateNaissance: dateNaissance,
      telephone: telephone,
      adresse: adresse
    },
    success: function(response) {
      // Handle the success response
      $('.vendeurModal').modal('hide');
      swal(response.message, "", "success");
      displaydatavendeur();
    },
    error: function(response) {
      // Handle the error response
      swal(response.responseJSON.message, "", "warning");
    }
  });
}






    function deletevendeur(id){
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
            url: 'https://iker.wiicode.tech/api/vendeur/' + id,
            type: "delete",
                dataType: "json",
                success: function(response) {
                 swal(response.message, "", "success");
                 displaydatavendeur();                            },
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