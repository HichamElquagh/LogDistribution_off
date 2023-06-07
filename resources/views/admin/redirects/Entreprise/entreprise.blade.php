@extends('admin.layouts.template')

@section('page-title')
Entreprise| Log Dist Du Nord
@endsection

@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Entreprise</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Entreprise</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-warning fw-bold text-white"  data-bs-toggle="modal" onclick="changeBtn()" data-bs-target=".entrepriseModal"> Ajouter</button>
        </div>


        {{-- <form action="" method="POST"> --}}
            <span>
            @csrf
            <div class="modal fade entrepriseModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Ajouter entreprise</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                                <input type="number" hidden class="form-control" name="id" id="id" value=""/>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="nom_entreprise">Name</label>
                                <input type="text" class="form-control" name="nom_entreprise" id="nom_entreprise" value="{{ old('nom_entreprise')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="ICE">ICE</label>
                                <input type="number" class="form-control" name="ICE" id="ICE" value="{{ old('ICE')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="IF">IF</label>
                                <input type="text" class="form-control" name="IF" id="IF" value="{{ old('IF')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="RC">RC</label>
                                <input type="text" class="form-control" name="RC" id="RC" value="{{ old('RC')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="adresse">Adresse</label>
                                <input type="text" class="form-control" name="adresse" id="adresse" value="{{ old('adresse')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="telephone">Telephone</label>
                                <input type="phone" class="form-control" name="telephone" id="telephone" value="{{ old('telephone')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="fax">Fax</label>
                                <input type="text" class="form-control" name="fax" id="fax" value="{{ old('fax')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="capital">Capital</label>
                                <input type="number" class="form-control" name="capital" id="capital" value="{{ old('capital')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button onclick="storeDataEntreprise()" class="btn btn-warning fw-bold text-white" id="add-btn">Ajouter </button>
                            <button onclick="updatedataEntreprise()" class="btn btn-warning fw-bold text-white" id="update-btn">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        {{-- </form> --}}
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
                        <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>ICE</th>
                                <th>IF</th>
                                <th>RC</th>
                                <th>Adresse</th>
                                <th>email</th>
                                <th>Telephone</th>
                                <th>Fax</th>
                                <th>Capital</th>
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

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
        const backendUrl = "{{ app('backendUrl') }}";


$(document).ready(function(){
    displaydataEntreprise()
  });
  
 
  function  changeBtn() {
            $('input[type="text"]').each(function() {
              $(this).val('');
            });
            $('input[type="number"]').each(function() {
              $(this).val('');
            });
            $("#add-btn").show()
            $("#update-btn").hide()
            $("#myLargeModalLabel").text('info Entreprise');
       }
       function displaydataEntreprise() {
    $.ajax({
        url: backendUrl + "/societe",
        type: "GET",
        dataType: "json",
        success: function(data) {
            // console.log(data);
            var tbody = $("#datatable-buttons tbody");
            tbody.empty(); // Clear the existing table body
            // Loop through the data and create table rows
            for (var i = 0; i < data.length; i++) {
                var company = data[i];
                var row = $("<tr></tr>");
                row.append('<td>' + company.id + '</td>');
                row.append('<td>' + company.name + '</td>');
                row.append('<td>' + company.ICE + '</td>');
                row.append('<td>' + company.IF + '</td>');
                row.append('<td>' + company.RC + '</td>');
                row.append('<td>' + company.adresse + '</td>');
                row.append('<td>' + company.email + '</td>');
                row.append('<td>' + company.telephone + '</td>');
                row.append('<td>' + company.fax + '</td>');
                row.append('<td>' + company.capital + '</td>');
                row.append('<td>' +
                    '<button onclick="editdataEntreprise(' + company.id + ')" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
                    '<i class="ri-edit-line"></i></button>' +
                    '</td>');
                tbody.append(row);
            }
        },
        error: function(data) {
            swal(data.responseJSON.message, "", "warning");
        }
    });
}


function storeDataEntreprise() {
  // Retrieve the input values
  var name = $('#nom_entreprise').val();
  var ICE = $('#ICE').val();
  var IF = $('#IF').val();
  var RC = $('#RC').val();
  var adresse = $('#adresse').val();
  var email = $('#email').val();
  var telephone = $('#telephone').val();
  var fax = $('#fax').val();
  var capital = $('#capital').val();

  // Make the AJAX request
  $.ajax({
    url: backendUrl + '/societe',
    type: 'POST',
    dataType: 'json',
    data: {
    name: name,
    ICE: ICE,
    IF: IF,
    RC: RC,
    adresse: adresse,
    email: email,
    telephone: telephone,
    fax: fax,
    capital: capital
  },
    success: function(result) {
      // Handle the response
      swal(result.message, "", "success");
            // $('input[type="text"]').each(function() {
            //   $(this).val('');
            // });
            // $('input[type="number"]').each(function() {
            //   $(this).val('');
            // });
            // $('input[type="phone"]').each(function() {
            //   $(this).val('');
            // });
            displaydataEntreprise();
    },
    error: function(response) {
      swal(response.responseJSON.message, "", "warning");
    }
  });
}




function editdataEntreprise(id) {
  console.log(id);
  $('.entrepriseModal').modal('show');

   $('#update-btn').show();
   $('#add-btn').hide();
    $("#myLargeModalLabel").text('Editer les Info');

  $.ajax({
    url: backendUrl + "/societe/" + id,
    type: 'GET',
    dataType: 'json',
    success: function(response) {
      // Populate the form fields with the retrieved data
      $('#id').val(response['company'].id);
      $('#nom_entreprise').val(response['company'].name);
      $('#ICE').val(response['company'].ICE);
      $('#IF').val(response['company'].IF);
      $('#RC').val(response['company'].RC);
      $('#adresse').val(response['company'].adresse);
      $('#email').val(response['company'].email);
      $('#telephone').val(response['company'].telephone);
      $('#fax').val(response['company'].fax);
      $('#capital').val(response['company'].capital);
    },
    error: function(response) {
    swal(response.responseJSON.message, "", "warning");
    }
  });
}
function updatedataEntreprise() {
  var id = $('#id').val();
  var name = $('#nom_entreprise').val();
  var ICE = $('#ICE').val();
  var IF = $('#IF').val();
  var RC = $('#RC').val();
  var adresse = $('#adresse').val();
  var email = $('#email').val();
  var telephone = $('#telephone').val();
  var fax = $('#fax').val();
  var capital = $('#capital').val();

  // Prepare the data to be sent in the request body
  var data = {
    name: name,
    ICE: ICE,
    IF: IF,
    RC: RC,
    adresse: adresse,
    email: email,
    telephone: telephone,
    fax: fax,
    capital: capital
  };

  $.ajax({
    url: backendUrl + "/societe/" + id,
    type: 'PUT',
    dataType: 'json',
    data: data,
    success: function(response) {
      // Handle the success response
      console.log(response);
      $('.entrepriseModal').modal('hide');
      swal(response.message, "", "success");
      displaydataEntreprise();
    },
      // Perform any additional actions or UI update
    error: function(response) {
      // Handle the error response
      console.log(response);
      swal(response.responseJSON.message, "", "warning");
    }
  });
}

// function deleterole(id){
//             swal({
//                 title: "Are you sure to delete this ?",
//                 text: "Once deleted, you will not be able to recover this imaginary file!",
//                 icon: "warning",
//                 buttons: true,
//                 dangerMode: true,
//             })
//             .then((willDelete) => {
//             if (willDelete) {
                           
//             $.ajax({
//                 url: backendUrl + "/emprole/"+ id,  
//                 type: "delete",
//                 dataType: "json",
//                 success: function(response) {
//                     swal(response.message, {
//                 icon: "success",
//             });
//             displaydatarole();
//                 },
//                 error: function() {
//                 }
//             });
                
//             } else {
//                 swal("Your imaginary file is safe!");
//             }
//             });
//         }
   

</script>