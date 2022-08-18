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
 * Rundgangaktiv
 */
class Rundgangaktiv extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * rundgang
     *
     * @var \Be\SmLaufliste\Domain\Model\Rundgang
     */
    protected $rundgang = null;

    /**
     * zeitstart
     *
     * @var int
     */
    protected $zeitstart = 0;

    /**
     * hidden
     *
     * @var int
     */
    protected $hidden = 0;

	
    /**
     * deleted
     *
     * @var int
     */
    protected $deleted = 0;

    /**
     * zeitende
     *
     * @var int
     */
    protected $zeitende = 0;



    /**
     * signature
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $signature = null;

    /**
     * messungen
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Messung>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $messungen = null;

    /**
     * schicht
     *
     * @var \Be\SmLaufliste\Domain\Model\Schicht
     */
    protected $schicht = null;

    /**
     * feuser
     *
     * @var \Be\SmLaufliste\Domain\Model\Feuser
     */
    protected $feuser = null;

    /**
     * emailprotokoll
     *
     * @var int
     */
    protected $emailprotokoll = null;

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
        $this->messungen = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }




    /**
     * Adds a Messung
     *
     * @param \Be\SmLaufliste\Domain\Model\Messung $messungen
     * @return void
     */
    public function addMessungen(\Be\SmLaufliste\Domain\Model\Messung $messungen)
    {
        $this->messungen->attach($messungen);
    }

    /**
     * Removes a Messung
     *
     * @param \Be\SmLaufliste\Domain\Model\Messung $messungenToRemove The Messung to be removed
     * @return void
     */
    public function removeMessungen(\Be\SmLaufliste\Domain\Model\Messung $messungenToRemove)
    {
        $this->messungen->detach($messungenToRemove);
    }

    /**
     * Returns the messungen
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Messung> $messungen
     */
    public function getMessungen()
    {
        return $this->messungen;
    }

    /**
     * Sets the messungen
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Messung> $messungen
     * @return void
     */
    public function setMessungen(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $messungen)
    {
        $this->messungen = $messungen;
    }

    /**
     * Returns the schicht
     *
     * @return \Be\SmLaufliste\Domain\Model\Schicht $schicht
     */
    public function getSchicht()
    {
        return $this->schicht;
    }

    /**
     * Sets the schicht
     *
     * @param \Be\SmLaufliste\Domain\Model\Schicht $schicht
     * @return void
     */
    public function setSchicht(\Be\SmLaufliste\Domain\Model\Schicht $schicht)
    {
        $this->schicht = $schicht;
    }

    /**
     * Returns the rundgang
     *
     * @return \Be\SmLaufliste\Domain\Model\Rundgang $rundgang
     */
    public function getRundgang()
    {
        return $this->rundgang;
    }

    /**
     * Sets the rundgang
     *
     * @param \Be\SmLaufliste\Domain\Model\Rundgang $rundgang
     * @return void
     */
    public function setRundgang(\Be\SmLaufliste\Domain\Model\Rundgang $rundgang)
    {
        $this->rundgang = $rundgang;
    }

    /**
     * Returns the zeitstart
     *
     * @return int $zeitstart
     */
    public function getZeitstart()
    {
        return $this->zeitstart;
    }

    /**
     * Sets the zeitstart
     *
     * @param int $zeitstart
     * @return void
     */
    public function setZeitstart(int $zeitstart)
    {
        $this->zeitstart = $zeitstart;
    }

    /**
     * Sets the hidden
     *
     * @param int $hidden
     * @return void
     */
    public function setHidden(int $hidden)
    {
        $this->hidden = $hidden;
    }
	
	
    /**
     * Sets the deleted
     *
     * @param int $deleted
     * @return void
     */
    public function setDeleted(int $deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * Returns the zeitende
     *
     * @return int $zeitende
     */
    public function getZeitende()
    {
        return $this->zeitende;
    }

    /**
     * Sets the zeitende
     *
     * @param int $zeitende
     * @return void
     */
    public function setZeitende(int $zeitende)
    {
        $this->zeitende = $zeitende;
    }

    /**
     * Returns the feuser
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feuser
     */
    public function getFeuser()
    {
        return $this->feuser;
    }

    /**
     * Sets the feuser
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feuser
     * @return void
     */
    public function setFeuser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feuser)
    {
        $this->feuser = $feuser;
    }

    /**
     * Returns the signature
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $signature
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Sets the signature
     *
     * @param \Be\SmLaufliste\Domain\Model\FileReference $signature
     * @return void
     */
    public function setSignature(\Be\SmLaufliste\Domain\Model\FileReference $signature)
    {
        $this->signature = $signature;
    }

    /**
     * Returns the emailprotokoll
     *
     * @return int $emailprotokoll
     */
    public function getEmailprotokoll()
    {
        return $this->emailprotokoll;
    }

    /**
     * Sets the emailprotokoll
     *
     * @param int $emailprotokoll
     * @return void
     */
    public function setEmailprotokoll(int $emailprotokoll)
    {
        $this->emailprotokoll = $emailprotokoll;
    }
}
