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
                    <h4 class="mb-sm-0">Warehouse</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Warehouse</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-warning fw-bold text-white"  data-bs-toggle="modal" onclick="changeBtn()" data-bs-target=".WarehouseModal"> Ajouter un stock </button>
        </div>


        {{-- <form action="" method="POST"> --}}
            <span>
            @csrf
            <div class="modal fade WarehouseModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Ajouter un Warehouse</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                                <input type="number" hidden class="form-control" name="id" id="id" value=""/>

                                
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="nom_warehouse">Warehouse</label>
                                <input type="text" class="form-control" name="nom_warehouse" id="nom_warehouse" value="{{ old('nom_warehouse')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="city">City</label>
                                <input type="text" class="form-control" name="city" id="city" value="{{ old('city')}}"/>
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
                                <label class="form-label" for="telephone">Telephone</label>
                                <input type="phone" class="form-control" name="telephone" id="telephone" value="{{ old('telephone')}}"/>
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
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button onclick="storewarehouse()" class="btn btn-warning fw-bold text-white" id="add-btn">Ajouter</button>
                            <button onclick="updatewarehouse()"  class="btn btn-warning fw-bold text-white" id="update-btn">Update</button>
                        </div>
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Warehouse</th>
                                        <th>City</th>
                                        <th>Adresse</th>
                                        <th>Telephone</th>
                                        <th>email</th>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        // import swal from 'sweetalert';

        function showModel(nom,id){
            document.querySelector("#category").value = nom;
            document.querySelector("#categoryId").value = id;
            }
                
            $(document).ready(function(){ 
                displaydatawarehouse() 
                        });

    
    function displaydatawarehouse() {
    $.ajax({
        url: "https://iker.wiicode.tech/public/api/warehouse",
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data)
            var tbody = $('.table tbody');
            tbody.empty(); // Clear the existing table body
    
            // Loop over the data array
            for (var i = 0; i < data.length; i++) {
                var warehouse = data[i];
                var row = $('<tr></tr>');
                row.append('<td>' + warehouse.id + '</td>');
                row.append('<td>' + warehouse.nom_Warehouse + '</td>');
                row.append('<td>' + warehouse.city + '</td>');
                row.append('<td>' + warehouse.adresse + '</td>');
                row.append('<td>' + warehouse.telephone + '</td>');
                row.append('<td>' + warehouse.email + '</td>');
                row.append('<td>' +
                    '<button onclick="editwarehouse(' + warehouse.id + ')" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
                    '<i class="fas fa-info-circle"></i></button>' +
                    '<div><button onclick="deletewarehouse(' + warehouse.id + ')" class="btn btn-outline-danger btn-sm"> <i class="fas fa-trash-alt"></i></button></div>' +
                    '</td>');

                tbody.append(row);
            }
        },
        error: function() {
            swal(data.responseJSON.message, "", "warning");
        }
    });
}







     

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
            $('input[type="email"]').each(function() {
              $(this).val('');
            });
            $("#add-btn").show()
            $("#update-btn").hide()
            $("#myLargeModalLabel").text('Ajouter un Warehouse');
       }

        
       function storewarehouse() {
    // Retrieve the values from the input fields
    var nomWarehouse = $('#nom_warehouse').val();
    var city = $('#city').val();
    var adresse = $('#adresse').val();
    var telephone = $('#telephone').val();
    var email = $('#email').val();


    // Make the AJAX request to store the warehouse data
    $.ajax({
        url: "https://iker.wiicode.tech/public/api/warehouse",
        type: 'POST',
        data : {
        nom_Warehouse: nomWarehouse,
        city: city,
        adresse: adresse,
        telephone: telephone,
        email: email

        },
        dataType: 'json',
        success: function(response) {
            // console.log(response);
            swal(response.message, "", "success");
            $(".WarehouseModal").modal('hide');
            displaydatawarehouse();
        },
        error: function(response) {
            swal(response.responseJSON.message, "", "warning");
        }
    });
}



function editwarehouse(warehouseId) {
  
    // Open the warehouse modal for editing
    $('.WarehouseModal').modal('show');
    // Show the update button and hide the add button
    $('#update-btn').show();
    $('#add-btn').hide();
    $("#myLargeModalLabel").text('Editer le Warehouse');
      // Make the AJAX request to fetch the warehouse data for editing
    $.ajax({
        url: "https://iker.wiicode.tech/public/api/warehouse/" + warehouseId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Handle the success response here
            var warehouse = response.warehouse;

            // Set the values in the input fields for editing
            $('#id').val(warehouse.id);
            $('#nom_warehouse').val(warehouse.nom_Warehouse);
            $('#city').val(warehouse.city);
            $('#adresse').val(warehouse.adresse);
            $('#telephone').val(warehouse.telephone);
            $('#email').val(warehouse.email);
        },
        error: function(response) {
            // Handle the error response here
            console.log(response);
        }
    });
}
    function updatewarehouse() {
        // Retrieve the values from the input fields
        var warehouseId = $('#id').val();
        var nomWarehouse = $('#nom_warehouse').val();
        var city = $('#city').val();
        var adresse = $('#adresse').val();
        var telephone = $('#telephone').val();
        var email = $('#email').val();

    // Make the AJAX request to update the warehouse data
    $.ajax({
        url: "https://iker.wiicode.tech/public/api/warehouse/" + warehouseId,
        type: 'PUT',
        data : {
            nom_Warehouse: nomWarehouse,
            city: city,
            adresse: adresse,
            telephone: telephone,
            email: email
        },
        dataType: 'json',
        success: function(response) {
           
            // $('.table tbody').empty();
        $(".WarehouseModal").modal('hide')
        swal(response.message, "", "success");
        displaydatawarehouse();

        // location.reload();
        },
        error: function(response) {
        swal(response.responseJSON.message, "", "warning");
        }
    });
}


        function deletewarehouse(warehouseId){
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
                url: "https://iker.wiicode.tech/public/api/warehouse/" + warehouseId,
            type: "delete",
                dataType: "json",
                success: function(response) {
                    swal(response.message, {
                icon: "success",
                });
                displaydatawarehouse();
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
                       