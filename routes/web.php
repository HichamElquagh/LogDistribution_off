<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\admin\StockController;
use App\Http\Controllers\Admin\BanqueController;
use App\Http\Controllers\admin\DepenseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\WareHouseController;
use App\Http\Controllers\Admin\Vente\ClientController;
use App\Http\Controllers\admin\Secteur\VendeurController;
use App\Http\Controllers\Admin\Article\ArticlesController;
use App\Http\Controllers\admin\Secteur\BonSortieController;
use App\Http\Controllers\Admin\Achat\BonReceptionController;
use App\Http\Controllers\admin\Achat\FactureAchatController;
use App\Http\Controllers\Admin\Achat\FournisseursController;
use App\Http\Controllers\Admin\Article\CategoriesController;
use App\Http\Controllers\admin\Personnel\EmployesController;
use App\Http\Controllers\admin\Secteur\BonSecteurController;
use App\Http\Controllers\admin\Vente\FactureVenteController;
use App\Http\Controllers\Admin\Personnel\MagaziniersController;

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

Route::controller(App\Http\Controllers\Admin\Achat\BonCommandeController::class)->group(function() {
    Route::prefix('/bon-commande-achat')->group(function() {
        Route::get('/', 'ListeBonCommande')->name('listeCommande');
        Route::get('/nouveau', 'CreateBonCommande')->name('createCommande');
        Route::get('/detail/{id}', 'ShowBonCommande')->name('showCommande');
    });
});

Route::controller(App\Http\Controllers\Admin\Achat\BonLivraisonController::class)->group(function() {
    Route::prefix('/bon-livraison-achat')->group(function() {
        Route::get('/', 'ListeBonLivraison')->name('listeLivraison');
        Route::get('/nouveau', 'CreateBonLivraison')->name('createLivraison');
        Route::get('/detail/{id}', 'ShowBonLivraison')->name('showLivraison');
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

Route::controller(App\Http\Controllers\Admin\Achat\PaiementController::class)->group(function() {
    Route::get('/paiement-achat', 'Index')->name('achatPaiement');
});

// ----------------------------     Fin Achat     ---------------------------- //
// --------------------------------------------------------------------------- //



// ----------------------------------------------------------------------- //
// ----------------------------     Vente     ---------------------------- //

Route::controller(ClientController::class)->group(function() {
    Route::get('/clients', 'ListeClient')->name('venteClient');
});

Route::controller(App\Http\Controllers\Admin\Vente\BonCommandeController::class)->group(function() {
    Route::prefix('/bon-commande-vente')->group(function() {
        Route::get('/', 'ListeBonCommande')->name('listeCommandeVente');
        Route::get('/nouveau', 'CreateBonCommande')->name('createCommandeVente');
        Route::get('/detail/{id}', 'ShowBonCommande')->name('showCommandeVente');
    });
});

Route::controller(App\Http\Controllers\Admin\Vente\BonLivraisonController::class)->group(function() {
    Route::prefix('/bon-livraison-vente')->group(function() {
        Route::get('/', 'ListeBonLivraison')->name('listeLivraisonVente');
        Route::get('/nouveau', 'CreateBonLivraison')->name('createLivraisonVente');
        Route::get('/detail/{id}', 'ShowBonLivraison')->name('showLivraisonVente');
    });
});

Route::controller(FactureVenteController::class)->group(function() {
    Route::prefix('/facture-vente')->group(function() {
        Route::get('/', 'ListeFactureVente')->name('venteFacture');
        Route::get('/nouveau', 'CreateFactureVente')->name('createFactureVente');
        Route::get('/detail/{id}', 'ShowFacture')->name('showFactureVente');
    });
});

Route::controller(App\Http\Controllers\Admin\Vente\PaiementController::class)->group(function() {
    Route::get('/paiement-vente', 'Index')->name('ventePaiement');
});

// ----------------------------     Fin Vente     ---------------------------- //
// --------------------------------------------------------------------------- //


// ------------------------------------------------------------------------------ //
// ----------------------------     Vente Secteur    ---------------------------- //

Route::controller(VendeurController::class)->group(function() {
    Route::get('/vendeurs', 'ListeVendeur')->name('secteurVendeur');
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

Route::controller(DepenseController::class)->group(function() {
    Route::get('/depense', 'Index')->name('admindepense');
     Route::post('/depense', 'Storedepense')->name('storedepense');
     Route::get('/depense/{id}', 'EditDepense')->name('editBanque');
     Route::put('/depense/{id?}', 'updateDepense')->name('updatedepense');
    Route::delete('/depense/{id}', 'Deletedepense')->name('deletedepense');
});