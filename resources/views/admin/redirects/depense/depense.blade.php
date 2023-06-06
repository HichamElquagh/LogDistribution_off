
@extends('admin.layouts.template')

@section('page-title')
Depenses | Log Dist Du Nord
@endsection

@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Depenses</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Depenses</li>
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
                                        <th>Depense</th>
                                        <th>Tax de Depense</th>
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
                        Ajouter une Depense
                    </div>
                    <span>
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
                                <label class="form-label" for="depense">Depense</label>
                                <input type="text" required class="form-control" name="depense" id="add_depense" value="{{ old('depense')}}"/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="depense_Tax">Tax de Depense</label>
                                <input type="number" required class="form-control" name="depense_Tax" id="add_depense_Tax" value="{{ old('depense_Tax')}}"/>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button onclick="storedepense()" class="btn btn-warning fw-bold text-white">Ajouter un Depense</button>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade depenseModal" id="categoryModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Modifier un Depense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <span>
                    @csrf
                    <input type="hidden" value="" name="editDepenseId" id="editDepenseId">
                    <div class="modal-body row">

                        <div class="mb-3">
                            <label class="form-label" for="categoryname">Depense</label>
                            <input type="text" required class="form-control" name="editDepense" id="editDepense" />
                        </div>
                    </div>
                    <div class="modal-body row">

                        <div class="mb-3">
                            <label class="form-label" for="categoryname">la Tax de Depense</label>
                            <input type="number" required class="form-control" name="editDepense_Tax" id="editDepenseTax" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                        <button onclick="updatedepense()" class="btn btn-warning fw-bold text-white">Modifier</button>
                    </div>
                </span>
            </div>
        </div>
    </div>

</div>

@endsection

@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function showModel(nom,tax,id){
            document.querySelector("#Depense").value = nom;
            document.querySelector("#DepenseId").value = id;
            document.querySelector("#DepenseTax").value = tax;
        }

        $(document).ready(function(){

            displaydatadepense();
        });
        
      

        function displaydatadepense(){

        $.ajax({
           url : "https://iker.wiicode.tech/api/depense",
           type : 'GET',
           dataType : 'json',
           success: function(data) {
            // console.log(data);
            var tbody = $('.table tbody');
            tbody.empty(); // Clear the existing table body
            // Loop over the data array
            for (var i = 0; i < data.length; i++) {
                var depense = data[i];
                var row = $('<tr></tr>');
                row.append('<td>' + depense.id + '</td>');
                row.append('<td>' + depense.depense + '</td>');
                row.append('<td>' + depense.depense_Tax + ' %</td>');
                row.append('<td class="d-flex ">' +
                    '<button onclick="editdepense(' + depense.id + ')" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
                    '<i class="ri-edit-line"></i></button>' +
                    '<div class="mx-1"><button onclick="deletedepense(' + depense.id + ')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button></div>' +
                    '</td>');
                tbody.append(row);
            }
        },
        error: function(data) {
            swal(data.responseJSON.message, "", "warning");
        }
        });

        }

        function storedepense() {
            var name_depense = $('#add_depense').val();
            var depense_tax = $('#add_depense_Tax').val();

    $.ajax({
        url: "https://iker.wiicode.tech/api/depense",
        type: 'POST',
        data: {
            depense : name_depense,
            depense_Tax: depense_tax
        },
        dataType: 'json',

        success: function(response) {
            swal(response.message, "", "success");
            $('input[type="text"]').each(function() {
              $(this).val('');
            });
            $('input[type="number"]').each(function() {
              $(this).val('');
            });
            displaydatadepense();
     },
        error: function(response) {
            console.log(response);
            swal(response.responseJSON.message, "", "warning");
        }
    });
}

    function editdepense(id){
        console.log(id);
        $('.depenseModal').modal('show');

        $.ajax({
       
            url : "https://iker.wiicode.tech/api/depense/" + id,
           type : 'GET',
           dataType : 'json',
            success: function(response){
            $('input[name="editDepenseId"]').val(response.depense.id);
            $('input[name="editDepense"]').val(response.depense.depense);
            $('input[name="editDepense_Tax"]').val(response.depense.depense_Tax);
            }, 
            error:function(response){
           console.log(response);
            }

        });

    }
        function updatedepense(){
            var upDepenseId = $('#editDepenseId').val();
            var upDepensename = $('#editDepense').val();
            var upDepenseTax = $('#editDepenseTax').val();
              
             $.ajax({
                url : "https://iker.wiicode.tech/api/depense/" + upDepenseId,
           type : 'put',
           data : {
            depense : upDepensename,
            depense_Tax : upDepenseTax,
           },

           dataType : 'json',
            success:function(response){
                console.log();
                $('.depenseModal').modal('hide');
                swal(response.message, "", "success");
                displaydatadepense();
            },
            error: function(response) {
                    console.log(response)
                    swal(response.responseJSON.message, "", "warning");
                    }
             });
             
        }

        function deletedepense(id){
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
            url: "https://iker.wiicode.tech/api/depense/"  + id ,
            type: "delete",
                dataType: "json",
                success: function(response) {
                    swal(response.message, {
                icon: "success",
                });
                displaydatadepense();
                // location.reload();
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
