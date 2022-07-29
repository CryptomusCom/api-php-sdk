<?php

namespace Cryptomus\Api;

final class Client
{
    /**
     * @param string $payoutKey
     * @param string $merchantUuid
     * @return Payout
     */
    public static function payout($payoutKey, $merchantUuid)
    {
        return new Payout($payoutKey, $merchantUuid);
    }

    /**
     * @param string $paymentKey
     * @param string $merchantUuid
     * @return Payment
     */
    public static function payment($paymentKey, $merchantUuid)
    {
        return new Payment($paymentKey, $merchantUuid);
    }
}