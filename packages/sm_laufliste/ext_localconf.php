<?php
defined('TYPO3_MODE') || die();

call_user_func(static function() {
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'SmLaufliste',
            'Laufliste',
            [
                \Be\SmLaufliste\Controller\ModulController::class => 'list, show, new, create, update, showstat,sendSignature',
                \Be\SmLaufliste\Controller\ProblemController::class =>  'list, edit, show, new, create, update, delete',
                \Be\SmLaufliste\Controller\LogController::class => 'create',
            ],
            // non-cacheable actions
            [

            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    laufliste {
                        iconIdentifier = sm_laufliste-plugin-laufliste
                        title = LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_sm_laufliste_laufliste.name
                        description = LLL:EXT:sm_laufliste/Resources/Private/Language/locallang_db.xlf:tx_sm_laufliste_laufliste.description
                        tt_content_defValues {
                            CType = list
                            list_type = smlaufliste_laufliste
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'sm_laufliste-plugin-laufliste',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:sm_laufliste/Resources/Public/Icons/user_plugin_laufliste.svg']
			);




}
);
