<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {

        $channel = file_get_contents('http://localhost/proxy-provider/api/providers');
        $data['channels'] = json_decode($channel, TRUE);

        $providers = $data['channels']['data'];

        return view('providers', compact('providers'));

    }
}
