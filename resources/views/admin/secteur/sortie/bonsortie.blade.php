@extends('admin.layouts.template')

@section('page-title')
    Bon de Sortie | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bon de Sortie</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Bon de Sortie</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <a href="{{route('createBonSortie')}}" class="btn btn-warning fw-bold text-white" id="createBtn">Créer un bon de sortie</a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
    
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>N° Bon Sortie</th> 
                                    <th>Vendeur</th>  
                                    <th>Aide Vendeur 1</th>   
                                    <th>Aide Vendeur 2</th>   
                                    <th>Camion</th>
                                    <th>Secteur</th>
                                    <th>Confirmé</th>
                                    <th>Date</th>
                                    <th>Détail</th>
                                </tr>
                            </thead>
                            
                            <tbody class="text-center">
                                @foreach($dataBs as $bonsortie)
                                    <tr>
                                        <td class="text-warning fw-bold">#{{$bonsortie['id']}}</td>
                                        <td>{{$bonsortie['reference']}}</td>
                                        <td>{{$bonsortie['nomComplet1']}}</td>
                                        @if($bonsortie['nomComplet2'])
                                            <td>{{$bonsortie['nomComplet2']}}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if($bonsortie['nomComplet3'])
                                            <td>{{$bonsortie['nomComplet3']}}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>{{$bonsortie['matricule']}}</td>
                                        <td>{{$bonsortie['secteur']}}</td>
                                        <td>
                                            <span class="statut-dispo badge bg-{{ $bonsortie['Confirme'] == 1 ? 'success' : 'danger' }} text-white">
                                                <i class="{{ $bonsortie['Confirme'] == 1 ? 'ri-checkbox-circle-line' : 'ri-close-circle-line' }} align-middle font-size-14 text-white"></i> 
                                                {{ $bonsortie['Confirme'] == 1 ? 'Confirmé' : 'Non Confirmé' }}
                                            </span>
                                        </td>
                                        <td>
                                            {{\Carbon\Carbon::parse($bonsortie['dateSortie'])->isoFormat("LL") }}
                                        </td>
                                        <td>
                                            <a  href="{{ route('showBonSortie',$bonsortie['id'])}}"
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