@extends('admin.layouts.template')

@section('page-title')
wireHouse| Log Dist Du Nord
@endsection

@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Role</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-warning fw-bold text-white"  data-bs-toggle="modal" onclick="changeBtn()" data-bs-target=".roleModal"> Ajouter un stock </button>
        </div>


        {{-- <form action="" method="POST"> --}}
            <span>
            @csrf
            <div class="modal fade roleModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Ajouter un Role</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                                <input type="number" hidden class="form-control" name="id" id="id" value=""/>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="nom_role">Role</label>
                                <input type="text" class="form-control" name="nom_role" id="nom_role" value="{{ old('nom_role')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button onclick="storerole()" class="btn btn-warning fw-bold text-white" id="add-btn">Ajouter </button>
                            <button onclick="updaterole()" class="btn btn-warning fw-bold text-white" id="update-btn">Update</button>
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
                       
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Role</th>
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

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

$(document).ready(function(){
    displaydatarole();
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
            $("#myLargeModalLabel").text('Ajouter un Role');
       }
       function displaydatarole() {
    $.ajax({
        url: "https://iker.wiicode.tech/api/emprole",
        type: "GET",
        dataType: "json",
        success: function(data) {
            console.log(data);
            var tbody = $(".table tbody");
            tbody.empty(); // Clear the existing table body
            // Loop through the data and create table rows
            for (var i = 0; i < data.length; i++) {
                var role = data[i];
                var row = $("<tr></tr>");
                row.append('<td>' + role.id + '</td>');
                row.append('<td>' + role.role_name + '</td>');
                row.append('<td>' +
                    '<button onclick="editrole(' + role.id + ')" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
                    '<i class="ri-edit-line"></i></button>' +
                    '<div class="mx-1"><button onclick="deleterole(' + role.id + ')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button></div>' +
                    '</td>');
                    tbody.append(row);
            }
        },
           error: function(data) {
            swal(data.responseJSON.message, "", "warning");
        }
    });
}


       function storerole() {

      var  nom_role =  $('input[name="nom_role"]').val()

    $.ajax({
        url: "https://iker.wiicode.tech/api/emprole" ,  // Replace with your API endpoint to store a new role
        type: 'POST',
        dataType: 'json',
        data: {
            role_name : nom_role,
        },  
        success: function(response) {
            console.log(response);
            swal(response.message, "", "success");
            // Optionally, you can close the modal or perform any other actions
              $(".roleModal").modal("hide");
            // Handle success response, e.g., show a success message, update the role list, etc.
            displaydatarole();
        },
        error: function(response) {     
             swal(response.responseJSON.message, "", "warning");
            // Handle error response, e.g., show an error message
        }
    });
}
function editrole(roleId) {
    
    // Show the modal for editing the role
    $(".roleModal").modal("show");
    $("#myLargeModalLabel").text('Modifier un Role');
    $("#add-btn").hide();
    $("#update-btn").show();

    // Retrieve the role data from the API using AJAX
    $.ajax({
        url: "https://iker.wiicode.tech/api/emprole/" + roleId,
        type: "GET",
        dataType: "json",
        success: function(data) {
            console.log(data);
            // Populate the form fields with the retrieved role data
            $("#id").val(data.role.id);
            $("#nom_role").val(data.role.role_name);
        },
        error: function(data) {
            swal(data.responseJSON.message, "", "warning");
        }
    });
}
function updaterole() {
    var roleId = $("#id").val();
    var nomRole = $("#nom_role").val();
    // Send the AJAX request to update the role
    $.ajax({
        url: "https://iker.wiicode.tech/api/emprole/" + roleId ,
        type: "PUT",
        dataType: "json",
        data: {
            role_name : nomRole ,
        },
        success: function(response) {
            swal(response.message, "", "success");
            // Optionally, you can close the modal or perform any other actions
            $(".roleModal").modal("hide");
            // Call the displaydatarole() function to refresh the role data in the table
            displaydatarole();
        },
        error: function(response) {
            swal(response.responseJSON.message, "", "warning");
        }
    });
}




function deleterole(id){
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
                url: "https://iker.wiicode.tech/api/emprole/"+ id,  
                type: "delete",
                dataType: "json",
                success: function(response) {
                    swal(response.message, {
                icon: "success",
            });
            displaydatarole();
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