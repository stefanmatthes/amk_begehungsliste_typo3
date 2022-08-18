<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgang',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'name,laufliste,schichten,user,log',
        'iconfile' => 'EXT:sm_laufliste/Resources/Public/Icons/tx_smlaufliste_domain_model_rundgang.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name,  laufliste, schichten, user, log',
    ],
    'types' => [
        '1' => ['showitem' => '--div--;Grunddaten,name, laufliste, schichten, user, --div--;Bisherige Rundgänge,log'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_smlaufliste_domain_model_rundgang',
                'foreign_table_where' => 'AND tx_smlaufliste_domain_model_rundgang.pid=###CURRENT_PID### AND tx_smlaufliste_domain_model_rundgang.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
            ],
        ],

        'name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgang.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'laufliste' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgang.laufliste',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_smlaufliste_domain_model_laufliste',
                'foreign_table_where' => 'AND tx_smlaufliste_domain_model_laufliste.pid = ###CURRENT_PID###',
                'minitems' => 0,
                'maxitems' => 1,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],

            ],
        ],
        'schichten' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgang.schichten',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_smlaufliste_domain_model_schicht',
                'foreign_field' => 'rundgang',
                'foreign_sortby' => 'sorting',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'useSortable' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],

        ],
        'user' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgang.user',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'fe_users',
                'MM' => 'tx_smlaufliste_rundgang_feuser_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'log' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgang.log',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_smlaufliste_domain_model_rundgangaktiv',
                'foreign_field' => 'rundgang',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],

        ],
    
        'standort' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
