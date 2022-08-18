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
 * Laufliste
 */
class Laufliste extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * text
     *
     * @var string
     */
    protected $text = '';

    /**
     * module
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Modul>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $module = null;

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
        $this->module = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

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
     * Adds a Modul
     *
     * @param \Be\SmLaufliste\Domain\Model\Modul $module
     * @return void
     */
    public function addModule(\Be\SmLaufliste\Domain\Model\Modul $module)
    {
        $this->module->attach($module);
    }

    /**
     * Removes a Modul
     *
     * @param \Be\SmLaufliste\Domain\Model\Modul $moduleToRemove The Modul to be removed
     * @return void
     */
    public function removeModule(\Be\SmLaufliste\Domain\Model\Modul $moduleToRemove)
    {
        $this->module->detach($moduleToRemove);
    }

    /**
     * Returns the module
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Modul> $module
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Sets the module
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Be\SmLaufliste\Domain\Model\Modul> $module
     * @return void
     */
    public function setModule(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $module)
    {
        $this->module = $module;
    }
}
