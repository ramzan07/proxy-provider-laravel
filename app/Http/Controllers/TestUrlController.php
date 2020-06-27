<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestUrlController extends Controller
{
    public function index() {
    	$channel = file_get_contents('http://localhost/proxy-provider/api/testUrl');
        $data['channels'] = json_decode($channel, TRUE);

        $testurls = $data['channels']['data'];

        return view('testurl', compact('testurls'));
    }
}
