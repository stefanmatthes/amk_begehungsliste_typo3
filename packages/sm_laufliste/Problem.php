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
 * Problem
 */
class Problem extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var DateTime
     */
    protected $crdate = null;

    /**
     * modul
     *
     * @var \Be\SmLaufliste\Domain\Model\Modul
     */
    protected $modul = null;

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
     * @cascade remove
     */
    protected $images = null;

    /**
     * feuser
     *
     * @var \Be\SmLaufliste\Domain\Model\Feuser
     */
    protected $feuser = null;

    /**
     * logs
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Log>
     * @cascade remove
     */
    protected $logs = null;

    /**
     * Sets the modul
     *
     * @param string $modul
     * @return void
     */
    public function setModul($modul)
    {
        $this->modul = $modul;
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
    public function setText($text)
    {
        $this->text = $text;
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
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     * @return void
     */
    public function setFeuser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feuser)
    {
        $this->feuser = $feuser;
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
    public function setStatus($status)
    {
        $this->status = $status;
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
        $this->images = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->logs = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a FileReference
     *
     * @param \Be\SmLaufliste\Domain\Model\FileReference $image
     * @return void
     */
    public function addImage(\Be\SmLaufliste\Domain\Model\FileReference $image)
    {
        $this->images->attach($image);
    }

    /**
     * Removes a FileReference
     *
     * @param \Be\SmLaufliste\Domain\Model\FileReference $imageToRemove
     * @return void
     */
    public function removeImage(\Be\SmLaufliste\Domain\Model\FileReference $imageToRemove)
    {
        $this->images->detach($imageToRemove);
    }

    /**
     * Returns the images
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\FileReference> $images
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
     * Adds a Log
     *
     * @param \Be\SmLaufliste\Domain\Model\Log $log
     * @return void
     */
    public function addLog(\Be\SmLaufliste\Domain\Model\Log $log)
    {
        $this->logs->attach($log);
    }

    /**
     * Removes a Log
     *
     * @param \Be\SmLaufliste\Domain\Model\Log $logToRemove The Log to be removed
     * @return void
     */
    public function removeLog(\Be\SmLaufliste\Domain\Model\Log $logToRemove)
    {
        $this->logs->detach($logToRemove);
    }

    /**
     * Returns the logs
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Log> $logs
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * Sets the logs
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Log> $logs
     * @return void
     */
    public function setLogs(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $logs)
    {
        $this->logs = $logs;
    }
}
