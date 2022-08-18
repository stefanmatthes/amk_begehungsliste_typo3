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
 * Modul
 */
class Modul extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * kks
     *
     * @var string
     */
    protected $kks = '';

    /**
     * tokenid
     *
     * @var string
     */
    protected $tokenid = 0;

    /**
     * kurztext
     *
     * @var string
     */
    protected $kurztext = '';

    /**
     * anleitung
     *
     * @var string
     */
    protected $anleitung = '';

    /**
     * ort
     *
     * @var string
     */
    protected $ort = '';

    /**
     * checkonly
     *
     * @var bool
     */
    protected $checkonly = false;

    /**
     * unit
     *
     * @var string
     */
    protected $unit = '';

    /**
     * dokumente
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $dokumente = null;

    /**
     * images
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $images = null;

    /**
     * meldung
     *
     * @var string
     */
    protected $meldung = '';

    /**
     * min
     *
     * @var float
     */
    protected $min = 0.0;

    /**
     * max
     *
     * @var float
     */
    protected $max = 0.0;

    /**
     * diff
     *
     * @var float
     */
    protected $diff = 0.0;

    /**
     * letztemessung
     *
     * @var float
     */
    protected $letztemessung = 0.0;

    /**
     * problem
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Problem>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $problem = null;

    /**
     * Returns the kurztext
     *
     * @return string $kurztext
     */
    public function getKurztext()
    {
        return $this->kurztext;
    }

    /**
     * Sets the kurztext
     *
     * @param string $kurztext
     * @return void
     */
    public function setKurztext($kurztext)
    {
        $this->kurztext = $kurztext;
    }

    /**
     * Returns the ort
     *
     * @return string $ort
     */
    public function getOrt()
    {
        return $this->ort;
    }

    /**
     * Sets the ort
     *
     * @param string $ort
     * @return void
     */
    public function setOrt($ort)
    {
        $this->ort = $ort;
    }

    /**
     * Returns the unit
     *
     * @return string $unit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Sets the unit
     *
     * @param string $unit
     * @return void
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * Returns the kks
     *
     * @return string kks
     */
    public function getKks()
    {
        return $this->kks;
    }

    /**
     * Sets the kks
     *
     * @param string $kks
     * @return void
     */
    public function setKks($kks)
    {
        $this->kks = $kks;
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
        $this->dokumente = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->images = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->problem = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a FileReference
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $dokumente
     * @return void
     */
    public function addDokumente(\TYPO3\CMS\Extbase\Domain\Model\FileReference $dokumente)
    {
        $this->dokumente->attach($dokumente);
    }

    /**
     * Removes a FileReference
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $dokumenteToRemove The FileReference to be removed
     * @return void
     */
    public function removeDokumente(\TYPO3\CMS\Extbase\Domain\Model\FileReference $dokumenteToRemove)
    {
        $this->dokumente->detach($dokumenteToRemove);
    }

    /**
     * Returns the dokumente
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $dokumente
     */
    public function getDokumente()
    {
        return $this->dokumente;
    }

    /**
     * Sets the dokumente
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $dokumente
     * @return void
     */
    public function setDokumente(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $dokumente)
    {
        $this->dokumente = $dokumente;
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
     * Returns the meldung
     *
     * @return string $meldung
     */
    public function getMeldung()
    {
        return $this->meldung;
    }

    /**
     * Sets the meldung
     *
     * @param string $meldung
     * @return void
     */
    public function setMeldung($meldung)
    {
        $this->meldung = $meldung;
    }

    /**
     * Returns the min
     *
     * @return float $min
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Sets the min
     *
     * @param float $min
     * @return void
     */
    public function setMin($min)
    {
        $this->min = $min;
    }

    /**
     * Returns the max
     *
     * @return float $max
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Sets the max
     *
     * @param float $max
     * @return void
     */
    public function setMax($max)
    {
        $this->max = $max;
    }

    /**
     * Returns the tokenid
     *
     * @return string tokenid
     */
    public function getTokenid()
    {
        return $this->tokenid;
    }

    /**
     * Sets the tokenid
     *
     * @param int $tokenid
     * @return void
     */
    public function setTokenid($tokenid)
    {
        $this->tokenid = $tokenid;
    }

    /**
     * Adds a Problem
     *
     * @param \Be\SmLaufliste\Domain\Model\Problem $problem
     * @return void
     */
    public function addProblem(\Be\SmLaufliste\Domain\Model\Problem $problem)
    {
        $this->problem->attach($problem);
    }

    /**
     * Removes a Problem
     *
     * @param \Be\SmLaufliste\Domain\Model\Problem $problemToRemove The Problem to be removed
     * @return void
     */
    public function removeProblem(\Be\SmLaufliste\Domain\Model\Problem $problemToRemove)
    {
        $this->problem->detach($problemToRemove);
    }

    /**
     * Returns the problem
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Problem> $problem
     */
    public function getProblem()
    {
        return $this->problem;
    }

    /**
     * Sets the problem
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Problem> $problem
     * @return void
     */
    public function setProblem(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $problem)
    {
        $this->problem = $problem;
    }

    /**
     * Returns the letztemessung
     *
     * @return float $letztemessung
     */
    public function getLetztemessung()
    {
        return $this->letztemessung;
    }

    /**
     * Sets the letztemessung
     *
     * @param float $letztemessung
     * @return void
     */
    public function setLetztemessung($letztemessung)
    {
        $this->letztemessung = $letztemessung;
    }

    /**
     * Returns the anleitung
     *
     * @return string $anleitung
     */
    public function getAnleitung()
    {
        return $this->anleitung;
    }

    /**
     * Sets the anleitung
     *
     * @param string $anleitung
     * @return void
     */
    public function setAnleitung($anleitung)
    {
        $this->anleitung = $anleitung;
    }

    /**
     * Returns the checkonly
     *
     * @return bool $checkonly
     */
    public function getCheckonly()
    {
        return $this->checkonly;
    }

    /**
     * Sets the checkonly
     *
     * @param bool $checkonly
     * @return void
     */
    public function setCheckonly($checkonly)
    {
        $this->checkonly = $checkonly;
    }

    /**
     * Returns the boolean state of checkonly
     *
     * @return bool
     */
    public function isCheckonly()
    {
        return $this->checkonly;
    }

    /**
     * Returns the diff
     *
     * @return float $diff
     */
    public function getDiff()
    {
        return $this->diff;
    }

    /**
     * Sets the diff
     *
     * @param float $diff
     * @return void
     */
    public function setDiff($diff)
    {
        $this->diff = $diff;
    }
}
