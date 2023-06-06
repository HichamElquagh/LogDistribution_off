@extends('admin.layouts.template')

@section('page-title')
    Clients | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Clients</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Clients</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-warning fw-bold text-white" data-bs-toggle="modal" data-bs-target=".clientModal">Ajouter un client</button>
        </div>
        
        <form action="" method="">
            @csrf
            <div class="modal fade clientModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Ajouter un client</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">    

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="clientnom">Nom</label>
                                <input type="text" class="form-control" name="clientnom" id="clientnom" value="{{ old('clientnom')}}"/>
                                @error('clientnom')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="clientcode">Code client</label>
                                <input type="text" class="form-control" name="clientcode" id="clientcode" value="{{ old('clientcode')}}"/>
                                @error('clientcode')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="clientcin">CIN</label>
                                <input type="text" class="form-control" name="clientcin" id="clientcin" value="{{ old('clientcin')}}"/>
                                @error('clientcin')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="clientice">ICE</label>
                                <input type="text" class="form-control" name="clientice" id="clientice" value="{{ old('clientice')}}"/>
                                @error('clientice')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="clientpatente">Patente</label>
                                <input type="text" class="form-control" name="clientpatente" id="clientpatente" value="{{ old('clientpatente')}}"/>
                                @error('clientpatente')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="clientrc">RC</label>
                                <input type="text" class="form-control" name="clientrc" id="clientrc" value="{{ old('clientrc')}}"/>
                                @error('clientrc')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="clienttelephone">Téléphone</label>
                                <input type="text" class="form-control" name="clienttelephone" id="clienttelephone" value="{{ old('clienttelephone')}}"/>
                                @error('clienttelephone')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="clientmail">Adress Mail</label>
                                <input type="text" class="form-control" name="clientmail" id="clientmail" value="{{ old('clientmail')}}"/>
                                @error('clientmail')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="clientadress">Adresse</label>
                                <input type="text" class="form-control" name="clientadress" id="clientadress" value="{{ old('clientadress')}}"/>
                                @error('clientadress')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-warning fw-bold text-white">Ajouter</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
    
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nom</th>
                                    <th>Code</th>  
                                    <th>CIN</th>  
                                    <th>ICE</th>
                                    <th>RC</th>
                                    <th>Pattente</th>
                                    <th>Adresse</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Date</th>
                                    <th>Détail</th>
                                </tr>
                            </thead>
                            
                            <tbody class="text-center">
                                @foreach($dataClient as $client)
                                        <tr>
                                            <td class="text-warning fw-bold">#{{$client['id']}}</td>
                                            <td>{{$client['nom_Client']}}</td>
                                            <td>{{$client['code_Client']}}</td>
                                            <td>{{$client['CIN_Client']}}</td>
                                            <td>{{$client['ICE_Client']}}</td>
                                            <td>{{$client['RC_Client']}}</td>
                                            <td>{{$client['Pattent_Client']}}</td>
                                            <td>{{Str::limit($client['adresse_Client'],20)}}</td>
                                            <td>{{$client['email_Client']}}</td>
                                            <td>{{$client['telephone_Client']}}</td>
                                            <td>
                                                {{\Carbon\Carbon::parse($client['created_at'])->isoFormat("LL") }}
                                            </td>
                                            <td>
                                                <a  href=""
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