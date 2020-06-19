<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Sunra\PhpSimple\HtmlDomParser;
use Artisan;
use Symfony\Component\DomCrawler\Crawler;
use DB;
use Redirect;
use Carbon\Carbon;

class ProxyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($provider_id)
    {
        /*lates request time*/
        \DB::table('providers')->where('id', $provider_id)->update(['last_attempt_date' => date('Y-m-d H:i:s')]);

        $provider = \DB::table('providers')->where('id', $provider_id)->first();
        $xmlStr = file_get_contents($provider->url."/proxyrss.xml");
        $xml = simplexml_load_string($xmlStr, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);


        $this->handleProxies($array, $provider);
        return Redirect::back()->with('msg', 'The Message');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function handleProxies($data, $channel) {

        foreach ($data['channel']['item'] as $item) {
            $post = \App\Models\Feeds::where('link', $item['link'])->first();
            if (!empty($post)) {
                $settings = \DB::table('settings')->where('type', 'delete')->first();
                $time = $this->calculateTimeDiffToDelete($post->created_at);
                if ($time > $settings->time) {
                    $post->delete();
                }
            }
            if (empty($post)) {
                $this->createPost($item, $channel);
            }
        }

        $updateSetting = \DB::table('settings')->where('type', 'update')->where('provider_id' , $channel->id)->first();
        if(empty($updateSetting)){
            $setting['provider_id'] = $channel->id;
            $setting['type'] = 'update';
            $setting['time'] = date('Y-m-d H:i:s');
            \App\Models\Configration::create($setting);
        } else{
            $settings = \DB::table('settings')->where('type', 'update')->where('provider_id', $channel->id)->update(['time' => date('Y-m-d H:i:s')]);
        }
    }
}
