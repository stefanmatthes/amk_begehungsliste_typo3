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
 * The repository for Logs
 */
class LogRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * Find by Problem
     *
     * @param $problemid
     */
    public function findByProblem($problemid)
    {
        //  echo "Problem auslesen mit ".$problemid;
        $query = $this->createQuery();
        $query->matching($query->logicalAnd($query->equals('problem', $problemid), $query->equals('hidden', 0), $query->equals('deleted', 0)));
        //    $query->statement('select p.*, f.uid,f.first_name as firstName,f.last_name as lastName from tx_smlaufliste_domain_model_log p   LEFT JOIN fe_users f on f.uid = p.feuser where p.deleted=0 and p.hidden=0 and problem =' . $problemid . '');
        $result = $query->execute();
        //     krexx($result);
        //   $query->setOrderings($this->orderByField('uid', $uidArray));
        return $result;
    }
}
