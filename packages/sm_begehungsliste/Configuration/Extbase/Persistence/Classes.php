<?php

declare(strict_types=1);

return [
    \Be\SmBegehungsliste\Domain\Model\Feuser::class => [
        'tableName' => 'fe_users',
        
    ],
    \Be\SmBegehungsliste\Domain\Model\FileReference::class => [
        'tableName' => 'sys_file_reference',
        'properties' => [
            'originalFileIdentifier' => [
                'fieldName' => 'uid_local'
            ]
        ]
    ],
];
