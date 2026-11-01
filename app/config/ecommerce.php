<?php

return [
    'course_access_emails' => ['jerry18@libero.it', 'quipopi@gmail.com', 'dsa.trentino@gmail.com', 'quadrifoglio.dsa.tn@gmail.com', 'sara.sperandio92@gmail.com'],

    /*
    |--------------------------------------------------------------------------
    | Ecommerce data
    |--------------------------------------------------------------------------
    |
    |
    */

    'vat' => '000000000000',

    'cart' => [
        'steps' => [
            1 => [
                'tag' => 'access',
                'label' => 'Accedi',
            ],
            2 => [
                'tag' => 'address',
                'label' => 'Spedizione',
            ],
            3 => [
                'tag' => 'payment',
                'label' => 'Pagamento',
            ],
        ],
        'statuses' => [
            '-1' => [
                'tag' => 'cancelled',
                'label' => 'Cancellato',
                'color' => '#ff6f6f',
                'icon' => 'close',
            ],
            '0' => [
                'tag' => 'open',
                'label' => 'Non completato',
                'color' => '#ccc',
                'icon' => 'pause',
            ],
            '1' => [
                'tag' => 'awaiting-payment',
                'label' => 'Ricevuto',
                'color' => 'hsl(192, 100%, 65%)',
                'icon' => 'hourglass_empty',
            ],
            '2' => [
                'tag' => 'confirmed',
                'label' => 'Confermato',
                'color' => 'hsl(70, 100%, 45%)',
                'icon' => 'correct',
            ],
            '3' => [
                'tag' => 'awaiting-shipping',
                'label' => 'In preparazione',
                'color' => 'hsl(95, 70%, 50%)',
                'icon' => 'deployed_code_history',
            ],
            '4' => [
                'tag' => 'shipped',
                'label' => 'Spedito',
                'color' => 'hsl(41, 100%, 50%)',
                'icon' => 'shipping',
            ],
            '5' => [
                'tag' => 'delivered',
                'label' => 'Consegnato',
                'color' => 'hsl(30, 100%, 50%)',
                'icon' => 'delivered',
            ],
        ],
    ],
];
