<?php

namespace PagSeguro\Http\Controllers\Home;

use Illuminate\Http\Request;
use PagSeguro\Http\Controllers\Controller;

class HomeController extends Controller
{
  public function index()
  {
    return view('pages.home.index');
  }
}
