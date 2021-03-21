<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GigController extends Controller
{
    public function getIndex()
    {

        return view('pages.home');
    }
}
