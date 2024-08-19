<?php

namespace App\Http\Controllers;

use App\Common\UserType;
use App\Models\CarpentryProfileOrder;
use App\Models\Category;
use App\Models\type;
use App\Models\Color;
use App\Models\Contactus;
use App\Models\EstimateOrder;
use App\Models\Glass;
use App\Models\Newsletter;
use App\Models\Package;
use App\Models\Profile;
use App\Models\Subcategory;
use App\Models\Subscribtion;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function home()
  {
    return view('admin.home');
  }

  public function indexProfile()
  {
    return view('admin.profile');
  }

  public function indexNotifications()
  {
    return view('admin.notifications');
  }

  public function indexContactus()
  {
    $messages = Contactus::orderBy('id', 'DESC')->paginate(20);
    return view('admin.contactus', ['messages' => $messages]);
  }

  public function indexUsers($type = '')
  {
    if(!empty($type))
    {
      switch ($type)
      {
        case 'clients':
          $user_type = UserType::CLIENT;
          break;
        case 'carpentries':
          $user_type = UserType::CARPENTRY;
          break;
        case 'profile_suppliers':
          $user_type = UserType::SUPPLIER_PROFILE;
          break;
        
        default:
          $user_type = UserType::ADMIN;
          break;
      }

      $users = User::where('type', $user_type)->orderBy('id', 'DESC')->paginate(20);

      return view('admin.users', ['users' => $users]);
    }
    else
    {
      return abort(404);
    }
  }

  public function indexUser($user)
  {
    $user = User::withTrashed()->find($user);
    if($user)
    {
      $subscribtions = Subscribtion::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
      $subscribtions->load('package');
      return view('admin.user', ['user' => $user, 'subscribtions' => $subscribtions]);
    }
    
    return abort(404);
  }

  public function indexPackages()
  {
    $packages = Package::all();
    return view('admin.packages', ['packages' => $packages]);
  }

  public function indexCategories()
  {
    $categories = Category::all();
    return view('admin.categories', ['categories' => $categories]);
  }

  public function indexSubcategories()
  {
    $subcategories = Subcategory::all();
    $subcategories->load('category');
    return view('admin.subcategories', ['subcategories' => $subcategories]);
  }

  public function indexTypes()
  {
    $subcategories = Subcategory::all();
    $categories = Category::all();
    $types = type::all();
    return view('admin.types',compact('subcategories','categories', 'types'));
  }


  public function indexProfiles()
  {
    $profiles = Profile::all();
    $profiles->load('category');
   
    return view('admin.profiles', ['profiles' => $profiles]);
  }

  public function indexGlass()
  {
    $glass = Glass::all();
    return view('admin.glass', ['glass' => $glass]);
  }

  public function indexColors()
  {
    $colors = Color::all();
    return view('admin.colors', ['colors' => $colors]);
  }

  public function indexProfileOrders()
  {
    $orders = CarpentryProfileOrder::orderBy('id', 'DESC')->paginate(20);
    $orders->load(['carpentry' => function($query) {
      $query->withTrashed();
    }], 'supplier');

    return view('admin.profile_orders', ['orders' => $orders]);
  }

  public function indexProfileOrder(CarpentryProfileOrder $order)
  {
    $order->load(['carpentry' => function($query) {
      $query->withTrashed();
    }], 'supplier');
    return view('admin.profile_order', ['order' => $order]);
  }

  public function indexEstimateOrders()
  {
    $orders = EstimateOrder::orderBy('id', 'DESC')->paginate(20);
    $orders->load('carpentry', 'client');
    return view('admin.estimate_orders', ['orders' => $orders]);
  }
}
