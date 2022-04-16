<?php

// Developed by Saeid.S.Nobakht
//===========================================================
require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
require_once 'ted-data-extractor.php';

//===========================================================
$CONFIG['input-file'] = "input/videos-list.txt";
$CONFIG['output-path'] = "./output/";
$CONFIG['user-agent'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:49.0) Gecko/20100101 Firefox/49.0';
$CONFIG['base-uri'] = 'https://www.ted.com';
$CONFIG['ted-hls-server-uri'] = 'https://hls.ted.com/talks/';
$CONFIG['subtitle-lang'] = 'en';
$CONFIG['video-quality'] = '480p';
$CONFIG['timeout'] = 10.0;
//===========================================================

$links = explode("\r\n", file_get_contents($CONFIG['input-file']));
$urlList = array();
// load list of video links
foreach($links as $pageURL){
    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => $CONFIG['base-uri'],
        // You can set any number of default request options.
        'timeout'  => $CONFIG['timeout'],
    ]);
    $pageContent = "";

    try {
        $response = $client->request('GET', $pageURL, ['headers' => ['user-agent' => $CONFIG['user-agent']]]);
        $pageContent = (string)$response->getBody();
        $dataPattern = "/\"__INITIAL_DATA__\"\s*:\s*(.*?)(\\r|\\n)+/i";
        preg_match_all($dataPattern, $pageContent, $matches);
        $data = parseData($matches[1][0]);

        //======== example of saving english subtitle from extracted data
        $data['subtitle'][$CONFIG['subtitle-lang']] = $CONFIG['ted-hls-server-uri'].$data['talk_id'].'/subtitles/'.$CONFIG['subtitle-lang'].'/full.vtt';
        $res = $client->request('GET', $data['subtitle'][$CONFIG['subtitle-lang']], ['headers' => ['user-agent' => $CONFIG['user-agent']]]);
        $subtitleContent = (string)$res->getBody();
        file_put_contents($CONFIG['output-path'].$data['slug']."_".$data['year'].".vtt", $subtitleContent);
        echo "Subtitle saved !";

        ////======== example of saving video urls from extracted data
        if(!empty($data['info'][$CONFIG['video-quality'].'-'.$CONFIG['subtitle-lang']]['url']) && $data['info'][$CONFIG['video-quality'].'-'.$CONFIG['subtitle-lang']]['url'] != ''){
            array_push($urlList, $data['info'][$CONFIG['video-quality'].'-'.$CONFIG['subtitle-lang']]['url']);
        }

    } catch (RequestException $e) {
        if ($e->hasResponse()) {
            echo Psr7\str($e->getResponse());
        }
    }
}

file_put_contents($CONFIG['video-quality'].'-'.$CONFIG['subtitle-lang'].".txt", implode("\r\n", $urlList));
echo "Link of all videos saved!";
