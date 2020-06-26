<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Sunra\PhpSimple\HtmlDomParser;
use Artisan;
use Symfony\Component\DomCrawler\Crawler;
use DB;
use Redirect;
use DateTime;
use Input;

class ProxyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request_params = $request->all();
        if (!empty($request_params) && isset($request_params['channel_id'])) {
            $proxies = file_get_contents('http://localhost/proxy-provider/api/proxies?provider_id=' . $request_params['channel_id']);
        } else {
            $proxies = file_get_contents('http://localhost/proxy-provider/api/proxies');
        }

        $data['channels'] = json_decode($proxies, TRUE);

        $proxiesData = $data['channels']['data'];
        $proxy_channels = DB::table('providers')->get();

        return view('index', compact('proxiesData', 'proxy_channels'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($provider_id = null, Request $request)
    {
        $request_params = $request->all();
        dd($request_params);
        $settings = \DB::table('settings')->where('provider_id', $provider_id)->first();

        /*$flag = $this->calculateTimeDiffToUpdate($settings->request_time);
        if (!$flag) {
            return "time_issue";
        }*/
        if(empty($settings)){
            $setting['provider_id'] = $provider_id;
            $setting['request_time'] = date('Y-m-d H:i:s');
            \App\Models\Setting::create($setting);
        } else{
            $flag = $this->calculateTimeDiffToUpdate($settings->request_time);
            if (!$flag) {
                return "time_issue";
            }

            \DB::table('settings')->where('id', $provider_id)->update(['request_time' => date('Y-m-d H:i:s')]);
        }

        /*lates request time*/
        //\DB::table('providers')->where('id', $provider_id)->update(['last_attempt_date' => date('Y-m-d H:i:s')]);

        $provider = \DB::table('providers')->where('id', $provider_id)->first();
        if($provider->title == "XROXY Proxy Lists"){
            $xmlStr = file_get_contents($provider->url."/proxyrss.xml");
            $from = ["prx:proxy", "prx:ip", "prx:port", "prx:type", "prx:ssl", "prx:check_timestamp", "prx:country_code", "prx:latency", "prx:reliability"];
            $to   = ["proxy", "ip", "port","type","ssl","checked","country_code","latency","reliability"];
            $newPhrase = str_replace($from, $to, $xmlStr);
            $xml = simplexml_load_string($newPhrase, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);

            $this->handleXRoxy($array, $provider);
        } else if($provider->title == "Byteproxies List"){
            $client = new \GuzzleHttp\Client();
            $res = $client->get('https://byteproxies.com/api.php?key=free&amount=100&type=all&anonymity=all');
            $data =  $res->getBody();
            $array = json_decode($data, TRUE);
            $this->handleProxiAPI($array, $provider);
        } elseif ($provider->title == "Proxy11 List") {
            $client = new \GuzzleHttp\Client();
            $res = $client->get('https://proxy11.com/api/proxy.json?key=MTM4MA.Xua0HQ.WJbhwZOdPlqp1H7oRVXpmwpwu10');
            $data =  $res->getBody();
            $array = json_decode($data, TRUE);
            $this->handleProxiAPI($array['data'], $provider);
        } elseif ($provider->title == "Pubproxies List") {
            $client = new \GuzzleHttp\Client();
            $res = $client->get('http://pubproxy.com/api/proxy?limit=10&fbclid=IwAR1q0n5nlv3U9YQhYpwWMeS_jfCfGEPENC2UQ0yoaYHrEf90NyHSPlUjraE');
            $data =  $res->getBody();
            $array = json_decode($data, TRUE);
            $this->handleProxiAPI($array['data'], $provider);
        }
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

    public function handleXRoxy($data, $provider) {

        /** Xroxy Handler*/
        $proxy = \App\Models\Proxy::where('provider_id', $provider->id)->first();
        if(empty($proxy)){
            foreach ($data['channel']['item'] as $item) {
                $this->createProxies($item, $provider);
            }
        } else {
            \App\Models\Proxy::where('provider_id', $provider->id)->delete();
            foreach ($data['channel']['item'] as $item) {
                $this->createProxies($item, $provider);
            }
        }
    }


    public function handleProxiAPI($data, $provider) {
        /** ProxyAPIs Handler*/
        $proxy = \App\Models\Proxy::where('provider_id', $provider->id)->first();
        if(empty($proxy)){
            if($provider->title == 'Proxy11 List' || $provider->title == 'Pubproxies List'){
                foreach ($data as $item) {
                $this->createAPIProxies($item, $provider);
                }
            } else {
                foreach ($data as $item) {
                    $this->createAPIProxies($item['response'], $provider);
                }
            }
        } else {
            \App\Models\Proxy::where('provider_id', $provider->id)->delete();
            if($provider->title == 'Proxy11 List' || $provider->title == 'Pubproxies List'){
                foreach ($data as $item) {
                $this->createAPIProxies($item, $provider);
                }
            } else {
                foreach ($data as $item) {
                    $this->createAPIProxies($item['response'], $provider);
                }
            }
        }
    }

    public function createProxies($item, $provider) {

        foreach ($item['proxy'] as $item) {

            $rss['provider_id'] = $provider->id;
            $rss['ip'] = $item['ip'];
            $rss['port'] = $item['port'];
            $rss['type'] = $item['type'];
            $rss['check_timestamp'] = is_numeric($item['checked']) ? date("Y-m-d H:i:s", substr($item['checked'], 0, 10)) : $item['checked'];
            \App\Models\Proxy::create($rss);
        }
    }


    public function createAPIProxies($item, $provider) {

            if($provider->title == 'Proxy11 List'){
                $item['checked'] = $item['updatedAt'];
                unset($item['updatedAt']);
            } else if($provider->title == 'Pubproxies List') {
                $item['checked'] = $item['last_checked'];
                unset($item['last_checked']);
            }


            $rss['provider_id'] = $provider->id;
            $rss['ip'] = $item['ip'];
            $rss['port'] = $item['port'];
            $rss['type'] = $item['type'];
            $rss['check_timestamp'] =  date("Y-m-d H:i:s", substr(strtotime($item['checked']), 0, 10));
            \App\Models\Proxy::create($rss);
    }

    /**
     * calculateTimeDiff method 
     * responsible for telling system to updated feed or not
     * @param type $time
     * @return boolean
     */
    public function calculateTimeDiffToUpdate($time) {
        $start_date = new DateTime($time);
        $since_start = $start_date->diff(new DateTime(date('Y-m-d H:i:s')));
        $minutes = $since_start->days * 24 * 60;
        $minutes += $since_start->h * 60;
        $minutes += $since_start->i;

        if ($minutes < 1) {
            return false;
        }
        return true;
    }
}
