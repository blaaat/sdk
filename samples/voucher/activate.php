<?php

declare(strict_types=1);

$app = require __DIR__ . '/../init_application.php';

$response = $app
    ->setRequest(
        'ActivateVoucher',
        [
            'cardNumber' => $config->get('voucherNumber'),
        ],
        [
            'Voucher' => [
                'amount' => [
                    'amount' => 1,
                    'currency' => 'EUR',
                ],
                'pinCode' => '58809',
                'posId' => '1541',
            ],
        ]
    )
    ->run()
;

print_response($response);
