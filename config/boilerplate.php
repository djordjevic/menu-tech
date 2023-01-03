<?php

return [
    'calculation_input' => [
        'validation_rules' => [
            'currency' => 'required',
            'amount' => 'required'
        ],
        'validation_messages' => [
            'amount.required' => 'Amount of conversion is required',
            'currency.required' => 'Please specify currency you wish to buy',
        ]
    ],
    'create_order' => [
        'validation_rules' => [
            'foreign_currency' => 'required|exists:currencies,swift_code',
            'exchange_rate' => 'required|exists:exchange_rates,exchange_rate',
            'surcharge_percent' => 'required|between:1,100',
            'surcharge_amount' => 'required|between:0,99.99',
            'foreign_currency_amount' => 'required|numeric',
            'total_paid_amount' => 'required|between:0,99.99',
            'discount_percent' => 'required|between:1,100',
            'discount_amount' => 'required|between:0,99.99'
        ],

    ],
    'update_order' => [
        'validation_rules' => [
            'foreign_currency' => 'required|exists:currencies,swift_code',
            'exchange_rate' => 'required|exists:exchange_rates,exchange_rate',
            'surcharge_percent' => 'required|between:1,100',
            'surcharge_amount' => 'required|between:0,99.99',
            'foreign_currency_amount' => 'required|numeric',
            'total_paid_amount' => 'required|between:0,99.99',
            'discount_percent' => 'required|between:1,100',
            'discount_amount' => 'required|between:0,99.99'
        ],

    ],
    'delete_order' => [
        'validation_rules' => [
            'id' => 'required'
        ]
    ],
];
