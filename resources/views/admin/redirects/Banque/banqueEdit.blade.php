@extends('admin.layouts.template')

@section('page-title')
Banques | Log Dist Du Nord
@endsection

@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Banques</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Banque</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                <i class="mdi mdi-check-all me-2"></i>
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                <i class="mdi mdi-block-helper me-2"></i>
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Modifier Banque
                        <div class="d-flex">
                            <form method="POST" action="{{ route('deleteBanque',$data['id']) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet Banque ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm me-2">
                                    <i class=" fas fa-trash-alt me-2"></i>
                                    Supprimer
                                </button>
                            </form>
                            <a href="{{ route('adminbanque') }}" class="btn btn-warning text-white btn-sm" type="submit">
                                <i class="ri-arrow-go-back-line"></i>
                            </a>
                        </div>

                    </div>
                    <form action="{{route('updateBanque',$data['id'])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class=" row">

                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="nomBank">Nom de Banque</label>
                                    <input type="text" class="form-control" value="{{$data['nomBank']}}" name="nomBank" id="nomBank" value="{{ old('nomBank')}}"/>
                                    @error('nomBank')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="telephone">Téléphone</label>
                                    <input type="text" class="form-control" name="telephone" value="{{$data['telephone']}}" id="telephone" value="{{ old('telephone')}}"/>
                                    @error('telephone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="adresse">Address</label>
                                    <input type="text" class="form-control" name="adresse" value="{{$data['adresse']}}" id="adresse" value="{{ old('adresse')}}"/>
                                    @error('adresse')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label class="form-label" for="numero_compt">Numero de Compte</label>
                                    <input type="text" class="form-control" name="numero_compt" value="{{$data['numero_compt']}}"  id="numero_compt" value="{{ old('numero_compt')}}"/>
                                    @error('numero_compt')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label class="form-label" for="rib_compt">RIB de Compte</label>
                                    <input type="text" class="form-control" name="rib_compt" value="{{$data['rib_compt']}}" id="rib_compt" value="{{ old('rib_compt')}}"/>
                                    @error('rib_compt')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="mb-3 col-lg-6">
                                    <label class="form-label" for="Solde">Solde</label>
                                    <input type="number" class="form-control" name="Solde" value="{{$data['Solde']}}" id="Solde" value="{{ old('Solde')}}"/>
                                    @error('Solde')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label class="form-label" for="Commentaire">Commentaire</label>
                                    <input type="text" class="form-control" name="Commentaire" value="{{$data['Commentaire']}}" id="Commentaire" value="{{ old('Commentaire')}}"/>
                                    @error('Commentaire')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-warning fw-bold text-white">Modifier Banque</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
