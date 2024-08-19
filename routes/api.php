<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Carpentry\AppointmentController;
use App\Http\Controllers\Api\Carpentry\CartController;
use App\Http\Controllers\Api\Carpentry\ClientController;
use App\Http\Controllers\Api\Carpentry\FavoriteSupplierController;
use App\Http\Controllers\Api\Carpentry\GlassController;
use App\Http\Controllers\Api\Carpentry\PurchasesController;
use App\Http\Controllers\Api\Carpentry\CarpentryProductsController;
use App\Http\Controllers\Api\Carpentry\PackageController;
use App\Http\Controllers\Api\Carpentry\CarpentryUserController;
use App\Http\Controllers\Api\Carpentry\ProfilesOrderController;
use App\Http\Controllers\Api\Carpentry\SubscribtionController;
use App\Http\Controllers\Api\Carpentry\AccountingCarpentryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\Client\RepairController;
use App\Http\Controllers\Api\LocationsController;
use App\Http\Controllers\Api\Supplier\Profile\AccountingController;
use App\Http\Controllers\Api\Supplier\Profile\ClientDetailsController;
use App\Http\Controllers\Api\Supplier\Profile\ProfileOrderController;
use App\Http\Controllers\Api\Supplier\Profile\ProfileStockController;
use App\Http\Controllers\Api\Supplier\Profile\ProfileClientController;
use App\Http\Controllers\Api\Supplier\Profile\FavorisClientsController;
use App\Http\Controllers\Api\Supplier\Profile\CreditController;
use App\Http\Controllers\Api\Supplier\SupplierClients;
use App\Http\Controllers\Api\SpendController;
use App\Http\Controllers\Api\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/login/check', [LoginController::class, 'check']);

Route::group(['middleware' => 'auth:api'], function () {
  // users
  Route::post('/confirmemail', [Email::class, 'Confirm']);
  Route::get('/users', [UserController::class, 'show']);
  Route::post('/user/store', [UserController::class, 'store']);
  Route::post('/user/update', [UserController::class, 'updateGeneralSettings']);
  Route::post('/user/status/update', [UserController::class, 'updateStatus']);
  Route::post('/user/logo', [UserController::class, 'updateLogo']);


  Route::get('/locations', [LocationsController::class, 'show']);
  Route::post('/location/store', [LocationsController::class, 'store']);
  Route::post('/location/destroy', [LocationsController::class, 'destroy']);

  Route::post('account/general/update', [AccountController::class, 'updateGeneralSettings']);
  Route::post('account/password/update', [AccountController::class, 'updatePassword']);
  Route::post('account/delete', [AccountController::class, 'deleteAccount']);

  // carpentry api
  Route::group(['prefix' => 'carpentry'], function() {
    //Users 
    Route::get('/users', [CarpentryUserController::class, 'show']);
    Route::post('/user/store', [CarpentryUserController::class, 'store']);
    Route::post('/user/update', [CarpentryUserController::class, 'update']);
    Route::post('/user/status/update', [CarpentryUserController::class, 'updateStatus']);
   //accounting
    Route::get('/accounting/total/filter', [AccountingCarpentryController::class, 'filter']);
    Route::get('/accounting/totalrevenuDetails', [AccountingCarpentryController::class, 'deatils']);
    Route::get('/accounting/revenu/details', [AccountingCarpentryController::class, 'PayementDetails']);
    // appointments
    Route::get('/appointments', [AppointmentController::class, 'show']);
    Route::post('/appointment/store', [AppointmentController::class, 'store']);
    Route::post('/appointment/finish', [AppointmentController::class, 'finish']);
    Route::post('/appointment/destroy', [AppointmentController::class, 'destroy']);


    Route::post('/payement/orderpayement', [ClientController::class, 'orderpayement']);
    Route::post('/payement/payementcredit', [ClientController::class, 'creditpayement']);
    // cart
    Route::post('/cart', [CartController::class, 'show']);
    Route::post('/cart/count', [CartController::class, 'showCount']);
    Route::post('/cart/store', [CartController::class, 'store']);
    Route::post('/cart/destroy', [CartController::class, 'destroy']);

    // profiles orders
    Route::get('/categories', [ProfilesOrderController::class, 'showCategories']);
    Route::get('/profile/orders', [ProfilesOrderController::class, 'showOrders']);
    Route::get('/profile/order/{order}', [ProfilesOrderController::class, 'showOrder']);
    Route::get('/suppliers', [ProfilesOrderController::class, 'showSuppliers']);
    Route::get('/searchsupplier', [ProfilesOrderController::class, 'searchSuppliers']);
    Route::post('/supplier/profile/stock', [ProfilesOrderController::class, 'showSupplierStock']);
    Route::POST('/supplier/profile/qtePrice', [ProfilesOrderController::class, 'getQtePrice']);
    Route::post('/profile/order/store', [ProfilesOrderController::class, 'store']);
    
    // clients
    Route::get('/clients', [ClientController::class, 'show']);
    Route::get('/client', [ClientController::class, 'client']);
    Route::post('/client/store', [ClientController::class, 'store']);

    //clients Shapes 
    Route::post('/shape/store', [ClientController::class, 'shapeStore']);
    Route::get('/shapes', [ClientController::class, 'getShapes']);
    Route::get('/shapesConfirmed', [ClientController::class, 'getShapesConfirmed']);
    Route::post('/shape/delete', [ClientController::class, 'deleteShape']);
    Route::post('/shape/update', [ClientController::class, 'updateShape']);
    Route::get('/shape/colors', [ClientController::class, 'getcolor']);


    // favorites suppliers
    Route::get('/suppliers/favorites', [ProfilesOrderController::class, 'showFavoritesSuppliers']);
    Route::post('/supplier/favorite/store', [FavoriteSupplierController::class, 'store']);
    Route::post('/supplier/favorite/check', [FavoriteSupplierController::class, 'check']);
   
    // packages
    Route::get('/packages', [PackageController::class, 'show']);

    // premium subscibtions
    Route::get('/subscribtions', [SubscribtionController::class, 'show']);
    Route::post('/subscribtion/store', [SubscribtionController::class, 'store']);

    
    // glasses
    Route::get('/glasses', [GlassController::class, 'show']);

    // Carepentry Products 
    Route::get('/alms', [CarpentryProductsController::class, 'alms']);
    Route::get('/allglass', [CarpentryProductsController::class, 'glass']);
    Route::get('/volles', [CarpentryProductsController::class, 'volles']);
    Route::get('/extensions', [CarpentryProductsController::class, 'extensions']);

    Route::post('/alm/add', [CarpentryProductsController::class, 'addAlm']);
    Route::post('/alm/update', [CarpentryProductsController::class, 'updateAlm']);
    Route::post('/alm/delete', [CarpentryProductsController::class, 'deleteAlm']);

    Route::post('/glass/add', [CarpentryProductsController::class, 'addGlass']);
    Route::post('/glass/update', [CarpentryProductsController::class, 'updateGlass']);
    Route::post('/glass/delete', [CarpentryProductsController::class, 'deleteGlass']);

    Route::post('/volle/add', [CarpentryProductsController::class, 'addVolle']);
    Route::post('/volle/update', [CarpentryProductsController::class, 'updateVolle']);
    Route::post('/volle/delete', [CarpentryProductsController::class, 'deleteVolle']);

    Route::post('/extension/add', [CarpentryProductsController::class, 'addExtension']);
    Route::post('/extension/update', [CarpentryProductsController::class, 'updateExtension']);
    Route::post('/extension/delete', [CarpentryProductsController::class, 'deleteExtension']);
    
    
    //Accounting 
    Route::get('/carpentry/purchases', [PurchasesController::class, 'index']);
    Route::get('/carpentry/revenu', [PurchasesController::class, 'revenu']);

    // Client Orders 
    
    Route::get('/orders/confirmed', [ClientController::class, 'getOrdersConfirmed']);
  });


  // supplier api
  Route::group(['prefix' => 'supplier'], function () {
    // Accounting 
    Route::post('/accounting/store', [SpendController::class, 'store']);
    Route::get('/accounting/total', [SpendController::class, 'index']);
    Route::get('/accounting/spend/details', [SpendController::class, 'SpendDetails']);
    Route::get('/accounting/total/filter', [AccountingController::class, 'filter']);
    Route::get('/accounting/totalprofit', [AccountingController::class, 'index']);
    Route::get('/accounting/totalrevenuDetails', [AccountingController::class, 'deatils']);
    Route::get('/accounting/revenu/details', [AccountingController::class, 'PayementDetails']);
    //endCounting
    Route::get('/categories', [ProfileStockController::class, 'showCategories']);
    Route::get('/subcategories/{category}', [ProfileStockController::class, 'showSubcategories']);
    Route::get('/profiles/{subcategory}', [ProfileStockController::class, 'showProfiles']);
    Route::post('/profiles/types', [ProfileStockController::class, 'getTypes']);
    Route::get('/profiles/supplier/show', [ProfileStockController::class, 'showSupplierProfiles']);
    Route::get('/stock', [ProfileStockController::class, 'show']);
    Route::get('/stockArticle', [ProfileStockController::class, 'showArticle']);
    Route::get('/orders', [ProfileOrderController::class, 'showOrders']);
    Route::get('/order/search', [ProfileOrderController::class, 'search']);
    Route::get('/orders/histories', [ProfileOrderController::class, 'showHistories']);
    Route::get('/orders/check', [ProfileOrderController::class, 'checkOrders']);
    Route::get('/order/{order}', [ProfileOrderController::class, 'showOrder']);
    Route::post('/order/destroy', [ProfileOrderController::class, 'destroyOrder']);
    Route::post('/order_status/update', [ProfileOrderController::class, 'updateStatus']);
    Route::post('/payement/credit', [ProfileOrderController::class, 'credit']);
    Route::post('/payement/paye', [ProfileOrderController::class, 'paye']);
    Route::post('/remise/order', [ProfileOrderController::class, 'OrderRemise']);
    Route::post('/remise/item', [ProfileOrderController::class, 'ItemRemise']);
    Route::post('/delete/remise/order', [ProfileOrderController::class, 'DeleteOrderRemise']);
    Route::post('/delete/remise/item', [ProfileOrderController::class, 'DeleteItemRemise']);
    Route::post('/stock/store', [ProfileStockController::class, 'store']);
    Route::post('/product/store', [ProfileStockController::class, 'storeProduct']);
    Route::post('/stock/update', [ProfileStockController::class, 'update']);
    Route::post('/stock/destroy', [ProfileStockController::class, 'destroy']);
    
    Route::post('/user/store', [SupplierClients::class, 'storeClient']);
    Route::post('/user/delete', [SupplierClients::class, 'deleteClient']);
    Route::get('/clients', [SupplierClients::class, 'getClients']);
    Route::post('/profile/order/store', [ProfileOrderController::class, 'store']);


    Route::get('/credit/{clientId?}', [CreditController::class, 'index']);
    Route::post('/credit/store', [CreditController::class, 'store']);
    
     // favorites Clients 
    Route::post('/clients/favorite/store', [FavorisClientsController::class, 'store']);
    Route::get('/favoris', [FavorisClientsController::class, 'getFavoris']);

    Route::get('/client/{clientId?}', [ClientDetailsController::class, 'getClientDetails']);
  });

  Route::group(['prefix' => 'client'], function() {
    Route::post('/repair', [RepairController::class, 'show']);
  });
});