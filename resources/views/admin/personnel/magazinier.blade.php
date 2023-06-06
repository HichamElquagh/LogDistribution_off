@extends('admin.layouts.template')

@section('page-title')
    Magasiniers | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Magasiniers</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Magasiniers</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        {{-- <div class="d-flex mb-3 justify-content-end">
            <button type="button" class="btn btn-warning fw-bold text-white" data-bs-toggle="modal" data-bs-target=".magazinierModal">Ajouter un magasinier</button>
        </div> --}}
        
        <form action="" method="">
            @csrf
            <div class="modal fade magazinierModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Ajouter un magasinier</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">    

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="magaziniernom">Nom</label>
                                <input type="text" class="form-control" name="magaziniernom" id="magaziniernom" value="{{ old('magaziniernom')}}"/>
                                @error('magaziniernom')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="magaziniercode">Code Magasinier</label>
                                <input type="text" class="form-control" name="magaziniercode" id="magaziniercode" value="{{ old('magaziniercode')}}"/>
                                @error('magaziniercode')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="magaziniercin">CIN</label>
                                <input type="text" class="form-control" name="magaziniercin" id="magaziniercin" value="{{ old('magaziniercin')}}"/>
                                @error('magaziniercin')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="magaziniermatricule">Matricule</label>
                                <input type="text" class="form-control" name="magaziniermatricule" id="magaziniermatricule" value="{{ old('magaziniermatricule')}}"/>
                                @error('magaziniermatricule')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="magaziniertelephone">Téléphone</label>
                                <input type="text" class="form-control" name="magaziniertelephone" id="magaziniertelephone" value="{{ old('magaziniertelephone')}}"/>
                                @error('magaziniertelephone')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label class="form-label" for="magaziniermail">Adress Mail</label>
                                <input type="text" class="form-control" name="magaziniermail" id="magaziniermail" value="{{ old('magaziniermail')}}"/>
                                @error('magaziniermail')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="magazinieradress">Adresse</label>
                                <input type="text" class="form-control" name="magazinieradress" id="magazinieradress" value="{{ old('magazinieradress')}}"/>
                                @error('magazinieradress')
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
                                    <th>Matricule</th>
                                    <th>Adresse</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Date Embauche</th>
                                    <th>Détail</th>
                                </tr>
                            </thead>
                            
                            <tbody class="text-center">
                                @foreach($SoloMagaziniers as $magazinier)
                                    <tr>
                                        <td class="text-warning fw-bold">#{{$magazinier['id']}}</td>
                                        <td>{{$magazinier['Nom']}}</td>
                                        <td>{{$magazinier['Code Employee']}}</td>
                                        <td>{{$magazinier['CIN']}}</td>
                                        <td>{{$magazinier['Matricule']}}</td>
                                        <td>{{Str::limit($magazinier['Adresse'],20)}}</td>
                                        <td>{{$magazinier['Mail']}}</td>
                                        <td>{{$magazinier['Telephone']}}</td>
                                        <td>
                                            {{\Carbon\Carbon::parse($magazinier['Date Embauche'])->isoFormat("LL") }}
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