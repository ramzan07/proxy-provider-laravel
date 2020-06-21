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
    public function getFeeds() {

        $request_params = Input::all();

        $rss  = DB::table('feeds')->join('providers', 'providers.id', '=' , 'feeds.provider_id')
            ->select('feeds.*', 'providers.status', 'providers.provider_name', 'providers.provider_link');

        if (isset($request_params['provider_id'])) {

            $rss->where('provider_id', $request_params['provider_id']);
        } elseif(isset($request_params['post_id'])){

            $rss->where('feeds.id', $request_params['post_id']);
        }else {
            $rss;
        }

        $posts = $rss->get();

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

}
