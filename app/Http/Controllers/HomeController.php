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
        dd($okexApi->getSpecificPosition($btcusd));

        $data = [];
        $data['price'] = $okexApi->getPrice($btcusd)['mark_price'];
        return view('home', $data);
    }
}
