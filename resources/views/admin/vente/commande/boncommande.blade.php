@extends('admin.layouts.template')

@section('page-title')
    Bon de Commande | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bon de Commande</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Bon de Commande</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <a href="{{route('createCommandeVente')}}" class="btn btn-warning fw-bold text-white" id="createBtn">Créer un bon de commande</a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
    
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>N° Bon Commande</th> 
                                    <th>Client</th>  
                                    <th>Etat</th>
                                    <th>Total HT</th>
                                    <th>Total TVA</th>
                                    <th>Total TTC</th>
                                    <th>Confirmé</th>
                                    <th>Date</th>
                                    <th>Détail</th>
                                </tr>
                            </thead>
                            
                            <tbody class="text-center">
                                @foreach($dataBc as $boncommande)
                                        <tr>
                                            <td class="text-warning fw-bold">#{{$boncommande['id']}}</td>
                                            <td>{{$boncommande['Numero_bonCommandeVente']}}</td>
                                            <td>{{$boncommande['client']}}</td>
                                            <td>{{$boncommande['Etat']}}</td>
                                            <td>{{$boncommande['Total_HT']}}</td>
                                            <td>{{$boncommande['Total_TVA']}}</td>
                                            <td>{{$boncommande['Total_TTC']}}</td>
                                            <td>
                                                <span class="statut-dispo badge bg-{{ $boncommande['Confirme'] == 1 ? 'success' : 'danger' }} text-white">
                                                    <i class="{{ $boncommande['Confirme'] == 1 ? 'ri-checkbox-circle-line' : 'ri-close-circle-line' }} align-middle font-size-14 text-white"></i> 
                                                    {{ $boncommande['Confirme'] == 1 ? 'Confirmé' : 'Non Confirmé' }}
                                                </span>
                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::parse($boncommande['date_BCommandeVente'])->isoFormat("LL") }}
                                            </td>
                                            <td>
                                                <a  href="{{route("showCommandeVente",$boncommande['id'])}}"
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