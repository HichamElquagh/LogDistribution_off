@extends('admin.layouts.template')

@section('page-title')
    Tableau de bord | Log Dist Du Nord
@endsection

@section('admin')
    
<div class="page-content">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Tableau de Board</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Log Dist Du Nord</a></li>
                            <li class="breadcrumb-item active">Tableau de bord</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Commandes</p>
                                <h4 class="mb-2">8246</h4>
                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>de la période précédente</p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-warning rounded-3">
                                    <i class="ri-user-heart-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                              
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Fournisseurs</p>
                                <h4 class="mb-2">93</h4>
                                <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>de la période précédente</p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-community-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                              
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Achats à payer</p>
                                <h4 class="mb-2">142</h4>
                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>de la période précédente</p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="ri-home-3-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                            
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Ventes</p>
                                <h4 class="mb-2">29670</h4>
                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>11.7%</span>de la période précédente</p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-money-dollar-circle-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                              
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Clients</p>
                                <h4 class="mb-2">1452</h4>
                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>de la période précédente</p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="ri-store-2-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                              
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Chéques en retard</p>
                                <h4 class="mb-2">38</h4>
                                <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>de la période précédente</p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class=" ri-money-dollar-circle-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                              
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">

                <div class="card">
                    <div class="card-body pb-0">
                        <div class="float-end d-none d-md-inline-block">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted">Rapport<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Exporter</a>
                                    <a class="dropdown-item" href="#">Importer</a>
                                    <a class="dropdown-item" href="#">Télécharger le Rapport</a>
                                </div>
                            </div>
                        </div>
                        <h4 class="card-title mb-4">Nombre de Commandes</h4>

                        <div class="text-center pt-3">
                            <div class="row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div class="d-inline-flex">
                                        <h5 class="me-2">25,117</h5>
                                        <div class="text-success font-size-12">
                                            <i class="mdi mdi-menu-up font-size-14"> </i>2.2 %
                                        </div>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Marketplace</p>
                                </div><!-- end col -->
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div class="d-inline-flex">
                                        <h5 class="me-2">€34,856</h5>
                                        <div class="text-success font-size-12">
                                            <i class="mdi mdi-menu-up font-size-14"> </i>1.2 %
                                        </div>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Semaine Précédente</p>
                                </div><!-- end col -->
                                <div class="col-sm-4">
                                    <div class="d-inline-flex">
                                        <h5 class="me-2">€18,225</h5>
                                        <div class="text-success font-size-12">
                                            <i class="mdi mdi-menu-up font-size-14"> </i>1.7 %
                                        </div>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Mois Précédent</p>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div>
                    </div>
                    <div class="card-body py-0 px-2">
                        <div id="area_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="float-end d-none d-md-inline-block">
                            <div class="dropdown">
                                <a class="text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted">Cette Année<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Aujourd'hui</a>
                                    <a class="dropdown-item" href="#">Semaine Précédente</a>
                                    <a class="dropdown-item" href="#">Mois Précédent</a>
                                    <a class="dropdown-item" href="#">Cette Année</a>
                                </div>
                            </div>
                        </div>
                        <h4 class="card-title mb-4">Revenue</h4>

                        <div class="text-center pt-3">
                            <div class="row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div>
                                        <h5>17,493</h5>
                                        <p class="text-muted text-truncate mb-0">Marketplace</p>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div>
                                        <h5>€44,960</h5>
                                        <p class="text-muted text-truncate mb-0">Semaine Précédente</p>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-sm-4">
                                    <div>
                                        <h5>€29,142</h5>
                                        <p class="text-muted text-truncate mb-0">Mois Précédent</p>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div>
                    </div>
                    <div class="card-body py-0 px-2">
                        <div id="column_line_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Derniere Commande</h4>

                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>N° de commande</th>
                                        <th>Exercice</th>
                                        <th>Mois</th>
                                        <th>Etat</th>
                                        <th>Commentaire</th>
                                        <th>Date de commande</th>
                                        <th>Total HT</th>
                                        <th>Total TVA</th>
                                        <th>Total TTC</th>
                                        <th>Fournisseur</th>
                                    </tr>
                                </thead>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection