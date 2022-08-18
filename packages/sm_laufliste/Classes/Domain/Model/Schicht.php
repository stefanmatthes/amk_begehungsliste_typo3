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
 * Schicht
 */
class Schicht extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * zeitstart
     *
     * @var int
     */
    protected $zeitstart = 0;

    /**
     * zeitende
     *
     * @var int
     */
    protected $zeitende = '';

    /**
     * tage
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Tag>
     */
    protected $tage = null;

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
     * Returns the zeitende
     *
     * @return int zeitende
     */
    public function getZeitende()
    {
        return $this->zeitende;
    }

    /**
     * Sets the zeitende
     *
     * @param string $zeitende
     * @return void
     */
    public function setZeitende($zeitende)
    {
        $this->zeitende = $zeitende;
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
        $this->tage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Tag
     *
     * @param \Be\SmLaufliste\Domain\Model\Tag $tage
     * @return void
     */
    public function addTage(\Be\SmLaufliste\Domain\Model\Tag $tage)
    {
        $this->tage->attach($tage);
    }

    /**
     * Removes a Tag
     *
     * @param \Be\SmLaufliste\Domain\Model\Tag $tageToRemove The Tag to be removed
     * @return void
     */
    public function removeTage(\Be\SmLaufliste\Domain\Model\Tag $tageToRemove)
    {
        $this->tage->detach($tageToRemove);
    }

    /**
     * Returns the tage
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Tag> $tage
     */
    public function getTage()
    {
        return $this->tage;
    }

    /**
     * Sets the tage
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Tag> $tage
     * @return void
     */
    public function setTage(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $tage)
    {
        $this->tage = $tage;
    }
}
