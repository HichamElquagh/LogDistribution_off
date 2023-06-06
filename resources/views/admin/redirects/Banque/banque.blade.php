@extends('admin.layouts.template')

@section('page-title')
Banque | Log Dist Du Nord
@endsection

@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Banque</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Banque</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-warning fw-bold text-white"  data-bs-toggle="modal" onclick="changeBtn()" data-bs-target=".magazinierModal">Ajouter un Banque</button>
        </div>


        {{-- <form action="" method="POST"> --}}
            <span>
            @csrf
            <div class="modal fade magazinierModal " aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Banque</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                                <input type="number" hidden class="form-control" name="id" id="id" value=""/>

                            <div class="mb-3 col-lg-4" id="namebanklabel">
                                <label class="form-label" for="nomBank" >Nom de Banque</label>
                                <input type="text" class="form-control" name="nomBank" id="nomBank" value="{{ old('nomBank')}}"/>
                                @error('nomBank')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4" id="telelabel">
                                <label class="form-label" for="telephone" >Téléphone</label>
                                <input type="text" class="form-control" name="telephone" id="telephone" value="{{ old('telephone')}}"/>
                                @error('telephone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4" id="adresslabel">
                                <label class="form-label" for="adresse" >Address</label>
                                <input type="text" class="form-control" name="adresse" id="adresse" value="{{ old('adresse')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6" id="nmrcomptlabel">
                                <label class="form-label" for="numero_compt" >Numero de Compte</label>
                                <input type="text" class="form-control" name="numero_compt" id="numero_compt" value="{{ old('numero_compt')}}"/>
                                @error('numero_compt')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6" id="riblabel">
                                <label class="form-label" for="rib_compt" >RIB</label>
                                <input type="text" class="form-control" name="rib_compt" id="rib_compt" value="{{ old('rib_compt')}}"/>
                                @error('rib_compt')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6" id="commentlabel">
                                <label class="form-label" for="Commentaire" >Commentaire</label>
                                <input type="text" class="form-control" name="Commentaire" id="Commentaire" value="{{ old('Commentaire')}}"/>
                                @error('rib_compt')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-3 col-lg-6" id="typetransactionlabel">
                                <label class="form-label" for="typetransaction" >Type transaction </label>
                                <select class="form-select" name="typetransaction" id="typetransaction">
                                    <option  > selectionnez un type de transaction  </option>
                                    <option value="withdraw" > Retrait</option>
                                    <option value="depots" > Dépôts </option>
                                    <option value="transfert" > Transfert  </option>
                                   
                                </select>
                            </div>
                            <div class="mb-3 col-lg-6" id="journallabel">
                                <label class="form-label" for="journal" >Jornal </label>
                                <select class="form-select" name="journal" id="journal">
                                    <option  > selectionnez un jornal  </option>
                              @foreach ( $allJournals as $journal )
                              <option value="{{ $journal['id'] }}" > {{ $journal['Code_journal']}} </option>
                              @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-lg-6" id="sourcetransactionlabel">
                              <label class="form-label" for="sourcetransaction">Source Transaction</label>
                                <input type="text" class="form-control"name="sourcetransaction" id="sourcetransaction"value="Compte Bancaire"/>
                                @error('Commentaire')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                         

                            <div class="mb-3 col-lg-6" id="soldelabel">
                                <label class="form-label" for="solde">Montant</label>
                                <input type="text" class="form-control" name="solde" id="solde" value="{{ old('solde')}}"/>
                                @error('Commentaire')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6" id="motiflabel">
                                <label class="form-label" for="motif">Motif</label>
                                <input type="text" class="form-control" name="motif" id="motif" value="{{ old('motif')}}"/>
                                @error('Commentaire')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                       

                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button onclick="storebank()" class="btn btn-warning fw-bold text-white" id="add-btn">Ajouter</button>
                            <button onclick="updatebank()" class="btn btn-warning fw-bold text-white" id="update-btn">Update</button>
                            <button onclick="addsoldetobank()" class="btn btn-warning fw-bold text-white" id="add-solde-btn">Ajouter un solde</button>
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
                   @include('admin.redirects.Banque.card_banque');
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- <table class="table table-centered mb-0 align-middle table-hover table-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Banque</th>
                                        <th>Adresse</th>
                                        <th>Telephone</th>
                                        <th>Numero Compt</th>
                                        <th>RIB Compt</th>
                                        <th>Solde</th>
                                        <th>Commentaire</th>

                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    <tr>                                   
                                    </tr>
                                </tbody>
                            </table> --}}
                        {{-- </div>
                    </div>
                </div>  --}}
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
                cardbank();
            });
    

        //      function displaydatabank(){
        // //     $.ajax({
        // //         url: 'https://iker.wiicode.tech/api/bank',
        // //         type: 'GET',
        // //         dataType: 'json',
        // //         success: function(data) {
        // //             console.log(data)
        // //         var tbody = $('.table tbody');
        // //         tbody.empty(); // Clear the existing table body
        // //         // Loop over the data array
        // //         for (var i = 0; i < data.length; i++) {
        // //         var bank = data[i];
        // //         var row = $('<tr></tr>');

        // //         row.append('<td class="text-warning fw-bold">' + bank.id + '</td>');
        // //         row.append('<td class="TdBanque">' + bank.nomBank + '</td>');
        // //         row.append('<td class="TdTelephone">' + bank.telephone + '</td>');
        // //         row.append('<td class="TdAdresse">' + bank.adresse + '</td>');
        // //         row.append('<td class="TdNumeroCompt">' + bank.numero_compt + '</td>');
        // //         row.append('<td class="TdRIBCompt">' + bank.rib_compt + '</td>');
        // //         row.append('<td class="TdSolde">' + bank.solde + '</td>');
        // //         row.append('<td class="TdCommentaire">' + bank.Commentaire + '</td>');
        // //         row.append('<td>' +
        // //             '<a onclick="editbank(' + bank.id + ')" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
        // //             '<i class="fas fa-info-circle  mx-2"></i></a>' +
        // //             '<div><button onclick="addsoldebank(' + bank.id + ')" class="btn btn-outline-success btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
        // //             '<span class="icon-with-flag"> <i class="fas fa-exchange-alt mx-1 "></i><i class="fas fa-dollar-sign flag-icon"></i></span></button> </div>' +
        // //             '</td>');

        // //         tbody.append(row);
        // //     }
        // // },
        // // error: function() {
        // //     console.error("Error fetching data.");
        // // }
        // //     });
        // }





     

       function  changeBtn() {
            $('input[type="text"]').each(function() {
              $(this).val('');
            });
            $('input[type="number"]').each(function() {
              $(this).val('');
            });
            $("#add-btn").show()
            $("#update-btn").hide()
            $("#myLargeModalLabel").text('Info banque');
            $("#add-solde-btn").hide()
            $("#soldelabel").hide()
            $("#motiflabel").hide()
            $("#sourcetransactionlabel").hide()
            $("#typetransactionlabel").hide()
            $("#journallabel").hide()
            $("#namebanklabel").show();
            $("#telelabel").show();
            $("#adresslabel").show();
            $("#nmrcomptlabel").show();
            $("#riblabel").show();
            $("#commentlabel").show();

       }

        
        function storebank() {
            const NOMBANK = $("#nomBank").val();
            const TELEPHONE = $("#telephone").val();
            const ADRESSE = $("#adresse").val();
            const NUMERO_COMPTE = $("#numero_compt").val();
            const RIB_COMPTE = $("#rib_compt").val();
            const COMMENTAIRE = $("#Commentaire").val();

            $.ajax({
                url: "https://iker.wiicode.tech/api/bank",
                type: "POST",
                data: {
                    nomBank: NOMBANK,
                    adresse: ADRESSE,
                    telephone: TELEPHONE,
                    numero_compt: NUMERO_COMPTE,
                    rib_compt: RIB_COMPTE,
                    Commentaire: COMMENTAIRE
                },
                    dataType: "json",
                    success: function(response) {
                    console.log(response);
                    swal(response.message, "", "success");
                   $(".magazinierModal").modal('hide')
                   cardbank();
                    loadOperations();   
                   loadTransactions();
              
                    },
                    error: function(response) {
                        console.log(response.responseJSON.message);
                        swal(response.responseJSON.message, "", "warning");
                        // $(".magazinierModal").modal('hide')
                        //  displaydatabank();
                    }
            });
        }

         function editbank(id){
    
             console.log(id);
            $(".magazinierModal").modal('show')
            $("#add-btn").hide()
            $("#update-btn").show()
            $("#add-solde-btn").hide()
            $("#soldelabel").hide()
            $("#motiflabel").hide()
            $("#sourcetransactionlabel").hide()
            $("#typetransactionlabel").hide()
            $("#namebanklabel").show();
            $("#telelabel").show();
            $("#adresslabel").show();
            $("#nmrcomptlabel").show();
            $("#riblabel").show();
            $("#commentlabel").show();
            $("#myLargeModalLabel").text('Edit banque');

            $.ajax({
                url: 'https://iker.wiicode.tech/api/bank/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('input[name="id"]').val(data.id);
                    $('input[name="nomBank"]').val(data.nomBank);
                    $('input[name="telephone"]').val(data.telephone);
                    $('input[name="adresse"]').val(data.adresse);
                    $('input[name="numero_compt"]').val(data.numero_compt);
                    $('input[name="rib_compt"]').val(data.rib_compt);
                    $('input[name="Commentaire"]').val(data.Commentaire);
                },
                error: function() {
                    console.error("cccccccccccc");
                }
            });
        }
        function updatebank(){
            const ID = $("#id").val();
            const NOMBANK = $("#nomBank").val();
            const TELEPHONE = $("#telephone").val();
            const ADRESSE = $("#adresse").val();
            const NUMERO_COMPTE = $("#numero_compt").val();
            const RIB_COMPTE = $("#rib_compt").val();
            const COMMENTAIRE = $("#Commentaire").val();

            $.ajax({

                url: "https://iker.wiicode.tech/api/bank/ " + ID,
                type: "put",
                data: {
                    nomBank: NOMBANK,
                    adresse: ADRESSE,
                    telephone: TELEPHONE,
                    numero_compt: NUMERO_COMPTE,
                    rib_compt: RIB_COMPTE,
                    Commentaire: COMMENTAIRE
                },
                    dataType: "json",
                    success: function(response) {
                        // $('.table tbody').empty();
                   $(".magazinierModal").modal('hide')
                   swal(response.message, "", "success");
                   displaydatabank();
                    // location.reload();
                    },
                    error: function() {
                    swal(response.message, "", "warning");
                    }
            });

        }
        function addsoldebank(id) {
       console.log(id);
            $(".magazinierModal").modal('show')
            $("#add-btn").hide()
            $("#update-btn").hide()
            $("#add-solde-btn").show()
            $("#myLargeModalLabel").text('Ajouter un solde au ');
            $("#namebanklabel").hide();
            $("#telelabel").hide();
            $("#adresslabel").hide();
            $("#nmrcomptlabel").hide();
            $("#riblabel").hide();
            $("#commentlabel").hide();
            $("#soldelabel").show();
            $("#motiflabel").show();
            $("#sourcetransactionlabel").show();
            $("#journallabel").show()
            $("#typetransactionlabel").show();
            $('input[type="text"]').each(function() {
              $(this).val('');
            });
            $('input[type="number"]').each(function() {
              $(this).val('');
            });
            $.ajax({
                url: 'https://iker.wiicode.tech/api/bank/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                  
                    $("#myLargeModalLabel").text('Affecter une operation A  '+ data.nomBank +' ');
                    $('input[name="sourcetransaction"]').prop("readonly", true);
                    $("#typetransaction").val($("#typetransaction option:first").val());
                    $("#journallabel").val($("#journallabel option:first").val());
                    $("#sourcetransaction").val('Compte Bancaire')

                },
                error: function(data) {
                  
                }
            });
          
        }

        function addsoldetobank(){
        var typetransaction = $('#typetransaction').val();
        // var sourcetransaction = $('#sourcetransaction').val();
        var journal = $('#journal').val();
        var solde = $('#solde').val();
        var motif = $('#motif').val();

        $.ajax({
            url: "https://iker.wiicode.tech/api/withdraw",
            type: 'POST',
            data: {
                type: typetransaction,
                mode : 'bank',
                motif: motif,
                solde: solde,
                journal_id : journal,
            },
            success: function(response) {
                // Handle the success response
                $(".magazinierModal").modal('hide')
                   swal(response.message, "", "success"); 
                     cardbank();
                    loadOperations();        
                   loadTransactions();     
                   },
            error: function(response) {
                // Handle the error response
                swal(response.responseJSON.message, "", "warning");
            }
        });
         
        }

        function deletebank(id){
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
            url: "https://iker.wiicode.tech/api/bank/ " + id ,
            type: "delete",
                dataType: "json",
                success: function(response) {
                console.log(response);
                displaydatabank();
                // location.reload();
                },
                error: function() {
                console.error("cccccccccccc");
                }
            });
                swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
                });
            } else {
                swal("Your imaginary file is safe!");
            }
            });
                        
         
        }
           
        

    </script>
@endsection
