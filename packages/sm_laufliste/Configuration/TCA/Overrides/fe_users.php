<?php
defined('TYPO3_MODE') || die();

if (!isset($GLOBALS['TCA']['fe_users']['ctrl']['type'])) {
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumnstx_smlaufliste_fe_users = [];
    $tempColumnstx_smlaufliste_fe_users[$GLOBALS['TCA']['fe_users']['ctrl']['type']] = [
        'exclude' => true,
        'label'   => 'LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste.tx_extbase_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['',''],
                ['Feuser','Tx_SmLaufliste_Feuser']
            ],
            'default' => 'Tx_SmLaufliste_Feuser',
            'size' => 1,
            'maxitems' => 1,
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tempColumnstx_smlaufliste_fe_users);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    $GLOBALS['TCA']['fe_users']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['fe_users']['ctrl']['label']
);

/* inherit and extend the show items from the parent class */

if (isset($GLOBALS['TCA']['fe_users']['types']['0']['showitem'])) {
    $GLOBALS['TCA']['fe_users']['types']['Tx_SmLaufliste_Feuser']['showitem'] = $GLOBALS['TCA']['fe_users']['types']['0']['showitem'];
} elseif(is_array($GLOBALS['TCA']['fe_users']['types'])) {
    // use first entry in types array
    $fe_users_type_definition = reset($GLOBALS['TCA']['fe_users']['types']);
    $GLOBALS['TCA']['fe_users']['types']['Tx_SmLaufliste_Feuser']['showitem'] = $fe_users_type_definition['showitem'];
} else {
    $GLOBALS['TCA']['fe_users']['types']['Tx_SmLaufliste_Feuser']['showitem'] = '';
}
$GLOBALS['TCA']['fe_users']['types']['Tx_SmLaufliste_Feuser']['showitem'] .= ',--div--;LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_smlaufliste_domain_model_feuser,';
$GLOBALS['TCA']['fe_users']['types']['Tx_SmLaufliste_Feuser']['showitem'] .= '';

$GLOBALS['TCA']['fe_users']['columns'][$GLOBALS['TCA']['fe_users']['ctrl']['type']]['config']['items'][] = ['LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type.Tx_SmLaufliste_Feuser','Tx_SmLaufliste_Feuser'];
