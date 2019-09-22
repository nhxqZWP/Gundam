<?php

namespace App\Http\Controllers;

use App\Api\OkexApi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $btcusd = 'BTC-USD-SWAP';
        $okexApi = new OkexApi(Config('auth.api.okex.key'), Config('auth.api.okex.secret'), Config('auth.api.okex.passPhrase'));

        dd($okexApi->getOrderList($btcusd, 6));

        $position = $okexApi->getSpecificPosition($btcusd);
        //单个合约持仓信息
        if (isset($position['holding'], $position['holding'][0]) && $position['holding'][0]['position'] > 0) {
            $shift = 100; //触发平仓的偏移量
            $side = $position['holding'][0]['side'];
            if ($side == 'short') {
                //当前是卖单

            } elseif ($side == 'long') {
                //当前是买单
            }
        }

        $data = [];
        $data['price'] = $okexApi->getPrice($btcusd)['mark_price'];
        return view('home', $data);
    }
}
