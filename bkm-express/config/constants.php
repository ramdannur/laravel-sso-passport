<?php

return [

    'MYAPP' => "BkmExpressApp",

    'USER' => [
    
    	'STATUS_ACTIVE' => [

    		0 => "Non Aktif",
    		1 => "Aktif"

        ],
    
    	'ROLE' => [

    		0 => "System Admin",
    		1 => "Sales Admin",
    		2 => "Customer Service"

        ],
        
        'SYSTEM_ADMIN' => 0,

        'SALES_ADMIN' => 1,

        'CUSTOMER_SERVICE' => 2,
	
	
    ],

    'BRANCH' => [
    
    	'TIPE' => [

    		0 => "Agen Utama / Cabang",
    		1 => "Kantor Perwakilan",
    		2 => "Sub Agen / Operasional"

        ],
        
        'AGEN_UTAMA' => 0,

        'KTR_PERWAKILAN' => 1,

        'SUB_AGEN' => 2,
	
	],

    "PATH" => [
        "UPLOADS" => [
            "USERS" => "images/"
        ]
    ],
    
];

