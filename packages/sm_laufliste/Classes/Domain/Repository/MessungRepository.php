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
 * The repository for Messungs
 */
class MessungRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * Find by TokeID
     *
     * @param $modulid
     * @param $aktiver_rundgang_id
     */
    public function findLetzteMessungModul($modulid, $aktiver_rundgang_id = NULL)
    {
        //    echo "Modul auslesen mit TokenID: ".$tokenid;
        $query = $this->createQuery();
        if ($aktiver_rundgang_id) {
            $query->matching($query->logicalAnd($query->equals('module', $modulid), $query->equals('rundgangaktiv', $aktiver_rundgang_id), $query->equals('hidden', 0), $query->equals('deleted', 0)));
        } else {
            $query->matching($query->logicalAnd($query->equals('module', $modulid), $query->equals('hidden', 0), $query->equals('deleted', 0)));
        }
        $query->setOrderings([
            'crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
        ]);
        $query->setLimit(1);
        //   $query->setOrderings($this->orderByField('uid', $uidArray));
        //  return $query->execute(true)[0]['value'];
        return $query->execute(true)[0];
    }

    /**
     * Find by TokeID
     *
     * @param $modulid
     * @param $aktiver_rundgang_id
     */
    public function findLetzteMessungenModul($modulid, $aktiver_rundgang_id = NULL)
    {
        //    echo "Modul auslesen mit TokenID: ".$tokenid;
        $query = $this->createQuery();
        $query->matching(
			$query->logicalAnd(
				$query->equals('module', $modulid), 
		//		$query->equals('rundgangaktiv', $aktiver_rundgang_id), 
				$query->equals('hidden', 0), 
				$query->equals('deleted', 0)
				)
		);
        $query->setOrderings([
            'crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
        ]);
        //  $query->setLimit(2);
        //   $query->setOrderings($this->orderByField('uid', $uidArray));
        //  return $query->execute(true)[0]['value'];
        return $query->execute(true);
    }
}
