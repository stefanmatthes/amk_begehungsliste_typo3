<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgangaktiv',
        'label' => 'zeitstart',
        'tstamp' => 'tstamp',
        'default_sortby' => 'ORDER BY zeitstart DESC',
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
        'searchFields' => 'zeitstart,zeitende,signature,emailprotokoll,messungen,schicht,feuser',
        'iconfile' => 'EXT:sm_laufliste/Resources/Public/Icons/tx_smlaufliste_domain_model_rundgangaktiv.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'zeitstart, zeitende, signature, emailprotokoll',
    ],
    'types' => [
        '1' => ['showitem' => 'zeitstart, zeitende, emailprotokoll'],
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
                'foreign_table' => 'tx_smlaufliste_domain_model_rundgangaktiv',
                'foreign_table_where' => 'AND tx_smlaufliste_domain_model_rundgangaktiv.pid=###CURRENT_PID### AND tx_smlaufliste_domain_model_rundgangaktiv.sys_language_uid IN (-1,0)',
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

        'zeitstart' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgangaktiv.zeitstart',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 4,
                'eval' => 'datetime',
                'default' => time()
            ]
        ],
        'zeitende' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgangaktiv.zeitende',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 4,
                'eval' => 'datetime',
                'default' => time()
            ]
        ],
        'signature' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgangaktiv.signature',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'signature',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'foreign_types' => [
                        '0' => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ]
                    ],
                    'maxitems' => 1
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
        'emailprotokoll' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgangaktiv.emailprotokoll',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 10,
                'eval' => 'datetime',
                'default' => time()
            ],
        ],
        'messungen' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgangaktiv.messungen',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_smlaufliste_domain_model_messung',
                'foreign_field' => 'rundgangaktiv',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],

        ],
        'schicht' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgangaktiv.schicht',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_smlaufliste_domain_model_schicht',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'feuser' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_rundgangaktiv.feuser',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],

        'rundgang' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
	   'deleted' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
