@extends('admin.layouts.template')

@section('page-title')
    Articles | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Articles</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Articles</li>
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
                        Modifier l'article
                        <div class="d-flex">
                            <form method="POST" action="{{ route('deleteArticle',$dataArticle['id']) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm me-2">
                                    <i class=" fas fa-trash-alt me-2"></i>
                                    Supprimer
                                </button>
                            </form>
                            <a href="{{ route('adminArticles') }}" class="btn btn-warning text-white btn-sm" type="submit">
                                <i class="ri-arrow-go-back-line"></i>
                            </a>
                        </div>
                        
                    </div>
                    <form action="{{route('updateArticle',$dataArticle['id'])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="articlelibelle">Article libellé</label>
                                    <input type="text" class="form-control" name="articlelibelle" id="articlelibelle" value="{{$dataArticle['article_libelle']}}"/>
                                    @error('articlelibelle')
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="articlereference">Référence</label>
                                    <input type="number" class="form-control" name="articleReference" id="articleReference" value="{{$dataArticle['reference']}}"/>
                                    @error('articleReference')
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="articlecategory">Catégorie</label>
                                    <select class="form-select" name="articlecategory" id="articlecategory">
                                        @foreach($dataCategory as $category)
                                        <option value="{{$category['id']}}" {{$category['id'] == $dataArticle['category_id'] ? 'selected' : ''}}>{{$category['category']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="articlepu">Prix Unitaire</label>
                                    <input type="number" class="form-control" name="articlepu" id="articlepu" value="{{$dataArticle['prix_unitaire']}}"/>
                                    @error('articlepu')
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="articlepp">Prix Public</label>
                                    <input type="number" class="form-control" name="articlepp" id="articlepp" value="{{$dataArticle['prix_public']}}"/>
                                    @error('articlepp')
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="articlesg">Semi-Grossiste</label>
                                    <input type="number" class="form-control" name="articlesg" id="articlesg" value="{{$dataArticle['demi_grossiste']}}"/>
                                    @error('articlesg')
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="articlecf">Client Fidéle</label>
                                    <input type="number" class="form-control" name="articlecf" id="articlecf" value="{{$dataArticle['client_Fedele']}}"/>
                                    @error('articlecf')
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="articleunite">Unité</label>
                                    <input type="text" class="form-control" name="articleunite" id="articleunite" value="{{$dataArticle['unite']}}"/>
                                    @error('articleunite')
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="articlealert">Alerte Stock</label>
                                    <input type="number" class="form-control" name="articlealert" id="articlealert" value="{{$dataArticle['alert_stock']}}"/>
                                    @error('articlealert')
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-warning fw-bold text-white">Modifier l'article</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>

@endsection