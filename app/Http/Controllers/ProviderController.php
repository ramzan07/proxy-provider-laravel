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
        $providersCount = count($providers);

        $proxies = file_get_contents('http://localhost/proxy-provider/api/proxies');
        $data['channels'] = json_decode($proxies, TRUE);
        $proxiesData = $data['channels']['data'];
        $proxiesCount= count($proxiesData);

        $testUrl = file_get_contents('http://localhost/proxy-provider/api/testUrl');
        $data['channels'] = json_decode($testUrl, TRUE);
        $testUrlData = $data['channels']['data'];
        $testUrlCount= count($testUrlData);

        return view('providers', compact('providers', 'providersCount', 'proxiesCount', 'testUrlCount'));

    }
}
