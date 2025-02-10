<?php

return [
    'adminEmail' => 'admin@checkout.com',
    'supportEmail' => 'support@checkout.com',
    'senderEmail' => 'noreply@checkout.com',
    'senderName' => 'Checkout.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    'storagePath' => dirname(dirname(__DIR__)) . '/backend/web/storage/',
    'app_host' => 'http://app.checkout.local/',
    'industries' => [
        'Technology' => 'Technology',
        'Retail & E-commerce' => 'Retail & E-commerce',
        'Healthcare & Pharmaceuticals' => 'Healthcare & Pharmaceuticals',
        'Finance & Banking' => 'Finance & Banking',
        'Manufacturing & Industrial' => 'Manufacturing & Industrial',
        'Energy & Utilities' => 'Energy & Utilities',
        'Real Estate & Construction' => 'Real Estate & Construction',
        'Education & Training' => 'Education & Training',
        'Entertainment & Media' => 'Entertainment & Media',
        'Hospitality & Travel' => 'Hospitality & Travel',
        'Food & Beverage' => 'Food & Beverage',
        'Logistics & Transportation' => 'Logistics & Transportation',
    ],
];
