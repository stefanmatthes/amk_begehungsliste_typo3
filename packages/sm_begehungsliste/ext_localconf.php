<?php
defined('TYPO3_MODE') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'SmBegehungsliste',
        'Begehungsliste',
        [
            \Be\SmBegehungsliste\Controller\RundgangController::class => 'list, show, new, create, update',
            \Be\SmBegehungsliste\Controller\ProblemController::class => 'list, edit, show, new, create, update, delete'
        ],
        // non-cacheable actions
        [
            \Be\SmBegehungsliste\Controller\RundgangController::class => 'create, update, delete, ',
            \Be\SmBegehungsliste\Controller\ProblemController::class => 'create, update, delete',
            \Be\SmBegehungsliste\Controller\SchwerpunktController::class => 'create, update, delete',
            \Be\SmBegehungsliste\Controller\MassnahmeController::class => 'create, update, delete',
            \Be\SmBegehungsliste\Controller\BereichController::class => 'create, update, delete'
        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    begehungsliste {
                        iconIdentifier = sm_begehungsliste-plugin-begehungsliste
                        title = LLL:EXT:sm_begehungsliste/Resources/Private/Language/locallang_db.xlf:tx_sm_begehungsliste_begehungsliste.name
                        description = LLL:EXT:sm_begehungsliste/Resources/Private/Language/locallang_db.xlf:tx_sm_begehungsliste_begehungsliste.description
                        tt_content_defValues {
                            CType = list
                            list_type = smbegehungsliste_begehungsliste
                        }
                    }
                }
                show = *
            }
       }'
    );

    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    $iconRegistry->registerIcon(
        'sm_begehungsliste-plugin-begehungsliste',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:sm_begehungsliste/Resources/Public/Icons/user_plugin_begehungsliste.svg']
    );
})();
