@extends('admin.layouts.template')

@section('page-title')
    Employés | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Employés</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Employés</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-warning fw-bold text-white" onclick="changeBtn()" data-bs-toggle="modal" data-bs-target=".employeModal">Ajouter un employé</button>
        </div>
        
        <span>
            @csrf
            <div class="modal fade employeModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Ajouter un employé</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">    
                            <input type="number" hidden name="employeid" id="employeid">

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="employenom">Nom</label>
                                <input type="text" class="form-control" name="employenom" id="employenom" value="{{ old('employenom')}}"/>
                                @error('employenom')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="employecode">Code Employé</label>
                                <input type="text" class="form-control" name="employecode" id="employecode" value="{{ old('employecode')}}"/>
                                @error('employecode')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="employerole">Rôle</label>
                                <select class="form-select" name="employerole" id="employerole">
                                    @foreach($SoloRole as $role)
                                        <option value="{{$role['id']}}">{{$role['role_name']}}</option>
                                    @endforeach
                                </select>
                                @error('employerole')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="employecin">CIN</label>
                                <input type="text" class="form-control" name="employecin" id="employecin" value="{{ old('employecin')}}"/>
                                @error('employecin')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="employematricule">Matricule</label>
                                <input type="text" class="form-control" name="employematricule" id="employematricule" value="{{ old('employematricule')}}"/>
                                @error('employematricule')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="employetelephone">Téléphone</label>
                                <input type="text" class="form-control" name="employetelephone" id="employetelephone" value="{{ old('employetelephone')}}"/>
                                @error('employetelephone')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="employemail">Adress Mail</label>
                                <input type="text" class="form-control" name="employemail" id="employemail" value="{{ old('employemail')}}"/>
                                @error('employemail')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="employeadress">Adresse</label>
                                <input type="text" class="form-control" name="employeadress" id="employeadress" value="{{ old('employeadress')}}"/>
                                @error('employeadress')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="employedate_embauche"> Date Embauche</label>
                                <input type="date" class="form-control" name="employedate_embauche" id="employedate_embauche" value="{{ old('employedate_embauche')}}"/>
                                @error('employeadress')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button onclick="storeEmploye()" class="btn btn-warning fw-bold text-white" id="add-btn">Ajouter</button>
                            <button onclick="updateEmploye()" class="btn btn-warning fw-bold text-white" id="update-btn">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </span>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
    
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nom</th>  
                                    <th>Code</th>  
                                    <th>CIN</th>  
                                    <th>Matricule</th>
                                    <th>Rôle</th>
                                    <th>Adresse</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Date Embauche</th>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
 

 $(document).ready(function(){
    displaydataEmploye();
  });
  
 function displaydataEmploye() {
    $.ajax({
      url: "https://iker.wiicode.tech/api/employee",
      type: "GET",
      dataType: "json",
      success: function(data) {
            var dataEmploye = data.data ;
            var tbody = $(".table tbody");
            tbody.empty(); // Clear the existing table body

            for (var i = 0; i < dataEmploye.length; i++) {
                var employe = dataEmploye[i];
                var row = $("<tr></tr>");
                row.append('<td class="text-warning fw-bold">#' + employe.id + '</td>');
                row.append('<td>' + employe.Nom + '</td>');
                row.append('<td>' + employe["Code Employee"] + '</td>');
                row.append('<td>' + employe.CIN + '</td>');
                row.append('<td>' + employe.Matricule + '</td>');
                row.append('<td>' + employe.role_name + '</td>');
                row.append('<td>' + employe.Adresse.substring(0, 20) + '</td>');
                row.append('<td>' + employe.Mail + '</td>');
                row.append('<td>' + employe.Telephone + '</td>');
                row.append('<td>' + moment(employe["Date Embauche"]).format("LL") + '</td>');
                row.append('<td class="d-flex ">' +
                '<button onclick="editEmploye(' + employe.id + ')" class="btn btn-outline-primary btn-sm mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Détails">' +
                '<i class="ri-edit-line"></i></button>' +
                '<div class="mx-1"><button onclick="deleteEmploye(' + employe.id + ')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button></div>' +
                '</td>');

                tbody.append(row);
            }   

      },
      error: function(data) {
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
            $("#add-btn").show()
            $("#update-btn").hide()
            $("#myLargeModalLabel").text('Ajouter un employé');
       }
        

  function storeEmploye() {
 console.log('9awd');
   var  nom =  $("#employenom").val() ;
   var  code =  $("#employecode").val() ;
   var  role =  $("#employerole").val() ;
   var  cin =  $("#employecin").val() ;
   var  matricule =  $("#employematricule").val() ;
   var  telephone =  $("#employetelephone").val() ;
   var  mail =  $("#employemail").val() ;
   var  adresse =  $("#employeadress").val() ;
   var embauche =  $("#employedate_embauche").val() ;
  

  $.ajax({
    url: "https://iker.wiicode.tech/api/employee",
    type: "POST",
    data: {
        nom_employee :nom ,
        code_employee : code  , 
        CIN_employee : cin ,
        matricule_employee : matricule ,
        telephone_employee:  telephone ,
        email_employee:  mail ,
        adresse_employee :  adresse ,
        date_embauche : embauche ,
        role_id : role ,
    },
    dataType: "json",
    success: function(response) {
      // Employee successfully added, handle the response if needed
      swal(response.message, "", "success");
            // Optionally, you can close the modal or perform any other actions
      $(".employeModal").modal("hide");
      // Refresh the employee data in the table
      displaydataEmploye();
    },
    error: function(response) {
      // Error occurred during the AJAX request, handle the error

      // Show an error message to the user if desired
      swal(response.responseJSON.message, "", "warning");
    },
  });
}

function editEmploye(id) {
  console.log(id);
  $(".employeModal").modal("show");
  $("#add-btn").hide();
  $("#update-btn").show();
  $("#myLargeModalLabel").text("Modifier un employé");

  $.ajax({
    url: "https://iker.wiicode.tech/api/employee/" + id,
    type: "GET",
    dataType: "json",
    success: function(data) {
        console.log(data);
      console.log(data.CIN_employee);
      $('input[name="employeid"]').val(data['employee'].id);
      $('input[name="employenom"]').val(data['employee'].nom_employee);
      $('input[name="employecode"]').val(data['employee'].code_employee);
      $('input[name="employecin"]').val(data['employee'].CIN_employee);
      $('input[name="employematricule"]').val(data['employee'].matricule_employee);
      $('input[name="employetelephone"]').val(data['employee'].telephone_employee);
      $('input[name="employemail"]').val(data['employee'].email_employee);
      $('input[name="employeadress"]').val(data['employee'].adresse_employee);
      $('select[name="employerole"]').val(data['employee'].role_id);
      $('input[name="employedate_embauche"]').val(data['employee'].date_embauche);
    },
    error: function(data) {
        swal(data.responseJSON.message, "", "warning");
    }
  });
}
function updateEmploye() {
    console.log('dfgfdfbf')
       var id = $("#employeid").val();
       var Nom = $("#employenom").val();
       var CodeEmployee = $("#employecode").val();
       var CIN = $("#employecin").val();
       var Matricule = $("#employematricule").val();
       var Telephone = $("#employetelephone").val();
       var Mail = $("#employemail").val();
       var Adresse = $("#employeadress").val();
       var DateEmbauche = $("#employedate_embauche").val();
       var RoleId = $("#employerole").val();

    $.ajax({
        url: "https://iker.wiicode.tech/api/employee/" + id,
        type: "PUT",
        dataType: "json",
        data: {
        nom_employee :Nom ,
        code_employee : CodeEmployee , 
        CIN_employee : CIN ,
        matricule_employee : Matricule ,
        telephone_employee:  Telephone ,
        email_employee:  Mail ,
        adresse_employee :  Adresse ,
        date_embauche : DateEmbauche ,
        role_id : RoleId ,
    },
        success: function(response) {
            console.log(response);
            // Hide the modal
            $(".employeModal").modal("hide");
            swal(response.message, "", "success");
            // Refresh the table or update the specific row with the updated data
            displaydataEmploye();
        },
        error: function(response) {
            swal(response.responseJSON.message, "", "warning");
        }   
    });
}





function deleteEmploye(id){
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
                url: "https://iker.wiicode.tech/api/employee/"+ id,  
                type: "delete",
                dataType: "json",
                success: function(response) {
                    swal(response.message, {
                icon: "success",
            });
            displaydataEmploye();
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