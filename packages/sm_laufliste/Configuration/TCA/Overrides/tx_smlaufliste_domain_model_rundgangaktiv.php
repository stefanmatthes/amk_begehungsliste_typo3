<?php

use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
$GLOBALS['TCA']['tx_smlaufliste_domain_model_rundgangaktiv']['columns']['signature']['config']=
    ExtensionManagementUtility::getFileFieldTCAConfig('images',
[
'foreign_match_fields' => [
    'fieldname' => 'signature',
    'tablenames' => 'tx_smlaufliste_domain_model_rundgangaktiv',
    'table_local' => 'sys_file',
]
]
);
