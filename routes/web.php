<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\admin\StockController;
use App\Http\Controllers\admin\BanqueController;
use App\Http\Controllers\admin\DepenseController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\WareHouseController;
use App\Http\Controllers\admin\Vente\ClientController;
use App\Http\Controllers\admin\Secteur\VendeurController;
use App\Http\Controllers\admin\Article\ArticlesController;
use App\Http\Controllers\admin\Secteur\BonSortieController;
use App\Http\Controllers\admin\Achat\BonReceptionController;
use App\Http\Controllers\admin\Achat\FactureAchatController;
use App\Http\Controllers\admin\Achat\FournisseursController;
use App\Http\Controllers\admin\Article\CategoriesController;
use App\Http\Controllers\admin\Personnel\EmployesController;
use App\Http\Controllers\admin\Secteur\BonSecteurController;
use App\Http\Controllers\admin\Vente\FactureVenteController;
use App\Http\Controllers\admin\Personnel\MagaziniersController;
use App\Http\Controllers\admin\Personnel\RoleController;
use App\Http\Controllers\admin\Secteur\CamionController;
use App\Http\Controllers\admin\Secteur\SecteurController;
use App\Http\Controllers\admin\TransfertController;
use App\Http\Controllers\EntrepriseController;

Route::controller(DashboardController::class)->group(function() {
    Route::get('/', 'Index')->name('adminDashboard');
});

Route::controller(ArticlesController::class)->group(function() {
    Route::get('/articles', 'ListeArticle')->name('adminArticles');
});

Route::controller(CategoriesController::class)->group(function() {
    Route::get('/categories', 'ListeCategorie')->name('adminCategories');
    Route::post('/categories', 'StoreCategorie')->name('storeCategories');
    Route::put('/categories/{id?}', 'UpdateCategorie')->name('updateCategorie');
    Route::delete('/categories/{id}', 'DeleteCategorie')->name('deleteCategorie');
});

Route::controller(MagaziniersController::class)->group(function() {
    Route::get('/magaziniers', 'ListeMagazinier')->name('adminMagazinier');
});

Route::controller(EmployesController::class)->group(function() {
    Route::get('/employes', 'ListeEmploye')->name('adminEmploye');
});

// ----------------------------------------------------------------------- //
// ----------------------------     Achat     ---------------------------- //

Route::controller(FournisseursController::class)->group(function() {
    Route::get('/fournisseurs', 'ListeFournisseur')->name('achatFournisseur');
});

Route::controller(App\Http\Controllers\admin\Achat\BonCommandeController::class)->group(function() {
    Route::prefix('/bon-commande-achat')->group(function() {
        Route::get('/', 'ListeBonCommande')->name('listeCommande');
        Route::get('/nouveau', 'CreateBonCommande')->name('createCommande');
        Route::get('/detail/{id}', 'ShowBonCommande')->name('showCommande');
    });
});

Route::controller(App\Http\Controllers\admin\Achat\BonLivraisonController::class)->group(function() {
    Route::prefix('/bon-livraison-achat')->group(function() {
        Route::get('/', 'ListeBonLivraison')->name('listeLivraison');
        Route::get('/nouveau', 'CreateBonLivraison')->name('createLivraison');
        Route::get('/detail/{id}', 'ShowBonLivraison')->name('showLivraison');
    });
});

Route::controller(App\Http\Controllers\admin\Achat\BonRetourController::class)->group(function() {
    Route::prefix('/bon-retour-achat')->group(function() {
        Route::get('/', 'ListeBonRetour')->name('listeRetour');
        Route::get('/nouveau', 'CreateBonRetour')->name('createRetour');
        Route::get('/detail/{id}', 'ShowBonRetour')->name('showRetour');
    });
});

Route::controller(FactureAchatController::class)->group(function() {
    Route::prefix('/facture-achat')->group(function() {
        Route::get('/', 'ListeFactureAchat')->name('achatFacture');
        Route::get('/nouveau', 'CreateFactureAchat')->name('createFacture');
        Route::get('/detail/{id}', 'ShowFacture')->name('showFacture');
    });
});

Route::fallback(function () {
    return view('errors.404');
});

Route::controller(App\Http\Controllers\admin\Achat\PaiementController::class)->group(function() {
    Route::get('/paiement-achat', 'Index')->name('achatPaiement');
});

// ----------------------------     Fin Achat     ---------------------------- //
// --------------------------------------------------------------------------- //



// ----------------------------------------------------------------------- //
// ----------------------------     Vente     ---------------------------- //

Route::controller(ClientController::class)->group(function() {
    Route::get('/clients', 'ListeClient')->name('venteClient');
});

Route::controller(App\Http\Controllers\admin\Vente\BonCommandeController::class)->group(function() {
    Route::prefix('/bon-commande-vente')->group(function() {
        Route::get('/', 'ListeBonCommande')->name('listeCommandeVente');
        Route::get('/nouveau', 'CreateBonCommande')->name('createCommandeVente');
        Route::get('/detail/{id}', 'ShowBonCommande')->name('showCommandeVente');
    });
});

Route::controller(App\Http\Controllers\admin\Vente\BonLivraisonController::class)->group(function() {
    Route::prefix('/bon-livraison-vente')->group(function() {
        Route::get('/', 'ListeBonLivraison')->name('listeLivraisonVente');
        Route::get('/nouveau', 'CreateBonLivraison')->name('createLivraisonVente');
        Route::get('/detail/{id}', 'ShowBonLivraison')->name('showLivraisonVente');
    });
});

Route::controller(App\Http\Controllers\admin\Vente\BonRetourController::class)->group(function() {
    Route::prefix('/bon-retour-vente')->group(function() {
        Route::get('/', 'ListeBonRetour')->name('listeRetourVente');
        Route::get('/nouveau', 'CreateBonRetour')->name('createRetourVente');
        Route::get('/detail/{id}', 'ShowBonRetour')->name('showRetourVente');
    });
});

Route::controller(FactureVenteController::class)->group(function() {
    Route::prefix('/facture-vente')->group(function() {
        Route::get('/', 'ListeFactureVente')->name('venteFacture');
        Route::get('/nouveau', 'CreateFactureVente')->name('createFactureVente');
        Route::get('/detail/{id}', 'ShowFacture')->name('showFactureVente');
    });
});

Route::controller(App\Http\Controllers\admin\Vente\PaiementController::class)->group(function() {
    Route::get('/paiement-vente', 'Index')->name('ventePaiement');
});

// ----------------------------     Fin Vente     ---------------------------- //
// --------------------------------------------------------------------------- //


// ------------------------------------------------------------------------------ //
// ----------------------------     Vente Secteur    ---------------------------- //

Route::controller(VendeurController::class)->group(function() {
    Route::get('/vendeurs', 'ListeVendeur')->name('secteurVendeur');
});
Route::controller(CamionController::class)->group(function() {
    Route::get('/Camion', 'Index')->name('secteurCamion');
});

Route::controller(BonSortieController::class)->group(function() {
    Route::prefix('/bon-sortie-secteur')->group(function() {
        Route::get('/', 'listeBonSortie')->name('listeSortieSecteur');
        Route::get('/nouveau', 'CreateBonSortie')->name('createBonSortie');
        Route::get('/detail/{id}', 'ShowBonSortie')->name('showBonSortie');
    });
});

Route::controller(BonSecteurController::class)->group(function() {
    Route::prefix('/bon-vente-secteur')->group(function() {
        Route::get('/', 'listeBonSecteur')->name('listeBonSecteur');
        Route::get('/nouveau', 'CreateBonSecteur')->name('createBonSecteur');
        Route::get('/detail/{id}', 'ShowBonSecteur')->name('showBonSecteur');
    });
});

// ---------------------------------------------------------------------------------- //
// ----------------------------     Fin Vente Secteur    ---------------------------- //

Route::controller(BanqueController::class)->group(function() {
    Route::get('/banque', 'Index')->name('adminbanque');
});

Route::controller(CaisseController::class)->group(function() {
    Route::get('/Caisse', 'Index')->name('adminCaisse');
});

Route::controller(StockController::class)->group(function() {
    Route::get('/Stock', 'Index')->name('adminStock');
});

Route::controller(WareHouseController::class)->group(function() {
    Route::get('/Warehouse', 'Index')->name('adminwarehouse');
});

Route::controller(RoleController::class)->group(function() {
    Route::get('/AdminRole', 'Index')->name('adminRole');
});
Route::controller(SecteurController::class)->group(function() {
    Route::get('/secteur', 'Index')->name('secteur');
});

Route::controller(DepenseController::class)->group(function() {
    Route::get('/depense', 'Index')->name('admindepense');
     Route::post('/depense', 'Storedepense')->name('storedepense');
     Route::get('/depense/{id}', 'EditDepense')->name('editBanque');
     Route::put('/depense/{id?}', 'updateDepense')->name('updatedepense');
    Route::delete('/depense/{id}', 'Deletedepense')->name('deletedepense');
});
Route::controller(EntrepriseController::class)->group(function() {
    Route::get('/Entreprise', 'Index')->name('adminentreprise');
});
Route::controller(TransfertController::class)->group(function() {
    Route::get('/Transferts', 'Index')->name('admintransfert');
    Route::get('/ShowTransfert/{id}', 'ShowTransfert')->name('showTransfert');
    Route::get('/Transfert', 'CreateTransfert')->name('createTransfert');
});