<?php

declare(strict_types=1);

return [
    \Be\SmLaufliste\Domain\Model\Feuser::class => [
        'tableName' => 'fe_users',
    ],
    \Be\SmLaufliste\Domain\Model\FileReference::class => [
        'tableName' => 'sys_file_reference',
        'properties' => [
            'originalFileIdentifier' => [
                'fieldName' => 'uid_local'
            ]
        ]
    ],
];


