<?php

namespace App\Http\Controllers;

use App\Models\Pa;
use Illuminate\Http\Request;

class GigController extends Controller
{
    public function getIndex()
    {
        $pas = Pa::all();

        return view('pages.home', [
            'pas' => $pas
        ]);
    }
}
