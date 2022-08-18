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
 * Standort
 */
class Standort extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * ansprechpartner
     *
     * @var string
     */
    protected $ansprechpartner = '';

    /**
     * adresse
     *
     * @var string
     */
    protected $adresse = '';

    /**
     * rundgaenge
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Rundgang>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $rundgaenge = null;

    /**
     * receiver
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Feuser>
     */
    protected $receiver = null;

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
     * Returns the ansprechpartner
     *
     * @return string $ansprechpartner
     */
    public function getAnsprechpartner()
    {
        return $this->ansprechpartner;
    }

    /**
     * Sets the ansprechpartner
     *
     * @param string $ansprechpartner
     * @return void
     */
    public function setAnsprechpartner($ansprechpartner)
    {
        $this->ansprechpartner = $ansprechpartner;
    }

    /**
     * Returns the adresse
     *
     * @return string $adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Sets the adresse
     *
     * @param string $adresse
     * @return void
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
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
        $this->rundgaenge = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->receiver = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Rundgang
     *
     * @param \Be\SmLaufliste\Domain\Model\Rundgang $rundgaenge
     * @return void
     */
    public function addRundgaenge(\Be\SmLaufliste\Domain\Model\Rundgang $rundgaenge)
    {
        $this->rundgaenge->attach($rundgaenge);
    }

    /**
     * Removes a Rundgang
     *
     * @param \Be\SmLaufliste\Domain\Model\Rundgang $rundgaengeToRemove The Rundgang to be removed
     * @return void
     */
    public function removeRundgaenge(\Be\SmLaufliste\Domain\Model\Rundgang $rundgaengeToRemove)
    {
        $this->rundgaenge->detach($rundgaengeToRemove);
    }

    /**
     * Returns the rundgaenge
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Rundgang> $rundgaenge
     */
    public function getRundgaenge()
    {
        return $this->rundgaenge;
    }

    /**
     * Sets the rundgaenge
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Rundgang> $rundgaenge
     * @return void
     */
    public function setRundgaenge(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $rundgaenge)
    {
        $this->rundgaenge = $rundgaenge;
    }

    /**
     * Adds a Feuser
     *
     * @param \Be\SmLaufliste\Domain\Model\Feuser $receiver
     * @return void
     */
    public function addReceiver(\Be\SmLaufliste\Domain\Model\Feuser $receiver)
    {
        $this->receiver->attach($receiver);
    }

    /**
     * Removes a Feuser
     *
     * @param \Be\SmLaufliste\Domain\Model\Feuser $receiverToRemove The Feuser to be removed
     * @return void
     */
    public function removeReceiver(\Be\SmLaufliste\Domain\Model\Feuser $receiverToRemove)
    {
        $this->receiver->detach($receiverToRemove);
    }

    /**
     * Returns the receiver
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Feuser> $receiver
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Sets the receiver
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Feuser> $receiver
     * @return void
     */
    public function setReceiver(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $receiver)
    {
        $this->receiver = $receiver;
    }
}
