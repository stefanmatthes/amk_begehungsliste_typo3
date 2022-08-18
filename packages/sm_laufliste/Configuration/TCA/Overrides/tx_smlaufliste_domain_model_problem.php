<?php

use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
$GLOBALS['TCA']['tx_smlaufliste_domain_model_problem']['columns']['images']['config']=
    ExtensionManagementUtility::getFileFieldTCAConfig('images',
[
'foreign_match_fields' => [
    'fieldname' => 'images',
    'tablenames' => 'tx_smlaufliste_domain_model_problem',
    'table_local' => 'sys_file',
]
]
);
