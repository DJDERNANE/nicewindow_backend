<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function home()
  {
    return view('home.home');
  }

  public function privacy()
  {
    return view('home.privacy');
  }
}
