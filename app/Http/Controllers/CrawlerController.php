<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Sunra\PhpSimple\HtmlDomParser;
use Artisan;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Artisan::call('Scrapper:start');
        $url = $request->get('url');
        $html = file_get_contents($url);

        // $client = new client();
        // $response  = $client->request('GET', $url);
        // $status = $response->getStatusCode();
        // if($status == 200){
        //     $html = $response->getBody();
        //     $dom = HtmlDomParser::str_get_html( $html );
        //     dd($dom);
        $crawler = new Crawler($html);
        // foreach ($crawler as $domElement) {
        //     var_dump($domElement->nodeName);
        // }
        //$crawler = $crawler->filter('tr > td');
        $crawler = $crawler->filterXPath('/html/body/div/div[2]/table[1]/tbody/tr[4]/td[1]/a');
        dd($crawler);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
