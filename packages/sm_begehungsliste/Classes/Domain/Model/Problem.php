<?php

declare(strict_types=1);

namespace Be\SmBegehungsliste\Domain\Model;


/**
 * This file is part of the "Begehungsliste" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Stefan Matthes <stefan.matthes@branding-energy.de>, Branding Energy
 */

/**
 * Problem
 */
class Problem extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * @var \DateTime
     */
    protected $crdate = null;

    /**
     * text
     *
     * @var string
     */
    protected $text = '';

    /**
     * status
     *
     * @var int
     */
    protected $status = 0;

    /**
     * images
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $images = null;

    /**
     * termin
     *
     * @var string
     */
    protected $termin = null;

    /**
     * feuser
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $feuser = null;

    /**
     * logs
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmBegehungsliste\Domain\Model\Log>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $logs = null;

    /**
     * massnahme
     *
     * @var \Be\SmBegehungsliste\Domain\Model\Massnahme
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $massnahme = null;

    /**
     * bereich
     *
     * @var \Be\SmBegehungsliste\Domain\Model\Bereich
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $bereich = null;

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->images = $this->images ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->logs = $this->logs ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Get Crdate
     *
     * @return Crdate
     */
    public function getCrdate()
    {
        return $this->crdate;
    }

    /**
     * Returns the text
     *
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text
     *
     * @param string $text
     * @return void
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * Returns the status
     *
     * @return int $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status
     *
     * @param int $status
     * @return void
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * Adds a FileReference
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function addImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->images->attach($image);
    }

    /**
     * Removes a FileReference
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove The FileReference to be removed
     * @return void
     */
    public function removeImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove)
    {
        $this->images->detach($imageToRemove);
    }

    /**
     * Returns the images
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Sets the images
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
     * @return void
     */
    public function setImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images)
    {
        $this->images = $images;
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
     * Adds a Log
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Log $log
     * @return void
     */
    public function addLog(\Be\SmBegehungsliste\Domain\Model\Log $log)
    {
        $this->logs->attach($log);
    }

    /**
     * Removes a Log
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Log $logToRemove The Log to be removed
     * @return void
     */
    public function removeLog(\Be\SmBegehungsliste\Domain\Model\Log $logToRemove)
    {
        $this->logs->detach($logToRemove);
    }

    /**
     * Returns the logs
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmBegehungsliste\Domain\Model\Log> $logs
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * Sets the logs
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmBegehungsliste\Domain\Model\Log> $logs
     * @return void
     */
    public function setLogs(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $logs)
    {
        $this->logs = $logs;
    }

    /**
     * Returns the termin
     *
     * @return \DateTime $termin
     */
    public function getTermin()
    {
        return $this->termin;
    }

    /**
     * Sets the termin
     *
     * @param string $termin
     * @return void
     */
    public function setTermin(string $termin)
    {
        $this->termin = $termin;
    }

    /**
     * Returns the massnahme
     *
     * @return \Be\SmBegehungsliste\Domain\Model\Massnahme $massnahme
     */
    public function getMassnahme()
    {
        return $this->massnahme;
    }

    /**
     * Sets the massnahme
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Massnahme $massnahme
     * @return void
     */
    public function setMassnahme(\Be\SmBegehungsliste\Domain\Model\Massnahme $massnahme)
    {
        $this->massnahme = $massnahme;
    }

    /**
     * Returns the bereich
     *
     * @return \Be\SmBegehungsliste\Domain\Model\Bereich $bereich
     */
    public function getBereich()
    {
        return $this->bereich;
    }

    /**
     * Sets the bereich
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Bereich $bereich
     * @return void
     */
    public function setBereich(\Be\SmBegehungsliste\Domain\Model\Bereich $bereich)
    {
        $this->bereich = $bereich;
    }
}
