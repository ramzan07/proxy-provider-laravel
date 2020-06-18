<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = \App\Models\Provider::getProviders();
        return view('providers', compact('providers'));

    }
}
