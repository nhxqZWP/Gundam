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
        dd(1);
        $okexApi = new OkexApi(Config('auth.api.okex.key'), Config('auth.api.okex.secret'));
        dd($okexApi->getAccounts());
        dd(Config('auth.api.okex'));
    }
}