@extends('admin.layouts.template')

@section('page-title')
    Transfert
     | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Transfert 
            

                    </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Transfert </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <a href="{{route('createTransfert')}}" class="btn btn-warning fw-bold text-white" id="createBtn">Créer un Transfert 

            </a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
    
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>N° reference</th> 
                                    <th>De L'entrepôt </th>  
                                    <th>À L'entrepôt</th>
                                    <th>Nom Employee </th>
                                    <th>Camion </th>
                                    <th>Matricule</th>
                                    <th>Confirmation</th>
                                    <th>Date Transfert</th>
                                    <th>Détail</th>
                                </tr>
                            </thead>
                            
                            <tbody class="text-center">
                                @foreach($allTransfert as $transfert)
                                        <tr>
                                            <td class="text-warning fw-bold">#{{$transfert['id']}}</td>
                                            <td>{{$transfert['reference']}}</td>
                                            <td>{{$transfert['warehousesFrom']}}</td>
                                            <td>{{$transfert['warehouseTo']}}</td>
                                            <td>{{$transfert['nom_employee']}}</td>
                                            <td>{{$transfert['marque']}}</td>
                                            <td>{{$transfert['matricule']}}</td>
                                            <td>
                                                <span class="statut-dispo badge bg-{{ $transfert['Confirme'] == 1 ? 'success' : 'danger' }} text-white">
                                                    <i class="{{ $transfert['Confirme'] == 1 ? 'ri-checkbox-circle-line' : 'ri-close-circle-line' }} align-middle font-size-14 text-white"></i> 
                                                    {{ $transfert['Confirme'] == 1 ? 'Confirmé' : 'Non Confirmé' }}
                                                </span>
                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::parse($transfert['dateTransfert'])->isoFormat("LL") }}
                                            </td>
                                            <td>
                                                <a  href="{{route("showTransfert", $transfert['id'])}}"
                                                    class="btn btn-outline-primary btn-sm mb-2"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-bs-title="Détails">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    
</div>

@endsection