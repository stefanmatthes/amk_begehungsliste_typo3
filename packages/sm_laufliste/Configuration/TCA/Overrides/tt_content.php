<?php
defined('TYPO3') or die('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'SmLaufliste',
    'Laufliste',
    'Laufliste'
);
$pluginSignature = str_replace('_', '', 'sm_laufliste') . '_laufliste';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:sm_laufliste/Configuration/FlexForms/flexform_laufliste.xml');

