@extends('admin.layouts.template')

@section('page-title')
    Vente Secteur | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Vente Secteur</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Vente Secteur</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <a href="{{route('createBonSecteur')}}" class="btn btn-warning fw-bold text-white" id="createBtn">Créer une vente secteur</a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
    
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>N° Bon Secteur</th> 
                                    <th>Secteur</th>  
                                    <th>Etat</th>  
                                    <th>Vendeur</th>  
                                    <th>Camion</th>
                                    <th>Total TTC</th>
                                    <th>Total Régler</th>
                                    <th>Total Réster</th>
                                    <th>Confirmé</th>
                                    <th>Détail</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            
                            <tbody class="text-center">
                                @foreach($dataBonSecteur as $bonsecteur)
                                    <tr>
                                        <td class="text-warning fw-bold">#{{$bonsecteur['id']}}</td>
                                        <td>{{$bonsecteur['reference']}}</td>
                                        <td>{{$bonsecteur['secteur']}}</td>
                                        <td>
                                            <span class="statut-dispo badge bg-{{ $bonsecteur['EtatPaiement'] === 'impaye' ? 'danger' : ($bonsecteur['EtatPaiement'] === 'Paye' ? 'success' : 'info')}} text-white">
                                                <i class="{{ $bonsecteur['EtatPaiement'] === 'impaye' ? 'ri-close-circle-line' : ($bonsecteur['EtatPaiement'] === 'Paye' ? 'ri-checkbox-circle-line' : 'ri-radio-button-line')}} align-middle font-size-14 text-white"></i> 
                                                {{$bonsecteur['EtatPaiement'] === 'impaye' ? 'Impayé' : ($bonsecteur['EtatPaiement'] === 'Paye' ? 'Payé' : 'EnCours')}}
                                            </span>                                               
                                        </td>
                                        <td>{{$bonsecteur['nomComplet1']}}</td>
                                        <td>{{$bonsecteur['marque']}} - {{$bonsecteur['matricule']}}</td>
                                        <td>{{$bonsecteur['Total_TTC']}}</td>
                                        <td>{{$bonsecteur['Total_Regler']}}</td>
                                        <td>{{$bonsecteur['Total_Rester']}}</td>
                                        <td>
                                            <span class="statut-dispo badge bg-{{ $bonsecteur['Confirme'] == 1 ? 'success' : 'danger' }} text-white">
                                                <i class="{{ $bonsecteur['Confirme'] == 1 ? 'ri-checkbox-circle-line' : 'ri-close-circle-line' }} align-middle font-size-14 text-white"></i> 
                                                {{ $bonsecteur['Confirme'] == 1 ? 'Confirmé' : 'Non Confirmé' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a  href="{{route("showLivraison",$bonsecteur['id'])}}"
                                                class="btn btn-outline-primary btn-sm mb-2"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="Détails">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </td>
                                        <td>
                                            {{\Carbon\Carbon::parse($bonsecteur['dateEntree'])->isoFormat("LL") }}
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