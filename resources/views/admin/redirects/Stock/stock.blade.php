@extends('admin.layouts.template')

@section('page-title')
Stock | Log Dist Du Nord
@endsection

@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Stock</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Stock</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-warning fw-bold text-white"  data-bs-toggle="modal" onclick="changeBtn()" data-bs-target=".StockModal"> Ajouter un stock </button>
        </div>


        {{-- <form action="" method="POST"> --}}
            <span>
            @csrf
            <div class="modal fade StockModal " aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Stock</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                                <input type="number" hidden class="form-control" name="id" id="id" value=""/>

                                <div class="mb-3 col-lg-4" id="label_nomArticle" >
                                    <label class="form-label"  for="nomArticle">Articles</label>
                                    <select class="form-select" name="nomArticle" id="nomArticle">
                                        <option >choisir un article </option>
                                        @foreach ($allArticles['data'] as $article )
                                        <option value="{{$article['id']}}">{{$article['article_libelle']}}</option>
                                        @endforeach
                                        <!-- Add more options as needed -->
                                    </select>
                                    @error('nomBank')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                

                                <div class="mb-3 col-lg-4" id="label_warehouse">
                                    <label class="form-label"  for="warehouse">Warehouses</label>
                                    <select class="form-select" name="warehouse" id="warehouse">
                                        <option value="">choisir un warhouse</option>
                                        <!-- Add more options as needed -->
                                        @foreach ($allWarehouses as $warehouse )
                                        <option value="{{$warehouse['id']}}">{{$warehouse['nom_Warehouse']}}</option>
                                        @endforeach
                                    </select>
                                    @error('nomBank')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="actual_stock">Actual Stock</label>
                                <input type="number" class="form-control" name="actual_stock" id="actual_stock" value="{{ old('actual_stock')}}"/>
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4" id="add_stock">
                                <label class="form-label" for="add_stock">Add Stock</label>
                                <input type="number" class="form-control" name="add_stock" id="calcul_add_stock"  value="{{ old('add_stock')}}"/>
                                @error('add_or_decrease_stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4" id="decrease_stock">
                                <label class="form-label" for="decrease_stock">Decrease Stock</label>
                                <input type="number" class="form-control" name="decrease_stock" id="calcul_decrease_stock"  value="{{ old('decrease_stock')}}"/>
                                @error('add_or_decrease_stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4" id="total">
                                <label class="form-label" for="total">Total</label>
                                <input type="number" class="form-control" name="total" id="calcul_total_stock"/>
                                @error('total')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button onclick="addTostock()" class="btn btn-success fw-bold text-white" id="addto-btn">Plus</button>
                            <button onclick="decreaseTostock()" class="btn btn-danger fw-bold text-white" id="decrease-btn">Moins</button>
                            <button onclick="storestock()" class="btn btn-warning fw-bold text-white" id="add-btn">Ajouter</button>
                            <button onclick="updatestock()"  class="btn btn-warning fw-bold text-white" id="update-btn">Update</button>
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
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap text-center">
                                <thead>
                                    <tr class="text-center">
                                        <th>id</th>
                                        <th>Articles</th>
                                        <th>Warehouses</th>
                                        <th>Actual Stock</th>
                                        <th>Operations</th>
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
                displaydatastock() 
                        });

    
function displaydatastock() {
    $.ajax({
        url: "https://iker.wiicode.tech/api/inventories",
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var tbody = $('.table tbody');
            tbody.empty();
          
            for (var i = 0; i < data.length; i++) {
                var stock = data[i];
                var row = $('<tr></tr>');
                row.append('<td>' + stock.id + '</td>');
                row.append('<td>' + stock.article_libelle + '</td>');
                row.append('<td>' + stock.nom_Warehouse + '</td>');
                row.append('<td>' + stock.actual_stock + '</td>');
                row.append('<td class="d-flex justify-content-center ">' +
                    '<div class="m-2"><button onclick="addstock(' + stock.id + ')" class="btn btn-outline-success btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
                    '<i class="ri-add-line"></i></button>' +
                    '<div><button onclick=" decreasestock(' + stock.id + ')" class="btn btn-outline-danger btn-sm"><i class="ri-subtract-line"></i></button></div></div>' +
                    '<div class="m-2"><button onclick="editstock(' + stock.id + ')" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
                    '<i class="ri-edit-line"></i></button>' +
                    '<div><button onclick="deletestock(' + stock.id + ')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button></div></div>' +
                    '</td>');
 
                tbody.append(row);
            }
        },
        error: function(data) {
            swal(data.responseJSON.message, "", "warning");
            
        }
    });
}

    $(document).ready(function() {
    // Listen for input/change event on the quantity input field
    $("#calcul_decrease_stock").on("input", function() {
        // Get the entered quantity value
        let ActualStock = $('input[name="actual_stock"]').val();
        let quantity = parseFloat($(this).val());

        // Perform calculation (e.g., multiply the quantity by 2)
        let result =  Number(ActualStock) - quantity ;

        // Display the result in the result span
        $("#calcul_total_stock").val(result);
    });
    $("#calcul_add_stock").on("input", function() {
        // Get the entered quantity value
        let ActualStock = $('input[name="actual_stock"]').val();
        let quantity = parseFloat($(this).val());

        // Perform calculation (e.g., multiply the quantity by 2)
        let result = Number(ActualStock) + quantity ;

        // Display the result in the result span
        $("#calcul_total_stock").val(result);
    });
});








     function addstock(id){

        $('input[type="number"]').each(function() {
              $(this).val('');
            });
        $("#myLargeModalLabel").text('Agrandire la quantité du stock actual ');
        $(".StockModal").modal('show');
        $("#add-btn").hide();
        $("#update-btn").hide();
        $("#decrease-btn").hide();
        $("#addto-btn").show();
        $.ajax({
                url: "https://iker.wiicode.tech/api/inventories/" + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $("#label_nomArticle").hide();
                    $("#label_warehouse").hide();
                    $("#decrease_stock").hide();
                    $("#add_stock").show();
                    $("#total").show();
                    $('input[name="actual_stock"]').val(data.Inventory.actual_stock);
                    $('input[name="actual_stock"]').prop("readonly", true);
                    $('input[name="total"]').prop("readonly", true);
                    $('input[name="id"]').val(data.Inventory.id);
                },
                error: function() {
                    console.error("cccccccccccc");
                }
            });
        }

     


     function decreasestock(id){
        $('input[type="number"]').each(function() {
              $(this).val('');
            });
        $("#myLargeModalLabel").text(' réduire la quantité du stock actual ');
        $(".StockModal").modal('show');
        $("#add-btn").hide();
        $("#update-btn").hide();
        $("#addto-btn").hide();
        $("#decrease-btn").show();
        $.ajax({
                url: "https://iker.wiicode.tech/api/inventories/" + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $("#label_nomArticle").hide();
                    $("#label_warehouse").hide();
                    $("#add_stock").hide();
                    $("#decrease_stock").show();
                    $("#total").show();
                    $('input[name="actual_stock"]').val(data.Inventory.actual_stock);
                    $('input[name="actual_stock"]').prop("readonly", true);
                    $('input[name="total"]').prop("readonly", true);
                    $('input[name="id"]').val(data.Inventory.id);
                },
                error: function() {
                    console.error("cccccccccccc");
                }
            });
        
       }

       function addTostock(){
        const ID = $("#id").val();
            const Total_stock = $("#calcul_total_stock").val();
              if (Total_stock >=0) {
                $.ajax({
                url: "https://iker.wiicode.tech/api/inventories/" + ID,
                type: "put",
                 data: {
                    actual_stock : Total_stock,
                  },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        // $('.table tbody').empty();
                   $(".StockModal").modal('hide')
                   swal(response.message, "", "success");
                   displaydatastock();

                    // location.reload();
                    },
                    error: function(response) {
                    console.log(response)
                    swal(response.responseJSON.message, "", "warning");
                    }
            }); 


              } else {
            
            swal("total doit etre egale ou superieure a 0 ", "", "warning");
                $("#calcul_add_stock").val('');
                $("#calcul_total_stock").val('');
              }
            
        }

    
    function decreaseTostock(){
        const ID = $("#id").val();
        const Total_stock = $("#calcul_total_stock").val();
        const checkDecrease_stock = $("#calcul_decrease_stock").val();
        console.log('descrstock',checkDecrease_stock);
        const check_Actul_stock = $("#actual_stock").val();
        console.log('actual_stock',check_Actul_stock);

        if ( checkDecrease_stock <= 0 ) {
            swal(" decrease Stock  doit etre superieure ou egale  au 0   ", "", "warning");
                $("#calcul_decrease_stock").val('');
                $("#calcul_total_stock").val('');
          
              } else if ( checkDecrease_stock <= check_Actul_stock ) {
                $.ajax({
                url: "https://iker.wiicode.tech/api/inventories/" + ID,
                type: "put",
                 data: {
                    actual_stock : Total_stock,
                  },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        // $('.table tbody').empty();
                   $(".StockModal").modal('hide')
                   swal(response.message, "", "success");
                   displaydatastock();

                    // location.reload();
                    },
                    error: function(response) {
                    console.log(response)
                    swal(response.responseJSON.message, "", "warning");
                    }
            });
               
        } else {

            swal(" decrease Stock  doit etre inferieure ou egale au actual_stock  ", "", "warning");
                $("#calcul_decrease_stock").val('');
                $("#calcul_total_stock").val('');
          
        }
}




       function  changeBtn() {
            $('input[type="text"]').each(function() {
              $(this).val('');
            });
            $('input[type="number"]').each(function() {
              $(this).val('');
            });
            $("#warehouse").val($("#warehouse option:first").val());
            $("#nomArticle").val($("#nomArticle option:first").val());
            //  $('#warehouse').find('option').each(function() {
            //   $(this).
            // });
            $("#label_nomArticle").show();
            $("#label_warehouse").show();
            $("#decrease_stock").hide();
            $('input[name="actual_stock"]').prop("readonly", false);
            $("#add_stock").hide();
            $("#total").hide();
            // button 
            $("#add-btn").show()
            $("#update-btn").hide()
            $("#addto-btn").hide();
            $("#decrease-btn").hide();
            // header modal
            $("#myLargeModalLabel").text('Ajouter un Stock');
       }

        
       function storestock () {
    const nomArticle = $("#nomArticle  option:selected").val();
    const warehouse = $("#warehouse  option:selected").val();
    const actual_stock = $("#actual_stock").val();

    $.ajax({
        url: "https://iker.wiicode.tech/api/inventories",
        type: "POST",
        data: {
            article_id: nomArticle,
            warehouse_id: warehouse,
            actual_stock: actual_stock
        },
        dataType: "json",
        success: function(response) {
            console.log(response);
            swal(response.message, "", "success");
            $(".StockModal").modal('hide');
            displaydatastock();
        },
        error: function(response) {
            console.log(response);
            swal(response.responseJSON.message, "", "warning");
        }
    });
}


         function editstock(id){
    
             console.log(id);
            $(".StockModal").modal('show')
            $("#add-btn").hide()
            $("#update-btn").show()
            $("#myLargeModalLabel").text('Edit Stock');
            $("#addto-btn").hide();
            $("#decrease-btn").hide();

            $.ajax({
                url: "https://iker.wiicode.tech/api/inventories/" + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $("#label_nomArticle").hide();
                    $("#label_warehouse").hide();
                    $("#decrease_stock").hide();
                    $("#add_stock").hide();
                    $("#total").hide();
                    $('input[name="actual_stock"]').val(data.Inventory.actual_stock);
                    $('input[name="actual_stock"]').prop("readonly", false);
                    $('input[name="id"]').val(data.Inventory.id);
                },
                error: function() {
                    console.error("cccccccccccc");
                }
            });
        }
        function updatestock(){
            const ID = $("#id").val();
            const Actual_Stock = $("#actual_stock").val();
            if (Actual_Stock >= 0) {
                $.ajax({
                url: "https://iker.wiicode.tech/api/inventories/" + ID,
                type: "put",
                 data: {
                    actual_stock : Actual_Stock,
                  },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        // $('.table tbody').empty();
                   $(".StockModal").modal('hide')
                   swal(response.message, "", "success");
                   displaydatastock();

                    // location.reload();
                    },
                    error: function(response) {
                    console.log(response)
                    swal(response.responseJSON.message, "", "warning");
                    }
            });
               
              } else {
                swal("total doit etre egale ou superieure au 0 ", "", "warning");
                $("#actual_stock").val(Actual_Stock);
          
        } 
        }

        function deletestock(id){
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
            url: "https://iker.wiicode.tech/api/inventories/" + id ,
            type: "delete",
                dataType: "json",
                success: function(response) {
                    swal(response.message, {
                icon: "success",
                });
                displaydatastock();
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
