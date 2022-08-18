<?php
namespace Be\SmLaufliste\Domain\Model;

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
 * Rundgang
 */
class Rundgang extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * standort
     *
     * @var \Be\SmLaufliste\Domain\Model\Standort
     */
    protected $standort = null;

    /**
     * laufliste
     *
     * @var \Be\SmLaufliste\Domain\Model\Laufliste
     */
    protected $laufliste = null;

    /**
     * schichten
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Schicht>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $schichten = null;

    /**
     * user
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Feuser>
     */
    protected $user = null;

    /**
     * log
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Rundgangaktiv>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $log = null;

    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the laufliste
     *
     * @return \Be\SmLaufliste\Domain\Model\Laufliste $laufliste
     */
    public function getLaufliste()
    {
        return $this->laufliste;
    }

    /**
     * Sets the laufliste
     *
     * @param \Be\SmLaufliste\Domain\Model\Laufliste $laufliste
     * @return void
     */
    public function setLaufliste(\Be\SmLaufliste\Domain\Model\Laufliste $laufliste)
    {
        $this->laufliste = $laufliste;
    }

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->schichten = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->user = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->log = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the standort
     *
     * @return \Be\SmLaufliste\Domain\Model\Standort $standort
     */
    public function getStandort()
    {
        return $this->standort;
    }

    /**
     * Sets the standort
     *
     * @param \Be\SmLaufliste\Domain\Model\Standort $standort
     * @return void
     */
    public function setStandort(\Be\SmLaufliste\Domain\Model\Standort $standort)
    {
        $this->standort = $standort;
    }

    /**
     * Adds a Schicht
     *
     * @param \Be\SmLaufliste\Domain\Model\Schicht $schichten
     * @return void
     */
    public function addSchichten(\Be\SmLaufliste\Domain\Model\Schicht $schichten)
    {
        $this->schichten->attach($schichten);
    }

    /**
     * Removes a Schicht
     *
     * @param \Be\SmLaufliste\Domain\Model\Schicht $schichtenToRemove The Schicht to be removed
     * @return void
     */
    public function removeSchichten(\Be\SmLaufliste\Domain\Model\Schicht $schichtenToRemove)
    {
        $this->schichten->detach($schichtenToRemove);
    }

    /**
     * Returns the schichten
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Schicht> $schichten
     */
    public function getSchichten()
    {
        return $this->schichten;
    }

    /**
     * Sets the schichten
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Schicht> $schichten
     * @return void
     */
    public function setSchichten(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $schichten)
    {
        $this->schichten = $schichten;
    }

    /**
     * Adds a Feuser
     *
     * @param \Be\SmLaufliste\Domain\Model\Feuser $user
     * @return void
     */
    public function addUser(\Be\SmLaufliste\Domain\Model\Feuser $user)
    {
        $this->user->attach($user);
    }

    /**
     * Removes a Feuser
     *
     * @param \Be\SmLaufliste\Domain\Model\Feuser $userToRemove The Feuser to be removed
     * @return void
     */
    public function removeUser(\Be\SmLaufliste\Domain\Model\Feuser $userToRemove)
    {
        $this->user->detach($userToRemove);
    }

    /**
     * Returns the user
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Feuser> $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Sets the user
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Feuser> $user
     * @return void
     */
    public function setUser(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $user)
    {
        $this->user = $user;
    }

    /**
     * Adds a Rundgangaktiv
     *
     * @param \Be\SmLaufliste\Domain\Model\Rundgangaktiv $log
     * @return void
     */
    public function addLog(\Be\SmLaufliste\Domain\Model\Rundgangaktiv $log)
    {
        $this->log->attach($log);
    }

    /**
     * Removes a Rundgangaktiv
     *
     * @param \Be\SmLaufliste\Domain\Model\Rundgangaktiv $logToRemove The Rundgangaktiv to be removed
     * @return void
     */
    public function removeLog(\Be\SmLaufliste\Domain\Model\Rundgangaktiv $logToRemove)
    {
        $this->log->detach($logToRemove);
    }

    /**
     * Returns the log
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Rundgangaktiv> $log
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * Sets the log
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Rundgangaktiv> $log
     * @return void
     */
    public function setLog(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $log)
    {
        $this->log = $log;
    }
}
