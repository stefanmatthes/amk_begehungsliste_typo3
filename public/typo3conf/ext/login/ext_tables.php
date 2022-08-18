<?php
defined('TYPO3') or die();

$boot = function () {
    //$GLOBALS['TYPO3_CONF_VARS']['FE']['checkFeUserPid'] = false;
};

$boot();
unset($boot);