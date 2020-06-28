<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
Use DB;

class ProxyApiController  extends Controller {

    use \App\Http\Traits\ApiService;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProxies(Request $request) {

        $request_params = $request->all();

        $proxies  = DB::table('proxies');

        if (isset($request_params['provider_id'])) {

            $proxies->where('provider_id', $request_params['provider_id']);
        } elseif(isset($request_params['post_id'])){

            $proxies->where('feeds.id', $request_params['post_id']);
        }else {
            $proxies;
        }
        $posts = $proxies->get();

        return $this->jsonSuccessResponse('Process is processed success', $posts);
    }

    /**
     * channels method 
     * responsible for getting channels
     * @return \Illuminate\Http\Response
     */
    public function getProviders(Request $request) {

        $request_params = $request->all();
        if (isset($request_params['provider_id'])) {
            $providers = \App\Models\Provider::where('id', $request_params['provider_id'])->get();
        } else {
            $providers = \App\Models\Provider::all();
        }

        return $this->jsonSuccessResponse('Process is processed success', $providers);
    }

    public function getTestUrl(Request $request) {
        $testUrl = \App\Models\TestUrl::all();
        return $this->jsonSuccessResponse('Process is processed success', $testUrl);
    }

}
