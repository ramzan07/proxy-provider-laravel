<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class ScraperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Scrapper:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', 'https://www.xroxy.com/proxylist.htm/');
        // $crawler->filter('tr > td > a')->each(function ($node) {
        //     print $node->text()."</br>";
        // });
        foreach ($crawler->filterXpath('//*[@id="content"]/table[1]/tbody/tr[4]/td[1]/a') as $text) {
            echo $text->nodeValue , "\n";
        }
        echo "nothing";
    }
}
