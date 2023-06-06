
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
            <div class="user-profile text-center mt-3">
                <div class="">
                    <img src="{{ asset('backend/assets/images/users/profile/avatar-6.jpg') }}" alt="" class="avatar-md rounded-circle">
                </div>
                <div class="mt-3">
                    <h4 class="font-size-16 mb-1">Mehdi</h4>
                    <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> En Ligne</span>
                </div>
                <span class="badge badge-soft-warning fw-bold px-3 py-2 mt-1 mb-2">Admin</span>
            </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Général</li>

                <li>
                    <a href="{{ route('adminDashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Tableau de Bord</span>
                    </a>
                </li>
                <li class="menu-title">Système</li>
    
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-copy-2-line"></i>
                        <span>Articles</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('adminArticles') }}" class="waves-effect">
                                <i class=" ri-article-line"></i>
                                <span>Liste</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('adminCategories')}}" class="waves-effect">
                                <i class=" ri-picture-in-picture-line"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" ri-team-line "></i>
                        <span>Personnels</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('adminMagazinier') }}" class="waves-effect">
                                <i class="ri-user-2-line"></i>
                                <span>Magasiniers</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('adminEmploye') }}" class="waves-effect">
                                <i class="ri-user-settings-line"></i>
                                <span>Employés</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="  ri-store-3-line "></i>
                        <span>Achats</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('achatFournisseur') }}" class="waves-effect">
                                <i class=" ri-user-shared-2-line"></i>
                                <span>Fournisseurs</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('listeCommande') }}" class="waves-effect">
                                <i class="ri-clipboard-line"></i>
                                <span>Bons de commande</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('listeLivraison') }}" class="waves-effect">
                                <i class=" ri-survey-line "></i>
                                <span>Bons de livraison</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('achatFacture') }}" class="waves-effect">
                                <i class="ri-newspaper-line"></i>
                                <span>Facture</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('achatPaiement') }}" class="waves-effect">
                                <i class="  ri-money-euro-box-line"></i>
                                <span>Paiements</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-shopping-cart-2-line"></i>
                        <span>Ventes</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li>
                            <a href="{{ route('venteClient') }}" class="waves-effect">
                                <i class=" ri-user-received-2-line"></i>
                                <span>Clients</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('listeCommandeVente') }}" class="waves-effect">
                                <i class="ri-clipboard-line"></i>
                                <span>Bons de commande</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('listeLivraisonVente') }}" class="waves-effect">
                                <i class=" ri-survey-line "></i>
                                <span>Bons de livraison</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('venteFacture') }}" class="waves-effect">
                                <i class="ri-newspaper-line"></i>
                                <span>Facture</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('ventePaiement') }}" class="waves-effect">
                                <i class="  ri-money-euro-box-line"></i>
                                <span>Paiements</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" ri-stack-line"></i>
                        <span>Secteur</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li>
                            <a href="{{ route('secteurVendeur') }}" class="waves-effect">
                                <i class="ri-user-location-line"></i>
                                <span>Vendeur</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('listeSortieSecteur') }}" class="waves-effect">
                                <i class="ri-clipboard-line"></i>
                                <span>Bons de sortie</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('listeBonSecteur') }}" class="waves-effect">
                                <i class=" ri-survey-line "></i>
                                <span>Bons de secteur</span>
                            </a>
                        </li>

                        {{-- <li>
                            <a href="{{ route('venteFacture') }}" class="waves-effect">
                                <i class="ri-newspaper-line"></i>
                                <span>Facture</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('ventePaiement') }}" class="waves-effect">
                                <i class="  ri-money-euro-box-line"></i>
                                <span>Paiements</span>
                            </a>
                        </li> --}}

                    </ul>
                </li>

                <li>
                    <a href="{{ route('admindepense') }}" class="waves-effect">
                        <i class="  ri-airplay-line  "></i>
                        <span>Dépenses</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('adminStock') }}" class="waves-effect">
                        <i class="  ri-menu-add-line"></i>
                        <span>Stock</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adminbanque') }}" class="waves-effect">
                        <i class=" ri-bank-line"></i>
                        <span>Banques</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adminCaisse') }}" class="waves-effect">
                        <i class="fas fa-cash-register"></i>
                        <span>Caisse</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adminwarehouse') }}" class="waves-effect">
                        <i class="ri-building-line"></i>
                        <span>Entrepôt</span>
                    </a>
                </li>
            
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>