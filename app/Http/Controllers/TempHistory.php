<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Colors;


class TempHistory extends Controller
{
    //show current weekly average
    function index()
    {

        $requestURI = "http://api.worldweatheronline.com/free/v2/past-weather.ashx";
        $requestArray = [
            "key"       => env('WEATHER_API_KEY'),      //api license key
            "q"         => env('POSTAL_CODE'),          //postal code | city,st | lat,long
            "format"    => "json",
            "tp"        => 24,                          //period in hours
            "date"      => "2016-01-01",
            "enddate"   => "2016-01-07"                 //enddate has to be in the same month
        ];

//        $almanac = [
//'January' => [42.5, 34.9, 27.3, 0, 917, 3.2],
//'February' => [46.5, 38.1, 29.7, 0, 742, 2.6],
//'March' => [55.7, 46.5, 37.3, 4, 563, 3.6],
//'April' => [66.3, 56.1, 45.9, 21, 272, 2.8],
//'May' => [75.4, 65.6, 55.8, 107, 73, 3.8],
//'June' => [83.9, 74.5, 65.0, 304, 5, 3.1],
//'July' => [88.3, 79.2, 70.1, 456, 0, 3.7],
//'August' => [86.3, 77.4, 68.6, 407, 7, 3.4],
//'September' => [79.3, 70.5, 61.8, 200, 19, 3.8],
//'October' => [68.0, 58.8, 49.6, 28, 205, 3.2],
//'November' => [57.3, 48.7, 40.0, 4, 477, 3.0],
//'December' => [47.0, 39.5, 32.0, 0, 775, 3.1],
//        ];
//        
//        foreach($almanac as $name=> $month){
//            $highs[$name] = $month[0];
//            $lows[$name] = $month[2];
//            $averages[$name] = $month[1];
//        }
//        return compact('highs', 'lows', 'averages');
        
        $url = \Laracurl::buildUrl($requestURI, $requestArray);
        $response = \Laracurl::get($url);
        if($response->code != "200 OK") {
            $error = $response->body;
            return view('index', compact('error', 'requestArray'));
        } else {
            $response = json_decode($response->body);
            $weather = $response->data->weather;
        }
        
        $weeklystats = [
            'hi' => '',
            'low' => '',
            'avg' => ''
        ];
        foreach($weather as $day){
            $weeklystats['hi'] += $day->maxtempF;
            $weeklystats['low'] += $day->mintempF;
            $weeklystats['avg'] += (($day->mintempF + $day->maxtempF) / 2);
        }
        foreach($weeklystats as $stat=>$value){
            $weeklystats[$stat] = $value / 7;
        }

        $tempRanges = $this->getTempRanges();
        foreach($tempRanges as $range){
            if($weeklystats['avg'] > $range['low'] && $weeklystats['avg'] < $range['high']){
                $weeklystats['color'] = $range['color'];
            }
        }
        return view('index', compact('weeklystats', 'requestArray'));

    }
    
    function colors()
    {
        $tempRanges = $this->getTempRanges();
        return view('colors', compact('tempRanges'));
    }
    
    function getTempRanges()
    {        
        $colors = Colors::all();
        
        $hi = 95;
        $low = 30;
        $colorCount = count($colors);
        $increment = ($hi - $low) / $colorCount;
        $temp = $low;
        for($i=0;$i<$colorCount;$i++){
            $startTemp = $temp;
            $temp += $increment;
            $tempRanges[] = ["low" => ceil($startTemp), "high" => floor($temp), "color" => $colors[$i]];
        }
        return $tempRanges;
    }
}
