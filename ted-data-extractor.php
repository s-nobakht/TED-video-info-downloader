<?php

// Developed by Saeid.S.Nobakht
//===========================================================
function parseData($dataString){
    $result = array();
    $pattern['current_talk'] = '/\"current_talk\":([0-9]+),/i';
    preg_match_all($pattern['current_talk'], $dataString, $matches);
    $result['talk_id'] = intval($matches[1][0]);
    $pattern['comments'] = '/{\"id\":([0-9]+),\"count\":([0-9]+),\"talk_id\":([0-9]+)},/is';
    preg_match_all($pattern['comments'], $dataString, $matches);
    $result['comments']['id'] = intval($matches[1][0]);
    $result['comments']['count'] = intval($matches[2][0]);
    $pattern['description'] = '/\"description\":\"(.*?)\",/is';
    preg_match_all($pattern['description'], $dataString, $matches);
    $result['description'] = $matches[1][0];
    $pattern['event'] = '/\"event\":\"(.*?)\",/is';
    preg_match_all($pattern['event'], $dataString, $matches);
    $result['event'] = $matches[1][0];
    $pattern['language'] = '/\"language\":\"(.*?)\",/is';
    preg_match_all($pattern['language'], $dataString, $matches);
    $result['language'] = $matches[1][0];
    $pattern['media'] = '/\"media\":{\"internal\":{\"64k\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"},\"180k\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"},\"320k\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"},\"450k\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"},\"600k\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"},\"950k\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"},\"1500k\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"},\"2500k\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"},\"podcast\-light\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"},\"podcast\-regular\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"},\"podcast\-high\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"},\"audio\-podcast\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"},\"podcast\-low\-en\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"},\"podcast\-high\-en\":{\"uri\":\"(.*?)\?apikey=.*?\",\"filesize_bytes\":([0-9]+),\"mime_type\":\"(.*?)\"}}},/i';
    preg_match_all($pattern['media'], $dataString, $matches);
    $result['info']['64k']['url'] = $matches[1][0];
    $result['info']['64k']['size'] = intval($matches[2][0]);
    $result['info']['180k']['url'] = $matches[4][0];
    $result['info']['180k']['size'] = intval($matches[5][0]);
    $result['info']['320k']['url'] = $matches[7][0];
    $result['info']['320k']['size'] = intval($matches[8][0]);
    $result['info']['450k']['url'] = $matches[10][0];
    $result['info']['450k']['size'] = intval($matches[11][0]);
    $result['info']['600k']['url'] = $matches[13][0];
    $result['info']['600k']['size'] = intval($matches[14][0]);
    $result['info']['950k']['url'] = $matches[16][0];
    $result['info']['950k']['size'] = intval($matches[17][0]);
    $result['info']['1500k']['url'] = $matches[19][0];
    $result['info']['1500k']['size'] = intval($matches[20][0]);
    $result['info']['2500k']['url'] = $matches[22][0];
    $result['info']['2500k']['size'] = intval($matches[23][0]);
    $result['info']['light']['url'] = $matches[25][0];
    $result['info']['light']['size'] = intval($matches[26][0]);
    $result['info']['normal']['url'] = $matches[28][0];
    $result['info']['normal']['size'] = intval($matches[29][0]);
    $result['info']['480p']['url'] = $matches[31][0];
    $result['info']['480p']['size'] = intval($matches[32][0]);
    $result['info']['mp3']['url'] = $matches[34][0];
    $result['info']['mp3']['size'] = intval($matches[35][0]);
    $result['info']['low-en']['url'] = $matches[37][0];
    $result['info']['low-en']['size'] = intval($matches[38][0]);
    $result['info']['480p-en']['url'] = $matches[40][0];
    $result['info']['480p-en']['size'] = intval($matches[41][0]);
    $pattern['name'] = '/\"name\":\"(.*?)\",/is';
    preg_match_all($pattern['name'], $dataString, $matches);
    $result['name'] = $matches[1][0];
    $pattern['slug'] = '/\"slug\":\"(.*?)\",/is';
    preg_match_all($pattern['slug'], $dataString, $matches);
    $result['slug'] = $matches[1][0];
    $pattern['speakers'] = '/\"speakers\":\[{\"id\":([0-9]+),\"slug\":\"(.*?)\",\"firstname\":\"(.*?)\",\"lastname\":\"(.*?)\",\"description\":\"(.*?)\",\"photo_url\":\"(.*?)\",\"whatotherssay\":\"(.*?)\",\"whotheyare\":\"(.*?)\",\"whylisten\":\"(.*?)\",\"title\":\"(.*?)\",\"middleinitial\":\"(.*?)\"}\],/is';
    preg_match_all($pattern['speakers'], $dataString, $matches);
    $result['speakers']['id'] = $matches[1][0];
    $result['speakers']['slug'] = $matches[2][0];
    $result['speakers']['firstname'] = $matches[3][0];
    $result['speakers']['lastname'] = $matches[4][0];
    $result['speakers']['description'] = $matches[5][0];
    $result['speakers']['photo_url'] = $matches[6][0];
    $result['speakers']['whatotherssay'] = $matches[7][0];
    $result['speakers']['whotheyare'] = $matches[8][0];
    $result['speakers']['whylisten'] = $matches[9][0];
    $result['speakers']['title'] = $matches[10][0];
    $result['speakers']['middleinitial'] = $matches[11][0];
    $pattern['threadId'] = '/\"threadId\":([0-9]+),/is';
    preg_match_all($pattern['threadId'], $dataString, $matches);
    $result['threadId'] = $matches[1][0];
    $pattern['url'] = '/\"url\":\"(.*?)\",/is';
    preg_match_all($pattern['url'], $dataString, $matches);
    $result['url'] = $matches[1][0];

    $pattern['view_count'] = '/\"viewed_count\":([0-9]+),/is';
    preg_match_all($pattern['view_count'], $dataString, $matches);
    $result['view_count'] = $matches[1][0];

    $pattern['year'] = '/\"year\":\"([0-9]{4})\",/is';
    preg_match_all($pattern['year'], $dataString, $matches);
    $result['year'] = $matches[1][0];

    $pattern['tag'] = '/\"tag\":\"(.*?)",/is';
    preg_match_all($pattern['tag'], $dataString, $matches);
    $result['tag'] = $matches[1][0];

    return $result;
}

