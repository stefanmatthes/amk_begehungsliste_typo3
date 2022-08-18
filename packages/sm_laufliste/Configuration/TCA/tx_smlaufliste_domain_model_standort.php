<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_standort',
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
        'searchFields' => 'name,ansprechpartner,adresse,rundgaenge,receiver',
        'iconfile' => 'EXT:sm_laufliste/Resources/Public/Icons/tx_smlaufliste_domain_model_standort.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, ansprechpartner, adresse, rundgaenge, receiver',
    ],
    'types' => [
        '1' => ['showitem' => '--div--;Grunddaten,name, ansprechpartner, adresse,receiver, --div--;Rundgang,rundgaenge'],
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
                'foreign_table' => 'tx_smlaufliste_domain_model_standort',
                'foreign_table_where' => 'AND tx_smlaufliste_domain_model_standort.pid=###CURRENT_PID### AND tx_smlaufliste_domain_model_standort.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_standort.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'ansprechpartner' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_standort.ansprechpartner',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'adresse' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_standort.adresse',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 8,
                'eval' => 'trim'
            ]
        ],
        'rundgaenge' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_standort.rundgaenge',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_smlaufliste_domain_model_rundgang',
                'foreign_field' => 'standort',
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
        'receiver' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_standort.receiver',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'fe_users',
				'foreign_table_where' => 'AND fe_users.disable = 0 AND fe_users.deleted = 0',
                'MM' => 'tx_smlaufliste_standort_feuser_mm',
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
    
    ],
];
