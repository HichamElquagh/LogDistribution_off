@extends('admin.layouts.template')

@section('page-title')
    Facture Achat | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Facture Achat</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Facture Achat</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <a href="{{ route('createFacture')}}" class="btn btn-warning fw-bold text-white">Saisir une facture</a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
    
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>N° Facture</th> 
                                    <th>Fournisseur</th>   
                                    <th>Etat</th>  
                                    <th>Total HT</th>
                                    <th>Total TVA</th>
                                    <th>Total TTC</th>
                                    <th>Total Régler</th>
                                    <th>Total Réster</th>
                                    <th>Confirmé</th> 
                                    <th>Détail</th>                                  
                                    <th>Remise</th>
                                    <th>N° Bon de Livraison</th> 
                                    <th>Date</th>
                                </tr>
                            </thead>
                            
                            <tbody class="text-center">
                                @foreach($dataFacture as $facture)
                                        <tr>
                                            <td class="text-warning fw-bold">#{{$facture['id']}}</td>
                                            <td>{{$facture['numero_Facture']}}</td>
                                            <td>{{$facture['fournisseur']}}</td>
                                            <td>
                                                <span class="statut-dispo badge bg-{{ $facture['EtatPaiement'] === 'impaye' ? 'danger' : ($facture['EtatPaiement'] === 'Paye' ? 'success' : 'info')}} text-white">
                                                    <i class="{{ $facture['EtatPaiement'] === 'impaye' ? 'ri-close-circle-line' : ($facture['EtatPaiement'] === 'Paye' ? 'ri-checkbox-circle-line' : 'ri-radio-button-line')}} align-middle font-size-14 text-white"></i> 
                                                    {{$facture['EtatPaiement'] === 'impaye' ? 'Impayé' : ($facture['EtatPaiement'] === 'Paye' ? 'Payé' : 'EnCours')}}
                                                </span>                                               
                                            </td>
                                            <td>{{$facture['Total_HT']}}</td>
                                            <td>{{$facture['Total_TVA']}}</td>
                                            <td>{{$facture['Total_TTC']}}</td>
                                            <td>{{$facture['Total_Regler']}}</td>
                                            <td>{{$facture['Total_Rester']}}</td> 
                                            <td>
                                                <span class="statut-dispo badge bg-{{ $facture['Confirme'] == 1 ? 'success' : 'danger' }} text-white">
                                                    <i class="{{ $facture['Confirme'] == 1 ? 'ri-checkbox-circle-line' : 'ri-close-circle-line' }} align-middle font-size-14 text-white"></i> 
                                                    {{ $facture['Confirme'] == 1 ? 'Confirmé' : 'Non Confirmé' }}
                                                </span>
                                            </td> 
                                            <td>
                                                <a  href="{{route("showFacture",$facture['id'])}}"
                                                    class="btn btn-outline-primary btn-sm mb-2"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-bs-title="Détails">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </td>                                     
                                            <td>{{$facture['remise']}}</td>
                                            <td>{{$facture['Numero_bonLivraison']}}</td>
                                            <td>
                                                {{\Carbon\Carbon::parse($facture['date_Facture'])->isoFormat("LL") }}
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
