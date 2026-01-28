<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
  public function about(Request $req)
{
    $name = 'pooja';
    return view('about', compact('name'));
}

}
