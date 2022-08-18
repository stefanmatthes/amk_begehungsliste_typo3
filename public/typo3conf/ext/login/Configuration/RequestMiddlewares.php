<?php

return [
    'frontend' => [
        'webicorns/login/authentication' => [
            'target' => \Webicorns\Login\Middleware\FrontendUserAuthenticator::class,
            'after' => [
                'typo3/cms-frontend/authentication'
            ],
            'before' => [
                'typo3/cms-adminpanel/initiator',
            ],
        ]
    ]
];