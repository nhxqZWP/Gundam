<?php
/**
 * Created by PhpStorm.
 * User: gundam
 * Date: 2019/9/21
 * Time: 6:36 PM
 */

namespace App\Api;


class OkexApi extends BaseApi
{
    /**
     * OKEX V3 PHP REST 合约API
     *
     * @version 0.1
     * @api  hhttps://www.okex.me/docs/zh/#swap-swap---hold_information
     */

// test
//$futures = new FuturesApi();
//$ret =$futures->setLeverage( 'btc', 'BTC-USD-180213', 1);
//var_dump($ret);

    # future api 交割合约
//    const FUTURE_POSITION = '/api/futures/v3/position';
//    const FUTURE_SPECIFIC_POSITION = '/api/futures/v3/';
//    const FUTURE_ACCOUNTS = '/api/futures/v3/accounts';
//    const FUTURE_COIN_ACCOUNT = '/api/futures/v3/accounts/';
//    const FUTURE_GET_LEVERAGE = '/api/futures/v3/accounts/';
//    const FUTURE_SET_LEVERAGE = '/api/futures/v3/accounts/';
//    const FUTURE_LEDGER = '/api/futures/v3/accounts/';
//    const FUTURE_DELETE_POSITION = '/api/futures/v3/close_all_orders';
//    const FUTURE_ORDER = '/api/futures/v3/order';
//    const FUTURE_ORDERS = '/api/futures/v3/orders';
//    const FUTURE_REVOKE_ORDER = '/api/futures/v3/cancel_order/';
//    const FUTURE_REVOKE_ORDERS = '/api/futures/v3/cancel_batch_orders/';
//    const FUTURE_ORDERS_LIST = '/api/margin/v3/orders';
//    const FUTURE_ORDER_INFO = '/api/futures/v3/orders/';
//    const FUTURE_FILLS = '/api/futures/v3/fills';
//    const FUTURE_PRODUCTS_INFO = '/api/futures/v3/instruments';
//    const FUTURE_DEPTH = '/api/futures/v3/instruments/';
//    const FUTURE_TICKER = '/api/futures/v3/instruments/ticker';
//    const FUTURE_SPECIFIC_TICKER = '/api/futures/v3/instruments/';
//    const FUTURE_TRADES = '/api/futures/v3/instruments/';
//    const FUTURE_KLINE = '/api/futures/v3/instruments/';
//    const FUTURE_INDEX = '/api/futures/v3/instruments/';
//    const FUTURE_RATE = '/api/futures/v3/rate';
//    const FUTURE_ESTIMAT_PRICE = '/api/futures/v3/instruments/';
//    const FUTURE_HOLDS = '/api/futures/v3/instruments/';
//    const FUTURE_LIMIT = '/api/futures/v3/instruments/';
//    const FUTURE_LIQUIDATION = '/api/futures/v3/instruments/';
//    const FUTURE_MARK = '/api/futures/v3/instruments/';
//    const HOLD_AMOUNT = '/api/futures/v3/accounts/';
//    const CURRENCY_LIST = '/api/futures/v3/instruments/currencies/';

    # swap api 永续合约
    const SWAP_POSITION = '/api/swap/v3/position';
    const SWAP_SPECIFIC_POSITION = '/api/swap/v3/';
    const SWAP_ACCOUNTS = '/api/swap/v3/accounts';
    const SWAP_COIN_ACCOUNT = '/api/swap/v3/';
    const SWAP_GET_LEVERAGE = '/api/swap/v3/accounts/';
    const SWAP_SET_LEVERAGE = '/api/swap/v3/accounts/';
    const SWAP_LEDGER = '/api/swap/v3/accounts/';
    const FUTURE_DELETE_POSITION = '/api/futures/v3/close_all_orders';
    const SWAP_ORDER = '/api/swap/v3/order';
    const SWAP_ORDERS = '/api/swap/v3/orders';
    const SWAP_REVOKE_ORDER = '/api/swap/v3/cancel_order/';
    const SWAP_REVOKE_ORDERS = '/api/swap/v3/cancel_batch_orders/';
    const SWAP_ORDERS_LIST = '/api/swap/v3/orders/';
    const SWAP_ORDER_INFO = '/api/swap/v3/orders/';
    const SWAP_FILLS = '/api/swap/v3/fills';
    const SWAP_PRODUCTS_INFO = '/api/swap/v3/instruments';
    const SWAP_DEPTH = '/api/swap/v3/instruments/';
    const SWAP_TICKER = '/api/swap/v3/instruments/ticker';
    const SWAP_SPECIFIC_TICKER = '/api/swap/v3/instruments/';
    const SWAP_TRADES = '/api/swap/v3/instruments/';
    const SWAP_KLINE = '/api/swap/v3/instruments/';
    const SWAP_INDEX = '/api/swap/v3/instruments/';
    const SWAP_RATE = '/api/swap/v3/rate';
    const FUTURE_ESTIMAT_PRICE = '/api/futures/v3/instruments/';
    const SWAP_HOLDS = '/api/swap/v3/instruments/';
    const SWAP_LIMIT = '/api/swap/v3/instruments/';
    const SWAP_LIQUIDATION = '/api/swap/v3/instruments/';
    const FUTURE_MARK = '/api/futures/v3/instruments/';
    const HOLD_AMOUNT = '/api/futures/v3/accounts/';
    const CURRENCY_LIST = '/api/futures/v3/instruments/currencies/';
    const SWAP_PRICE = '/api/swap/v3/instruments/';

    // 获取合约账户所有的持仓信息
    public function getPosition()
    {
        return $this->request(self::SWAP_POSITION, [], 'GET');
    }
    // 单个合约持仓信息
    public function getSpecificPosition($instrument_id)
    {
        return $this->request(self::SWAP_SPECIFIC_POSITION.$instrument_id.'/position', [], 'GET');
    }
    // 获取所有币种的合约账户信息
    public function getAccounts()
    {
        return $this->request(self::SWAP_ACCOUNTS, [], 'GET');
    }
    // 单个币种合约账户信息
    public function getCoinAccounts($symbol)
    {
        return $this->request(self::SWAP_COIN_ACCOUNT.$symbol.'/accounts', [], 'GET');
    }
    // 获取合约账户币种杠杆倍数,持仓模式
    public function getLeverage($symbol)
    {
        return $this->request(self::SWAP_GET_LEVERAGE.$symbol.'/settings', [], 'GET');
    }
    // 设定合约币种杠杆倍数
    public function setLeverage($symbol, $instrument_id='', $direction='', $leverage=10)
    {
        $params = [
            'instrument_id' =>  $instrument_id,
            'side' => $direction, //方向:1.逐仓-多仓 2.逐仓-空仓 3.全仓
            'leverage' => $leverage
        ];
        if ($symbol)
            return $this->request(self::SWAP_SET_LEVERAGE.$symbol.'/leverage', $params, 'POST');
        else
            return $this->request(self::SWAP_SET_LEVERAGE.'leverage', $params, 'POST');
    }
    // 账单流水查询 默认第一页 100条
    public function getLedger($symbol)
    {
        return $this->request(self::SWAP_LEDGER.$symbol.'/ledger', [], 'GET');
    }
    // 下单
    public function takeOrder($client_oid, $instrument_id, $otype, $price, $size, $match_price, $leverage)
    {
        $params = [
            'client_oid' => $client_oid, //否	由您设置的订单id来唯一标识您的订单，数字+字母（大小写）或者纯字母（大小写）类型，1-32位
            'instrument_id'=> $instrument_id, //合约名称，如BTC-USD-SWAP
            'type' => $otype, //可填参数：1:开多 2:开空 3:平多 4:平空
            'price' => $price,
            'size' => $size, //否	是否以对手价下单 0:不是 1:是，当以对手价下单，order_type只能选择0:普通委托
            'match_price' => $match_price,
            'leverage' => $leverage
        ];
        return $this->request(self::SWAP_ORDER, $params, 'POST');
    }
    // 批量下单
    public function takeOrders($instrument_id, $orders_data, $leverage)
    {
        $params = [
            'instrument_id' => $instrument_id,
            'orders_data' => $orders_data, //JSON类型的字符串 例：[{"order_type":"0","client_oid": "E213","price": "5","size": "2","type": "1","match_price": "0"},{"order_type":"0","client_oid": "243","price": "2","size": "3","type": "2","match_price": "1"}] 最大下单量为20，当以对手价下单，order_type只能选择0:普通委托
            'leverage' => $leverage
        ];
        return $this->request(self::SWAP_ORDERS, $params, 'POST');
    }
    // 撤销指定订单
    public function revokeOrder($instrument_id, $order_id)
    {
        return $this->request(self::SWAP_REVOKE_ORDER.$instrument_id.'/'.$order_id, [], 'POST');
    }
    // 批量撤销订单
    public function revokeOrders($instrument_id, $order_ids)
    {
        $params = ['order_ids' => $order_ids];
        return $this->request(self::SWAP_REVOKE_ORDERS.$instrument_id, $params, 'POST');
    }
    // 获取订单列表
    public function getOrderList($status, $froms, $to, $limit, $instrument_id='')
    {
        $params = ['status' => $status, 'instrument_id' => $instrument_id];
        if ($froms) $params['before'] = $froms;
        if ($to) $params['after'] = $to;
        if ($limit) $params['limit'] = $limit;
        return $this->request(self::SWAP_ORDERS_LIST, $params, 'GET');
    }
    // 获取订单信息
    public function getOrderInfo($order_id, $instrument_id)
    {
        return $this->request(self::SWAP_ORDER_INFO.$instrument_id.'/'.$order_id, [], 'GET');
    }
    // 获取成交明细
    public function getFills($order_id, $instrument_id, $froms, $to, $limit)
    {
        $params = [
            'order_id' => $order_id,
            'before' => $froms,
            'after' => $to,
            'limit' => $limit,
            'instrument_id' => $instrument_id
        ];
        return $this->request(self::SWAP_FILLS, $params, 'GET');
    }
    // 获取合约信息
    public function getProducts()
    {
        return $this->request(self::SWAP_PRODUCTS_INFO, [], 'GET');
    }
    // 获取深度
    public function getDepth($instrument_id, $size)
    {
        $params = ['size' => $size];
        return $this->request(self::SWAP_DEPTH.$instrument_id.'/depth', $params, 'GET');
    }
    // 获取全部ticker信息
    public function getTicker()
    {
        return $this->request(self::SWAP_TICKER, [], 'GET');
    }
    // 获取某个ticker信息
    public function getSpecificTicker($instrument_id)
    {
        return $this->request(self::SWAP_SPECIFIC_TICKER.$instrument_id.'/ticker', [], 'GET');
    }
    // 获取成交数据
    public function getTrades($instrument_id, $froms=0, $to=0, $limit=0)
    {
        $params = ['instrument_id' => $instrument_id];
        if ($froms) $params['before'] = $froms;
        if ($to) $params['after'] = $to;
        if ($limit) $params['limit'] = $limit;
        return $this->request(self::SWAP_TRADES.$instrument_id.'/trades', $params, 'GET', True);
    }
    // 获取K线数据
    public function getKline($instrument_id, $granularity, $start='', $end='')
    {
        $params = [
            'granularity' => $granularity,
            'start' => $start,
            'end' => $end
        ];
        return $this->request(self::SWAP_KLINE.$instrument_id.'/candles', $params, 'GET');
    }
    // 获取指数信息
    public function getIndex($instrument_id)
    {
        return $this->request(self::SWAP_INDEX.$instrument_id.'/index', [], 'GET');
    }
    // 获取法币汇率
    public function getRate()
    {
        return $this->request(self::SWAP_RATE, [], 'GET');
    }
    // 获取平台总持仓量
    public function getHolds($instrument_id)
    {
        return $this->request(self::SWAP_HOLDS.$instrument_id.'/open_interest', [], 'GET');
    }
    // 获取当前限价
    public function getLimit($instrument_id)
    {
        return $this->request(self::SWAP_LIMIT.$instrument_id.'/price_limit', [], 'GET');
    }
    // 获取爆仓单
    public function getLiquidation($instrument_id, $status, $froms = 0, $to = 0, $limit = 0)
    {
        $params = ['instrument_id' => $instrument_id, 'status' => $status];
        if ($froms) $params['from'] = $froms;
        if ($to) $params['to'] = $to;
        if ($limit) $params['limit'] = $limit;
        return $this->request(self::SWAP_LIQUIDATION.$instrument_id.'/liquidation', $params, 'GET');
    }
    // 获取合约标记价格 合约名称，如BTC-USD-SWAP
    public function getPrice($instrument_id)
    {
        return $this->request(self::SWAP_PRICE.$instrument_id.'/mark_price', [], 'GET');
    }

}