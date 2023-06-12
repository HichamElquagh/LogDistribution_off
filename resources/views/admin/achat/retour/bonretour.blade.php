@extends('admin.layouts.template')

@section('page-title')
    Bon de Retour | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bon de Retour</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Bon de Retour</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <a href="{{route('createRetour')}}" class="btn btn-warning fw-bold text-white" id="createBtn">Créer un bon de retour</a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
    
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>N° Bon Retour</th> 
                                    <th>Bon Livraison</th>  
                                    <th>Fournisseur</th>  
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
                                @foreach($dataBr as $bonretour)
                                    <tr>
                                        <td class="text-warning fw-bold">#{{$bonretour['id']}}</td>
                                        <td>{{$bonretour['Numero_bonRetour']}}</td>
                                        <td>{{$bonretour['Numero_bonLivraison']}}</td>
                                        <td>{{$bonretour['fournisseur']}}</td>
                                        <td>{{$bonretour['Etat']}}</td>
                                        <td>{{$bonretour['Total_HT']}}</td>
                                        <td>{{$bonretour['Total_TVA']}}</td>
                                        <td>{{$bonretour['Total_TTC']}}</td>
                                        <td>
                                            <span class="statut-dispo badge bg-{{ $bonretour['Confirme'] == 1 ? 'success' : 'danger' }} text-white">
                                                <i class="{{ $bonretour['Confirme'] == 1 ? 'ri-checkbox-circle-line' : 'ri-close-circle-line' }} align-middle font-size-14 text-white"></i> 
                                                {{ $bonretour['Confirme'] == 1 ? 'Confirmé' : 'Non Confirmé' }}
                                            </span>
                                        </td>
                                        <td>
                                            {{\Carbon\Carbon::parse($bonretour['date_BRetour'])->isoFormat("LL") }}
                                        </td>
                                        <td>
                                            <a  href="{{route('showRetour', $bonretour['id'])}}"
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