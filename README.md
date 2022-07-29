# Cryptomus PHP SDK

PHP SDK module for working with the Cryptomus API

## Installation and connection

Installation using [composer](https://getcomposer.org/download/):

```bash
$ composer require cryptomus/api-php-sdk
```

## Documentation

**Methods for working with api**: https://doc.cryptomus.com/ <br>

## Authorization

`PAYOUT_KEY` or `PAYMENT_KEY`, also `MERCHANT_UUID` required to use SDK details in [documentation](https://doc.cryptomus.com/general/request).

```php
<?php

const PAYMENT_KEY = 'uQ4LFWCBE3dT84uQnt7ycL7p9WcSwjkSPQaZbik3ChoWO0egw51f4EAaZQKmefhPP0F1cX8OpRcl2c3HexNedoR7FGEYGA1mTgMPI8lzKl7Ct2I43R6SSC3gVDS3rkGX';
const MERCHANT_UUID = 'c26b80a8-9549-4a66-bb53-774f12809249';

$payment = \Cryptomus\Api\Client::payment(PAYMENT_KEY, MERCHANT_UUID);

?>
```

```php
<?php

const PAYOUT_KEY = 'qseRhcxu6wsxhygfhyidwrrgryrrgefhPP0F1cNedoR7FGEYGA1mTgMPX8OpRcl2c3HexNedoR7FGEYGA1mTgMPI8lzKl7Ct2I43R6S1f4EAaZQKmefhSC3gVDS3rkGX';
const MERCHANT_UUID = 'c26b80a8-9549-4a66-bb53-774f12809249';

$payout = \Cryptomus\Api\Client::payout(PAYOUT_KEY, MERCHANT_UUID);

?>
```

## Payout methods

### Payout request

```php
<?php

$data = [
    'amount' => '15',
    'currency' => 'USD',
    'network' => 'TRON',
    'order_id' => '555321',
    'address' => 'TXguLRFtrAFrEDA17WuPfrxB84jVzJcNNV',
    'is_subtract' => '1'
    'url_callback' => 'https://example.com/callback'
];

$result = $payout->create($data);

?>
```

Output:

```
array(9) {
  ["uuid"]=>
  string(36) "a7c0caec-a594-4aaa-b1c4-77d511857594"
  ["amount"]=>
  string(1) "3"
  ["currency"]=>
  string(3) "TRX"
  ["network"]=>
  string(4) "tron"
  ["address"]=>
  string(5) "TJ..."
  ["txid"]=>
  NULL
  ["status"]=>
  string(7) "process"
  ["is_final"]=>
  bool(false)
  ["balance"]=>
  int(129)
}
```

### Info

```php
<?php

$data = ["uuid" => "a7c0caec-a594-4aaa-b1c4-77d511857594"];
// or
$data = ["order_id" => "12345"];

$result = $payout->info($data);

?>
```

Output:

```
array(9) {
  ["uuid"]=>
  string(36) "a7c0caec-a594-4aaa-b1c4-77d511857594"
  ["amount"]=>
  string(10) "3.00000000"
  ["currency"]=>
  string(3) "TRX"
  ["network"]=>
  string(4) "tron"
  ["address"]=>
  string(6) "TJZ..."
  ["txid"]=>
  NULL
  ["status"]=>
  string(7) "process"
  ["is_final"]=>
  bool(false)
  ["balance"]=>
  string(12) "129.00000000"
}

```

## Payment methods

### Payment services

```php
<?php

$result = $payment->services();

?>
```

Output:

```
array(1) {
  [0]=>
  array(5) {
    ["network"]=>
    string(4) "TRON"
    ["currency"]=>
    string(3) "TRX"
    ["is_available"]=>
    bool(true)
    ["limit"]=>
    array(2) {
      ["min_amount"]=>
      string(10) "1.00000000"
      ["max_amount"]=>
      string(11) "10.00000000"
    }
    ["commission"]=>
    array(2) {
      ["fee_amount"]=>
      string(4) "0.00"
      ["percent"]=>
      string(4) "0.00"
    }
  }
}

```

### Payment create

```php
<?php

$data = [
    'amount' => '16',
    'currency' => 'USD',
    'network' => 'ETH',
    'order_id' => '555123',
    'url_return' => 'https://example.com/return',
    'url_callback' => 'https://example.com/callback',
    'is_payment_multiple' => false,
    'lifetime' => '7200'
    'to_currency' => 'ETH'
];

$result = $payment->create($data);

?>
```

Output:

```
array(14) {
  ["uuid"]=>
  string(36) "8b03432e-385b-4670-8d06-064591096795"
  ["amount"]=>
  string(2) "16"
  ["order_id"]=>
  string(7) "test_19"
  ["currency"]=>
  string(3) "TRX"
  ["comments"]=>
  NULL
  ["network"]=>
  string(4) "tron"
  ["address"]=>
  string(5) "TW..."
  ["from"]=>
  NULL
  ["txid"]=>
  NULL
  ["payment_status"]=>
  string(5) "check"
  ["url"]=>
  string(66) "https://pay.cryptomus.com/pay/8b03432e-385b-4670-8d06-064591096795"
  ["expired_at"]=>
  int(1650980953)
  ["status"]=>
  string(5) "check"
  ["is_final"]=>
  bool(false)
}
```

### Info

```php
<?php

$data = ["uuid" => "a7c0caec-a594-4aaa-b1c4-77d511857594"];
// or
$data = ["order_id" => "12345"];

$result = $payment->info($data);

?>
```

Output:

```
array(15) {
  ["uuid"]=>
  string(36) "8b03432e-385b-4670-8d06-064591096795"
  ["order_id"]=>
  string(7) "test_10"
  ["amount"]=>
  string(11) "16.00000000"
  ["payment_amount"]=>
  string(8) "0.000000"
  ["currency"]=>
  string(3) "TRX"
  ["comments"]=>
  NULL
  ["network"]=>
  string(4) "tron"
  ["address"]=>
  string(5) "TW..."
  ["from"]=>
  NULL
  ["txid"]=>
  NULL
  ["payment_status"]=>
  string(5) "check"
  ["url"]=>
  string(66) "https://pay.cryptomus.com/pay/8b03432e-385b-4670-8d06-064591096795"
  ["expired_at"]=>
  int(1650980953)
  ["status"]=>
  string(4) "paid"
  ["is_final"]=>
  bool(true)
}
```

### Payment History

```php
<?php

$page = 3;

$result = $payment->history($page);

?>
```

Output:

```
array(2) {
  ["items"]=>
  array(1) {
    [0]=>
    array(15) {
      ["uuid"]=>
      string(36) "87094a43-5fe4-4629-b2fd-c37e8e2af76c"
      ["order_id"]=>
      string(10) "1650956609"
      ["amount"]=>
      string(11) "16.00000000"
      ["payment_amount"]=>
      string(10) "0.01200000"
      ["currency"]=>
      string(3) "ETH"
      ["comments"]=>
      NULL
      ["network"]=>
      string(3) "eth"
      ["address"]=>
      string(5) "0x..."
      ["from"]=>
      string(6) "0x4..."
      ["txid"]=>
      NULL
      ["payment_status"]=>
      string(4) "paid"
      ["url"]=>
      string(66) "https://pay.cryptomus.com/pay/87094a43-5fe4-4629-b2fd-c37e8e2af76c"
      ["expired_at"]=>
      int(1650960209)
      ["status"]=>
      string(4) "paid"
      ["is_final"]=>
      bool(true)
    }
  }
  ["paginate"]=>
  array(5) {
    ["count"]=>
    int(2)
    ["hasPages"]=>
    bool(false)
    ["nextCursor"]=>
    NULL
    ["previousCursor"]=>
    NULL
    ["perPage"]=>
    int(15)
  }
}
```

### Balance

```php
<?php

$result = $payment->balance();

?>
```

Output:

```
array(1) {
  [0]=>
  array(1) {
    ["balance"]=>
    array(2) {
      ["merchant"]=>
      array(6) {
        [0]=>
        array(3) {
          ["uuid"]=>
          string(32) "abcdabcd-abcd-1234-1234-abcdabcd"
          ["balance"]=>
          string(10) "0.00000000"
          ["currency_code"]=>
          string(3) "ETH"
        }
        [1]=>
        array(3) {
          ["uuid"]=>
          string(32) "abcdabcd-abcd-1234-1234-abcdabcd"
          ["balance"]=>
          string(10) "0.57000000"
          ["currency_code"]=>
          string(3) "BTC"
        }
        [2]=>
        array(3) {
          ["uuid"]=>
          string(32) "abcdabcd-abcd-1234-1234-abcdabcd"
          ["balance"]=>
          string(11) "23.57327446"
          ["currency_code"]=>
          string(3) "TRX"
        }
        [3]=>
        array(3) {
          ["uuid"]=>
          string(32) "abcdabcd-abcd-1234-1234-abcdabcd"
          ["balance"]=>
          string(10) "5.00000000"
          ["currency_code"]=>
          string(4) "USDT"
        }
        [4]=>
        array(3) {
          ["uuid"]=>
          string(32) "abcdabcd-abcd-1234-1234-abcdabcd"
          ["balance"]=>
          string(11) "10.00120000"
          ["currency_code"]=>
          string(4) "DASH"
        }
        [5]=>
        array(3) {
          ["uuid"]=>
          string(32) "abcdabcd-abcd-1234-1234-abcdabcd"
          ["balance"]=>
          string(10) "0.18500000"
          ["currency_code"]=>
          string(3) "LTC"
        }
      }
      ["user"]=>
      array(6) {
        [0]=>
        array(3) {
          ["uuid"]=>
          string(32) "abcdabcd-abcd-1234-1234-abcdabcd"
          ["balance"]=>
          string(10) "0.40000000"
          ["currency_code"]=>
          string(3) "BTC"
        }
        [1]=>
        array(3) {
          ["uuid"]=>
          string(32) "abcdabcd-abcd-1234-1234-abcdabcd"
          ["balance"]=>
          string(11) "52.00000000"
          ["currency_code"]=>
          string(4) "USDT"
        }
        [2]=>
        array(3) {
          ["uuid"]=>
          string(32) "abcdabcd-abcd-1234-1234-abcdabcd"
          ["balance"]=>
          string(10) "0.00000000"
          ["currency_code"]=>
          string(4) "DASH"
        }
        [3]=>
        array(3) {
          ["uuid"]=>
          string(32) "abcdabcd-abcd-1234-1234-abcdabcd"
          ["balance"]=>
          string(10) "0.30000000"
          ["currency_code"]=>
          string(3) "LTC"
        }
        [4]=>
        array(3) {
          ["uuid"]=>
          string(32) "abcdabcd-abcd-1234-1234-abcdabcd"
          ["balance"]=>
          string(11) "27.00000000"
          ["currency_code"]=>
          string(3) "TRX"
        }
        [5]=>
        array(3) {
          ["uuid"]=>
          string(32) "abcdabcd-abcd-1234-1234-abcdabcd"
          ["balance"]=>
          string(10) "0.19000000"
          ["currency_code"]=>
          string(3) "ETH"
        }
      }
    }
  }
}
```

### Resend notifications 

```php
<?php

$data = ["uuid" => "a7c0caec-a594-4aaa-b1c4-77d511857594"];
// or
$data = ["order_id" => "12345"];

$result = $payment->reSendNotifications($data);

?>
```

Output:

```
bool(true)
```

### Wallet create

```php
<?php

$data = [
    'network' => 'TRON',
    'currency' => 'USDT',
    'order_id' => '5535321',
    'url_callback' => 'https://example.com/callback'
];

$result = $payment->createWallet($data);

?>
```

Output:

```
array(5) {
  ["uuid"]=>
  string(12) "9f64a7ce-..."
  ["order_id"]=>
  string(2) "24"
  ["currency"]=>
  string(4) "USDT"
  ["network"]=>
  string(4) "tron"
  ["address"]=>
  string(6) "TK8..."
}
```

### Exceptions

All methods can throw RequestBuilderException.

```php
<?php

$payment = \Cryptomus\Api\Client::payment(PAYOUT_KEY, MERCHANT_UUID);

try {
    $result = $payment->services();
} catch (\Cryptomus\Api\RequestBuilderException $e) {
    log('Error request Cryptomus to method ' . $e->getMethod() . ': ' . $e->getMessage());
}

?>
```

## Requirements

* **PHP v5.6.0** or higher
* extension PHP **json**
* extension PHP **curl**
