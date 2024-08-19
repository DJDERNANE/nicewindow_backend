<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CarpentryProfileOrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GlassController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SubscribtionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('home.privacy');

Route::group(['middleware' => 'guest'], function() {
  Route::get('/nice_admin', [LoginController::class, 'form'])->name('admin.login');
});

Route::post('contactus/store', [ContactusController::class, 'store'])->name('home.contactus.store');


Route::get('/nice_admin/login', [LoginController::class, 'login'])->name('admin.auth.login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:web'], function() {
  Route::get('/home', [DashboardController::class, 'home'])->name('admin.home');

  Route::get('/profile', [DashboardController::class, 'indexProfile'])->name('admin.profile');
  Route::post('/profile/settings/general/update', [AccountController::class, 'updateGeneralSettings'])->name('admin.profile.settings.general.update');
  Route::post('/profile/settings/profile_picture/update', [AccountController::class, 'updateProfilepicSettings'])->name('admin.profile.settings.profile_picture.update');
  Route::post('/profile/settings/security/update', [AccountController::class, 'updateSecuritySettings'])->name('admin.profile.settings.security.update');

  Route::get('/contactus', [DashboardController::class, 'indexContactus'])->name('admin.contactus');
  Route::post('/contactus/destroy', [ContactusController::class, 'destroy'])->name('admin.contactus.destroy');
  Route::post('/contactus/read', [ContactusController::class, 'read'])->name('admin.contactus.read');

  // user controle
  Route::get('/users/{type}', [DashboardController::class, 'indexUsers'])->name('admin.users');
  Route::get('/user/{user}', [DashboardController::class, 'indexUser'])->name('admin.user');
  Route::post('/user_infos/general/update', [UserController::class, 'updateGeneralSettings'])->name('admin.user.settings.general.update');
  Route::post('/user_infos/security/update', [UserController::class, 'updateSecuritySettings'])->name('admin.user.settings.security.update');
  Route::post('/user_infos/status/update', [UserController::class, 'updateStatus'])->name('admin.user.settings.status.update');
  Route::post('/user_infos/destroy', [UserController::class, 'destroy'])->name('admin.user.destroy');

  // subscribtions
  Route::post('/subscribtion/store', [SubscribtionController::class, 'store'])->name('admin.subscribtion.store');
  Route::post('/subscribtion/update', [SubscribtionController::class, 'update'])->name('admin.subscribtion.update');
  Route::post('/subscribtion/destroy', [SubscribtionController::class, 'destroy'])->name('admin.subscribtion.destroy');

  // packages
  Route::get('/packages', [DashboardController::class, 'indexPackages'])->name('admin.packages');
  Route::post('/package/store', [PackageController::class, 'store'])->name('admin.package.store');
  Route::post('/package/update', [PackageController::class, 'update'])->name('admin.package.update');
  Route::post('/package/destroy', [PackageController::class, 'destroy'])->name('admin.package.destroy');

  // categories
  Route::get('categories', [DashboardController::class, 'indexCategories'])->name('admin.categories');
  Route::post('category/store', [CategoryController::class, 'store'])->name('admin.category.store');
  Route::post('category/update', [CategoryController::class, 'update'])->name('admin.category.update');
  Route::post('category/destroy', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

  // subcategories
  Route::get('subcategories', [DashboardController::class, 'indexSubcategories'])->name('admin.subcategories');
  Route::post('subcategory/store', [SubcategoryController::class, 'store'])->name('admin.subcategory.store');
  Route::post('subcategory/update', [SubcategoryController::class, 'update'])->name('admin.subcategory.update');
  Route::post('subcategory/destroy', [SubcategoryController::class, 'destroy'])->name('admin.subcategory.destroy');
  Route::get('subcategory/get/by_category/for/select/{category?}', [SubcategoryController::class, 'showByCategoryForSelect'])->name('admin.subcategory.for.select');


  //types
  Route::get('types', [DashboardController::class, 'indexTypes'])->name('admin.types');
  Route::post('type/store', [TypeController::class, 'store'])->name('admin.type.store');
  Route::post('type/update', [TypeController::class, 'update'])->name('admin.type.update');
  Route::post('type/destroy', [TypeController::class, 'destroy'])->name('admin.type.destroy');
  Route::get('type/gettypes/{subcategory?}', [TypeController::class, 'showBySubCategoryForSelect'])->name('admin.type.for.select');

  // profiles
  Route::get('profiles', [DashboardController::class, 'indexProfiles'])->name('admin.profiles');
  Route::post('profile/store', [ProfileController::class, 'store'])->name('admin.profile.store');
  Route::post('profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
  Route::post('profile/destroy', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');

  // glass
  Route::get('/glass', [DashboardController::class, 'indexGlass'])->name('admin.glass');
  Route::post('/glass/store', [GlassController::class, 'store'])->name('admin.glass.store');
  Route::post('/glass/update', [GlassController::class, 'update'])->name('admin.glass.update');
  Route::post('/glass/destroy', [GlassController::class, 'destroy'])->name('admin.glass.destroy');

  Route::get('/colors', [DashboardController::class, 'indexColors'])->name('admin.colors');
  Route::post('/color/store', [ColorController::class, 'store'])->name('admin.color.store');
  Route::post('/color/update', [ColorController::class, 'update'])->name('admin.color.update');
  Route::post('/color/destroy', [ColorController::class, 'destroy'])->name('admin.color.destroy');

  // profile orders
  Route::get('/profile_orders', [DashboardController::class, 'indexProfileOrders'])->name('admin.orders.profile');
  Route::get('/profile_order/{order}', [DashboardController::class, 'indexProfileOrder'])->name('admin.order.profile');
  Route::post('/profile_order_status/update', [CarpentryProfileOrderController::class, 'updateStatus'])->name('admin.order.profile.status.update');

  // estimate orders
  Route::get('/estimate_orders', [DashboardController::class, 'indexEstimateOrders'])->name('admin.orders.estimate');

  // notifications
  Route::get('/notifications', [DashboardController::class, 'indexNotifications'])->name('admin.notifications');
});