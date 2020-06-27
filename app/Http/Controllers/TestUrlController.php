<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TestUrlController extends Controller
{
    public function index() {
    	$channel = file_get_contents('http://localhost/proxy-provider/api/testUrl');
        $data['channels'] = json_decode($channel, TRUE);

        $testurls = $data['channels']['data'];

        return view('testurl', compact('testurls'));
    }

    public function viewTestUrl(Request $request) {
        $id     = request('provider_id');
        $ip     = request('ip');
        $port   = request('port');
        $testurls = file_get_contents('http://localhost/proxy-provider/api/testUrl');
        $data = json_decode($testurls, TRUE);
        $urls = $data['data'];

        $testip = $ip." : ".$port;
        $str = '';

        $str .="<label for=\"recipient-name\" class=\"col-form-label\">IP $ Port</label>
            <input type=\"text\" name=\"ip\" value=\"{$testip}\" class=\"form-control\" id=\"recipient-name\">";
        $str .="<label for=\"recipient-name\" class=\"col-form-label\">Select Url</label>
            <select name=\"url_id\" id=\"channel\" class=\"form-control\" id=\"exampleFormControlSelect1\">
                <option value=\"null\">Select a Test Url</option>";
                foreach ($urls as $url) {
					$value = $url['id'];
					$text = $url['testurl'];
					$str .="<option value='{$value}'>{$text}</option>";
                }
            $str .="</select>";

        return $str;

    }

    public function testIP(Request $request){
    	$request_params = $request->all();

    	$urlid = $request_params['url_id'];
    	$ipPort = explode(":", $request_params['ip']);
    	$myip = str_replace(" ", "", $ipPort[0]);
    	$myport = str_replace(" ", "", $ipPort[1]);

    	$timeout = 20;
    	$url = DB::table('testurls')->where('id' , $urlid)->first();
    	//Set max execution time
		set_time_limit(100);
		//Step 1 - Check whether the user specified a timeout
		if(!isset($timeout))
		{
			die("You must specify a timeout in seconds in your request (checker.php?...&timeout=20)");
		}

	    $socksOnly = false;
	    $proxy_type = "http(s)";


		if(isset($myip) && isset($myport))
		{
			$this->CheckSingleProxy($myip, $myport, $timeout, true, $socksOnly, $proxy_type, $url->testurl);
		}
		else
		{
			die("<h2>Could not find the required GET parameters.</h2><br /><b>To check a proxy use:</b><br /><i>checker.php?ip=...&port=...</i><br /><b>To go through a list of proxies (IP:PORT Format) use:</b><br /><i>checker.php?file=...</i>");
		}
    }


    function CheckSingleProxy($ip, $port, $timeout, $echoResults=true, $socksOnly=false, $proxy_type="http(s)", $testUrl)
	{
		$url = $testUrl;
		$passByIPPort = $ip . ":" . $port;


		// You can use virtually any website here, but in case you need to implement other proxy settings (show annonimity level)
		// I'll leave you with whatismyipaddress.com, because it shows a lot of info.
		$url = "http://whatismyipaddress.com/";
		if(empty($url)){
			echo "url not valid";
		}
		 
		// Get current time to check proxy speed later on
		$loadingtime = microtime(true);
		 
		$theHeader = curl_init($url);
		curl_setopt($theHeader, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($theHeader, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($theHeader, CURLOPT_PROXY, $passByIPPort);
        
        //If only socks proxy checking is enabled, use this below.
        if($socksOnly)
        {
            curl_setopt($theHeader, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
		
		//This is not another workaround, it's just to make sure that if the IP uses some god-forgotten CA we can still work with it ;)
		//Plus no security is needed, all we are doing is just 'connecting' to check whether it exists!
		curl_setopt($theHeader, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($theHeader, CURLOPT_SSL_VERIFYPEER, 0);
		 
		//Execute the request
		$curlResponse = curl_exec($theHeader);
		 
		 
		if ($curlResponse === false) 
		{
            //If we get a 'connection reset' there's a good chance it's a SOCKS proxy
            //Just as a safety net though, I'm still aborting if $socksOnly is true (i.e. we were initially checking for a socks-specific proxy)
            if(curl_errno($theHeader) == 56 && !$socksOnly)
            {
                $this->CheckSingleProxy($ip, $port, $timeout, $echoResults, true, "socks", $url);
                return;
            }
            
            $arr = array(
                    "result" => array(
                        "success" => false,
                        "error" => curl_error($theHeader),
                        "proxy" => array(
                            "ip" => $ip,
                            "port" => $port,
                            "type" => $proxy_type
                    )
                )
            );
		} 
		else 
		{
			$arr = array(
				"result" => array(
					"success" => true,
					"proxy" => array(
						"ip" => $ip,
						"port" => $port,
						"speed" => floor((microtime(true) - $loadingtime)*1000),
                        "type" => $proxy_type
					)
				)
			);
		}
        if($echoResults)
        { 
            //var_dump($arr['result']);
			if($arr['result']['success'])
			{?>
				<h1 class="display-1"><?php echo$arr['result']['proxy']['ip'].':'.$arr['result']['proxy']['port']; ?></h1>
				<h1 class="display-2"><?php echo "is Works!"; ?></h1>
			<?php }
			else
			{
			?>
				<h1 class="display-1"><?php echo$arr['result']['proxy']['ip'].':'.$arr['result']['proxy']['port']; ?></h1>
				<h1 class="display-2"><?php echo "Is Dead!"; ?></h1>
			<?php
			}
		}

	 }
}
