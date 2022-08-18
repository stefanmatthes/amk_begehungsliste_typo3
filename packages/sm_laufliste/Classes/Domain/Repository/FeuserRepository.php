<?php
namespace Be\SmLaufliste\Domain\Repository;

/***
 *
 * This file is part of the "Laufliste" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Stefan Matthes <stefan.matthes@branding-energy.de>, Branding Energy
 *
 ***/

/**
 * The repository for Feusers
 */
class FeuserRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    public function initializeObject() {
        $querySettings = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }
}
