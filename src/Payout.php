<?php

namespace Cryptomus\Api;

final class Payout
{
    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    /**
     * @var string
     */
    private $version = 'v1';

    /**
     * @param $payoutKey
     * @param $merchantUuid
     */
    public function __construct($payoutKey, $merchantUuid)
    {
        $this->requestBuilder = new RequestBuilder($payoutKey, $merchantUuid);
    }

    /**
     * @param array $data
     * - @var string amount: Amount to payout
     * - @var string currency: Currency
     * - @var string network: Network
     * - @var string order_id: Your id
     * - @var string address: Wallet number
     * - @var string is_subtract: From where to withdraw the commission (1 - from the balance, 0 - from the amount)
     * - @var string url_callback: Callback link
     * @return bool|mixed
     * @throws RequestBuilderException
     */
    public function create(array $data)
    {
        return $this->requestBuilder->sendRequest($this->version . '/payout', $data);
    }

    /**
     * uuid or order_id
     * @param array $data
     * - @var string uuid
     * - @var string order_id
     * @return bool|mixed
     * @throws RequestBuilderException
     */
    public function info(array $data)
    {
        return $this->requestBuilder->sendRequest($this->version . '/payout/info', $data);
    }
}