<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',
    'tournament'    => [
        'cover'     =>  [   'width'=>800,
                            'height'=> 200
                        ],
        'sponsor'   =>  [   'width'=>150, 
                            'height'=>500
                        ],
       
    ],
    'athletic' => [
        'width' => 200,
        'height' => 200
    ]
    
];
