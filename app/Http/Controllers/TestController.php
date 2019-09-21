<?php
/**
 * Created by PhpStorm.
 * User: gundam
 * Date: 2019/9/21
 * Time: 6:28 PM
 */

namespace App\Http\Controllers;


use App\Api\OkexApi;

class TestController extends Controller
{
    public function index()
    {
        $btcusd = 'BTC-USD-SWAP';
        $okexApi = new OkexApi(Config('auth.api.okex.key'), Config('auth.api.okex.secret'), Config('auth.api.okex.passPhrase'));
        dd($okexApi->getPrice($btcusd));
        dd(Config('auth.api.okex'));
    }
}