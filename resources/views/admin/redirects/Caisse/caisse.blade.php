@extends('admin.layouts.template')

@section('page-title')
Caisse | Log Dist Du Nord
@endsection

@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Caisse</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">La caisse</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-warning fw-bold text-white"  data-bs-toggle="modal" onclick="changeBtn()" data-bs-target=".magazinierModal">Ajouter une caisse</button>
        </div>


        {{-- <form action="" method="POST"> --}}
            <span>
            @csrf
            <div class="modal fade caisseModal " aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">La Caisse</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                                <input type="number" hidden class="form-control" name="id" id="id" value=""/>

                            <div class="mb-3 col-lg-4" id="soldelabel">
                                <label class="form-label" for="soldcaise" >Solde</label>
                                <input type="text" class="form-control" name="soldcaise" id="soldcaise" value="{{ old('soldcaise')}}"/>
                                @error('nomBank')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4" id="commelabel">
                                <label class="form-label" for="commentaire" >Commentaire</label>
                                <input type="text" class="form-control" name="commentaire" id="commentaire" value="{{ old('commentaire')}}"/>
                                @error('telephone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4" id="typelabel">
                                <label class="form-label" for="type" >Type</label>
                                <input type="text" class="form-control" name="type" id="type" value="{{ old('type')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-6" id="typetransactionlabel">
                                <label class="form-label" for="typetransaction" >Type transaction </label>
                                <select class="form-select" name="typetransaction" id="typetransaction">
                                    <option  > selectionnez un type de transaction  </option>
                                    <option value="withdraw" > Retrait</option>
                                    <option value="depots" > Dépôts </option>
                                    <option value="transfert" > Transfert </option>
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
                                <input type="text" class="form-control"name="sourcetransaction" id="sourcetransaction"value=""/>
                                @error('Commentaire')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                         

                            <div class="mb-3 col-lg-6" id="soldelabeltransfer">
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
                            <button onclick="storecaise()" class="btn btn-warning fw-bold text-white" id="add-btn">Ajouter</button>
                            <button onclick="addsoldetocaisse()" class="btn btn-warning fw-bold text-white" id="add-solde-btn">Ajouter un solde</button>

                            {{-- <button onclick="updatecaisse()" class="btn btn-warning fw-bold text-white" id="update-btn">Update</button> --}}
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
                @include('admin.redirects.Caisse.card_caisse');
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id= "tableButton" class="table table-centered mb-0 align-middle table-hover table-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Solde</th>
                                        <th>Commentaire</th>
                                        <th>Type</th>
                                        <th></th>

                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    <tr>                                   
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
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
                
            $(document).ready(function() {
                displayCaisseCards();
                // loadOperations();

                        });

//   function getData() {
//     $.ajax({
//       url: 'https://iker.wiicode.tech/api/caisse', // Endpoint URL
//       type: 'GET',
//       dataType: 'json',
//       success: function(response) {
//         console.log(response);

//         var tbody = $('#tableButton tbody');
//         tbody.empty();

//         for (var i = 0; i < response.length; i++) {
//           var data = response[i];

//           var row = $('<tr>');
//           row.append($('<td>').text(data.id));
//           row.append($('<td>').text(data.solde));
//           row.append($('<td>').text(data.commentaire));
//           row.append($('<td>').text(data.type));
//             row.append('<td>' +
//                     '<div><button onclick="addsoldecaisse(' + data.id + ')" class="btn btn-outline-success btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
//                     '<span class="icon-with-flag"> <i class="fas fa-exchange-alt mx-1 "></i><i class="fas fa-dollar-sign flag-icon"></i></span></button> </div>' +
//                     '</td>');
//           tbody.append(row);
//         }
//       },
//       error: function() {
//         console.error("Error retrieving data.");
//       }
//     });
//   }





     

       function  changeBtn() {
            $('input[type="text"]').each(function() {
              $(this).val('');
            });
            $('input[type="number"]').each(function() {
              $(this).val('');
            });
             $('.caisseModal').modal('show');
            $("#add-btn").show()
            $("#myLargeModalLabel").text('Ajouter une caisse');
            $("#update-btn").hide()
            $("#add-solde-btn").hide()
            $("#soldelabel").show()
            $("#motiflabel").hide()
            $("#sourcetransactionlabel").hide()
            $("#typetransactionlabel").hide()
            $("#journallabel").hide()
            $("#typelabel").show();
            $("#commelabel").show();
            $("#soldelabeltransfer").hide();
        

       }

        



                        
         
    
        function storecaise() {
       var SoldeData = $('#soldcaise').val();
       var CommentData = $('#commentaire').val();
       var TypeData = $('#type').val();

  $.ajax({
    url: 'https://iker.wiicode.tech/api/caisse', // Endpoint URL
    type: 'POST',
    data: {
        solde : SoldeData,
        commentaire : CommentData,
        type:  TypeData ,

    },
    dataType: 'json',
    success: function(response) {
      console.log(response);

      // Optionally, close the modal
      $('.caisseModal').modal('hide');
      swal(response.message, "", "success");
      getData();

      // Optionally, perform any other actions or updates on the page
      // ...
    },
    error: function(response) {
    //   console.error("Error storing data.");
    swal(response.responseJSON.message, "", "warning");    }
  });
}

function addsoldecaisse(id) {
       console.log(id);
            $('.caisseModal').modal('show');
            $("#myLargeModalLabel").text('Ajouter un solde ');
            $("#update-btn").hide()
            $("#add-btn").hide()
            $("#add-solde-btn").show()
            $("#soldelabel").hide()
            $("#motiflabel").show()
            $("#sourcetransactionlabel").show()
            $("#typetransactionlabel").show()
            $("#journallabel").show()
            $("#typelabel").hide();
            $("#commelabel").hide();
            $("#soldelabeltransfer").show();

            $('input[type="text"]').each(function() {
              $(this).val('');
            });
            $('input[type="number"]').each(function() {
              $(this).val('');
            });
          $('input[name="sourcetransaction"]').prop("readonly", true);
          $("#typetransaction").val($("#typetransaction option:first").val());
          $("#journallabel").val($("#journallabel option:first").val());
         $("#sourcetransaction").val('La caisse');     
          
        }
        function addsoldetocaisse(){
        var typetransaction = $('#typetransaction').val();
        var journal = $('#journal').val();

        // var sourcetransaction = $('#sourcetransaction').val();
        var solde = $('#solde').val();
        var motif = $('#motif').val();

        $.ajax({
            url: "https://iker.wiicode.tech/api/withdraw",
            type: 'POST',
            data: {
                type: typetransaction,
                mode : 'caisse',
                motif: motif,
                solde: solde,
                journal_id : journal,
            },
            success: function(response) {
                // Handle the success response
                $(".caisseModal").modal('hide')
                   swal(response.message, "", "success");
                   displayCaisseCards();
                   loadOperations();
            },
            error: function(response) {
                // Handle the error response
                swal(response.responseJSON.message, "", "warning");
            }
        });
         
        }

    </script>
@endsection
