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
 * Rundgang
 */
class Rundgang extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * kurztext
     *
     * @var string
     */
    protected $kurztext = '';

    /**
     * ort
     *
     * @var string
     */
    protected $ort = '';

    /**
     * images
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $images = null;

    /**
     * problems
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmBegehungsliste\Domain\Model\Problem>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $problems = null;

    /**
     * verantwortlicher
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $verantwortlicher = null;

    /**
     * teilnehmer
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $teilnehmer = null;

    /**
     * schwerpunkt
     *
     * @var \Be\SmBegehungsliste\Domain\Model\Schwerpunkt
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $schwerpunkt = null;

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
        $this->problems = $this->problems ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->teilnehmer = $this->teilnehmer ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

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
    public function setKurztext(string $kurztext)
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
    public function setOrt(string $ort)
    {
        $this->ort = $ort;
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
     * Adds a Feuser
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $teilnehmer
     * @return void
     */
    public function addTeilnehmer(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $teilnehmer)
    {
        $this->teilnehmer->attach($teilnehmer);
    }

    /**
     * Removes a Feuser
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $teilnehmerToRemove The Feuser to be removed
     * @return void
     */
    public function removeTeilnehmer(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $teilnehmerToRemove)
    {
        $this->teilnehmer->detach($teilnehmerToRemove);
    }

    /**
     * Returns the teilnehmer
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser> $teilnehmer
     */
    public function getTeilnehmer()
    {
        return $this->teilnehmer;
    }

    /**
     * Sets the teilnehmer
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser> $teilnehmer
     * @return void
     */
    public function setTeilnehmer(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $teilnehmer)
    {
        $this->teilnehmer = $teilnehmer;
    }

    /**
     * Adds a Problem
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Problem $problem
     * @return void
     */
    public function addProblem(\Be\SmBegehungsliste\Domain\Model\Problem $problem)
    {
        $this->problems->attach($problem);
    }

    /**
     * Removes a Problem
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Problem $problemToRemove The Problem to be removed
     * @return void
     */
    public function removeProblem(\Be\SmBegehungsliste\Domain\Model\Problem $problemToRemove)
    {
        $this->problems->detach($problemToRemove);
    }

    /**
     * Returns the problems
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmBegehungsliste\Domain\Model\Problem> problems
     */
    public function getProblems()
    {
        return $this->problems;
    }

    /**
     * Sets the problems
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmBegehungsliste\Domain\Model\Problem> $problems
     * @return void
     */
    public function setProblems(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $problems)
    {
        $this->problems = $problems;
    }

    /**
     * Returns the verantwortlicher
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $verantwortlicher
     */
    public function getVerantwortlicher()
    {
        return $this->verantwortlicher;
    }

    /**
     * Sets the verantwortlicher
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $verantwortlicher
     * @return void
     */
    public function setVerantwortlicher(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $verantwortlicher)
    {
        $this->verantwortlicher = $verantwortlicher;
    }

    /**
     * Returns the schwerpunkt
     *
     * @return \Be\SmBegehungsliste\Domain\Model\Schwerpunkt $schwerpunkt
     */
    public function getSchwerpunkt()
    {
        return $this->schwerpunkt;
    }

    /**
     * Sets the schwerpunkt
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Schwerpunkt $schwerpunkt
     * @return void
     */
    public function setSchwerpunkt(\Be\SmBegehungsliste\Domain\Model\Schwerpunkt $schwerpunkt)
    {
        $this->schwerpunkt = $schwerpunkt;
    }
}
