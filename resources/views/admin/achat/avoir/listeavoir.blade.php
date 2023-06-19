@extends('admin.layouts.template')

@section('page-title')
    Facture Avoir | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Facture Avoir</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Facture Avoir</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <a href="{{ route('createFactureAvoir')}}" class="btn btn-warning fw-bold text-white">Saisir une avoir</a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
    
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>N° Avoir</th> 
                                    <th>N° Bon de retour</th> 
                                    <th>Fournisseur</th>   
                                    <th>Etat</th>  
                                    <th>Total TTC</th>
                                    <th>Confirmé</th> 
                                    <th>Date</th>
                                    <th>Détail</th> 
                                </tr>
                            </thead>
                            
                            <tbody class="text-center">
                                @foreach($dataAvoir as $avoir)
                                    <tr>
                                        <td class="text-warning fw-bold">#{{$avoir['id']}}</td>
                                        <td>{{$avoir['numero_avoirsAchat']}}</td>                                            
                                        <td>{{$avoir['Numero_bonRetour']}}</td>
                                        <td>{{$avoir['fournisseur']}}</td>
                                        <td>
                                            <span class="statut-dispo badge bg-{{ $avoir['isLinked'] == 0 ? 'danger' : 'success'}} text-white">
                                                <i class="{{ $avoir['isLinked'] == 0 ? 'ri-close-circle-line' :'ri-checkbox-circle-line'}} align-middle font-size-14 text-white"></i> 
                                                {{$avoir['isLinked'] == 0 ? 'En Attente' : 'Réglé'}}
                                            </span>                                               
                                        </td>
                                        <td>{{$avoir['Total_TTC']}}</td>
                                        <td>
                                            <span class="statut-dispo badge bg-{{ $avoir['Confirme'] == 1 ? 'success' : 'danger' }} text-white">
                                                <i class="{{ $avoir['Confirme'] == 1 ? 'ri-checkbox-circle-line' : 'ri-close-circle-line' }} align-middle font-size-14 text-white"></i> 
                                                {{ $avoir['Confirme'] == 1 ? 'Confirmé' : 'Non Confirmé' }}
                                            </span>
                                        </td>
                                        <td>
                                            {{\Carbon\Carbon::parse($avoir['date_avoirs'])->isoFormat("LL") }}
                                        </td>
                                        <td>
                                            <a  href="{{route("showFactureAvoir",$avoir['id'])}}"
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
