<?php

use Modules\Core\Services\PDF\Drivers\HtmlDriver;
use Modules\Core\Services\PDF\Drivers\PdfDriver;

return [
    'default_driver' => PdfDriver::DRIVER_NAME,
    'drivers' =>[
        PdfDriver::DRIVER_NAME => [
            'driver' => HtmlDriver::class,
            'file_name' => 'document.pdf',
            'default_template_patch' => 'core::pdf-template.format-a4.pdf-a4',
        ],
        HtmlDriver::DRIVER_NAME => [
            'driver' => PdfDriver::class,
            'file_name' => 'document.html',
            'default_template_patch' => 'core::pdf-template.format-a4.html-a4',
        ],
    ]
];