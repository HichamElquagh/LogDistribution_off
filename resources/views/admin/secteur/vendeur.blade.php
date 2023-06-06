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
            <button type="button" class="btn btn-warning fw-bold text-white" data-bs-toggle="modal" onclick="changeBtn()" data-bs-target=".fournisseurModal">Ajouter un fournisseur</button>
        </div>
        
        <span>
            @csrf
            <div class="modal fade fournisseurModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Ajouter un fournisseur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">    
                                 <input type="number" hidden name="id" id="id" >
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="fournisseurnom">Nom</label>
                                <input type="text" class="form-control" name="fournisseurnom" id="fournisseurnom" required value="{{ old('fournisseurnom')}}"/>
                                @error('fournisseurnom')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="fournisseurcode">Code Fournisseur</label>
                                <input type="text" class="form-control" name="fournisseurcode" id="fournisseurcode" required  value="{{ old('fournisseurcode')}}"/>
                                @error('fournisseurcode')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="fournisseurice">ICE</label>
                                <input type="number" class="form-control" name="fournisseurice" id="fournisseurice" value="{{ old('fournisseurice')}}"/>
                                @error('fournisseurice')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="fournisseurif">IF</label>
                                <input type="text" class="form-control" name="fournisseurif" id="fournisseurif" value="{{ old('fournisseurif')}}"/>
                                @error('fournisseurif')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="fournisseurrc">RC</label>
                                <input type="text" class="form-control" name="fournisseurrc" id="fournisseurrc" value="{{ old('fournisseurrc')}}"/>
                                @error('fournisseurrc')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="fournisseurtelephone">Téléphone</label>
                                <input type="text" class="form-control" name="fournisseurtelephone" id="fournisseurtelephone" value="{{ old('fournisseurtelephone')}}"/>
                                @error('fournisseurtelephone')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="fournisseurmail">Adress Mail</label>
                                <input type="text" class="form-control" name="fournisseurmail" id="fournisseurmail" value="{{ old('fournisseurmail')}}"/>
                                @error('fournisseurmail')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="fournisseuradress">Adresse</label>
                                <input type="text" class="form-control" name="fournisseuradress" id="fournisseuradress" value="{{ old('fournisseuradress')}}"/>
                                @error('fournisseuradress')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button onclick="storefournisseur()" class="btn btn-warning fw-bold text-white" id="add-btn">Ajouter</button>
                            <button onclick="updatefournisseur()" class="btn btn-warning fw-bold text-white" id="update-btn">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </span>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
    
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Code</th>
                                    <th>Nom</th>  
                                    <th>ICE</th>  
                                    <th>IF</th>
                                    <th>RC</th>
                                    <th>Adresse</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    {{-- <th>Date</th> --}}
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
@endsection

{{-- @section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>



        $(document).ready(function(){ 
            dislaydatafornisseur();
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
            $("#myLargeModalLabel").text('Ajouter un fournisseur');
       }

        function dislaydatafornisseur() {
            $.ajax({
                    url: 'https://iker.wiicode.tech/api/fournisseurs',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                    var tbody = $('.table tbody');
                    tbody.empty(); // Clear the existing table body

                    for(var i = 0 ; i < data.length ; i++){ 
                        
                        var fournisseur = data[i];
                        var row = $('<tr></tr>');
                        row.append('<td class="text-warning fw-bold">#' + fournisseur.id + '</td>');
                        row.append('<td>' + fournisseur.code_fournisseur + '</td>');
                        row.append('<td>' + fournisseur.fournisseur + '</td>');
                        row.append('<td>' + fournisseur.ICE + '</td>');
                        row.append('<td>' + fournisseur.IF + '</td>');
                        row.append('<td>' + fournisseur.RC + '</td>');
                        row.append('<td>' + fournisseur.Adresse + '</td>');
                        row.append('<td>' + fournisseur.email + '</td>');
                        row.append('<td>' + fournisseur.Telephone + '</td>');
                        // row.append('<td>' + fournisseur.created_at + '</td>');
                        row.append('<td>' +
                            '<a   onclick="editfournisseur('+ fournisseur.id +')" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
                            '<i class="fas fa-info-circle"></i></a>' +
                            '<div><button  onclick="deletefournisseur('+ fournisseur.id +')"   class="btn btn-outline-danger btn-sm"> <i class="fas fa-trash-alt"></i></button></div>' +
                            '</td>');
                    
                        tbody.append(row);
                    }
                },
                error: function() {
                    console.error("Error fetching data.");
                }
                });

            }   
    

            function storefournisseur() {
    // Get the form data
    const FournisseurNom = $("#fournisseurnom").val();
    const FournisseurCode = $("#fournisseurcode").val();
    const FournisseurICE = $("#fournisseurice").val();
    const FournisseurIF = $("#fournisseurif").val();
    const FournisseurRC = $("#fournisseurrc").val();
    const FournisseurTelephone = $("#fournisseurtelephone").val();
    const FournisseurMail = $("#fournisseurmail").val();
    const FournisseurAdress = $("#fournisseuradress").val();
    // console.log(FournisseurNom);

    $.ajax({
        url: 'https://iker.wiicode.tech/api/fournisseurs',
        type: "POST",
        data: {
            code_fournisseur: FournisseurCode,
            fournisseur: FournisseurNom,
            ICE: FournisseurICE,
            IF: FournisseurIF,
            RC: FournisseurRC,
            Adresse: FournisseurAdress,
            email: FournisseurMail,
            Telephone: FournisseurTelephone,
        },
        dataType: "json",
        success: function(response) {
            // console.log(response);
            swal(response.message, "", "success");
            $(".fournisseurModal").modal('hide');
            dislaydatafornisseur();
        },
        error: function(response) {
            console.log(response.message);
            // swal(response.message, "", "warning");
        }
    });
}

    function editfournisseur(id){
    //    console.log(id);
            $(".fournisseurModal").modal('show')
            $("#add-btn").hide()
            $("#update-btn").show()
            $("#myLargeModalLabel").text('Edit Fournisseur');

            $.ajax({
              url: 'https://iker.wiicode.tech/api/fournisseurs/' + id,
              type: 'GET',
              dataType: 'json',

              success: function(data){
                console.log(data);
                $('input[name="id"]').val(data['Fournisseur Requested'].id);
                $('input[name="fournisseurnom"]').val(data['Fournisseur Requested'].fournisseur);
                $('input[name="fournisseurcode"]').val(data['Fournisseur Requested'].code_fournisseur);
                $('input[name="fournisseurice"]').val(data['Fournisseur Requested'].ICE);
                $('input[name="fournisseurif"]').val(data['Fournisseur Requested'].IF);
                $('input[name="fournisseurrc"]').val(data['Fournisseur Requested'].RC);
                $('input[name="fournisseurtelephone"]').val(data['Fournisseur Requested'].Telephone);
                $('input[name="fournisseurmail"]').val(data['Fournisseur Requested'].email);
                $('input[name="fournisseuradress"]').val(data['Fournisseur Requested'].Adresse);
              },

              error: function(){

                console.log("cccccc");
              }



            });

    
  
    }
    function updatefournisseur() {
    // Get the form data
    const FournisseurId = $("#id").val();
    const FournisseurNom = $("#fournisseurnom").val();
    const FournisseurCode = $("#fournisseurcode").val();
    const FournisseurICE = $("#fournisseurice").val();
    const FournisseurIF = $("#fournisseurif").val();
    const FournisseurRC = $("#fournisseurrc").val();
    const FournisseurTelephone = $("#fournisseurtelephone").val();
    const FournisseurMail = $("#fournisseurmail").val();
    const FournisseurAdress = $("#fournisseuradress").val();
    // console.log(FournisseurId);

    $.ajax({
        url: 'https://iker.wiicode.tech/api/fournisseurs/' + FournisseurId,
        type: "PUT",
        data: {
            code_fournisseur: FournisseurCode,
            fournisseur: FournisseurNom,
            ICE: FournisseurICE,
            IF: FournisseurIF,
            RC: FournisseurRC,
            Adresse: FournisseurAdress,
            email: FournisseurMail,
            Telephone: FournisseurTelephone,
        },
        dataType: "json",
        success: function(response) {
            // console.log(response['Fournisseur Requested'].message);
            swal(response.message, "", "success");
            $(".fournisseurModal").modal('hide');
            dislaydatafornisseur();      
          },
        error: function(response) {
            // console.log('cccccccccc');
            swal("fuck uu", "", "warning");
        }
    });
}




    function deletefournisseur(id){
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
            url: 'https://iker.wiicode.tech/api/fournisseurs/' + id,
            type: "delete",
                dataType: "json",
                success: function(response) {
                swal(response.message, "", "success");
                dislaydatafornisseur();   
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

@endsection --}}