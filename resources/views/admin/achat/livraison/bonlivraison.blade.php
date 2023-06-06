@extends('admin.layouts.template')

@section('page-title')
    Bon de Livraison | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bon de Livraison</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Bon de Livraison</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <a href="{{route('createLivraison')}}" class="btn btn-warning fw-bold text-white" id="createBtn">Créer un bon de livraison</a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
    
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>N° Bon Livraison</th> 
                                    <th>Bon Commande</th>  
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
                                @foreach($dataBl as $bonlivraison)
                                    <tr>
                                        <td class="text-warning fw-bold">#{{$bonlivraison['id']}}</td>
                                        <td>{{$bonlivraison['Numero_bonLivraison']}}</td>
                                        <td>{{$bonlivraison['Numero_bonCommande']}}</td>
                                        <td>{{$bonlivraison['fournisseur']}}</td>
                                        <td>{{$bonlivraison['Etat']}}</td>
                                        <td>{{$bonlivraison['Total_HT']}}</td>
                                        <td>{{$bonlivraison['Total_TVA']}}</td>
                                        <td>{{$bonlivraison['Total_TTC']}}</td>
                                        <td>
                                            <span class="statut-dispo badge bg-{{ $bonlivraison['Confirme'] == 1 ? 'success' : 'danger' }} text-white">
                                                <i class="{{ $bonlivraison['Confirme'] == 1 ? 'ri-checkbox-circle-line' : 'ri-close-circle-line' }} align-middle font-size-14 text-white"></i> 
                                                {{ $bonlivraison['Confirme'] == 1 ? 'Confirmé' : 'Non Confirmé' }}
                                            </span>
                                        </td>
                                        <td>
                                            {{\Carbon\Carbon::parse($bonlivraison['date_Blivraison'])->isoFormat("LL") }}
                                        </td>
                                        <td>
                                            <a  href="{{route("showLivraison",$bonlivraison['id'])}}"
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