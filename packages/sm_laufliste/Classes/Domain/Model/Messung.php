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
 * Messung
 */
class Messung extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * module
     *
     * @var \Be\SmLaufliste\Domain\Model\Rundgangaktiv
     */
    protected $rundgangaktiv = null;

    /**
     * @var \DateTime
     */
    protected $crdate = null;

    /**
     * value
     *
     * @var string
     */
    protected $value = '';

    /**
     * module
     *
     * @var \Be\SmLaufliste\Domain\Model\Modul
     */
    protected $module = null;

    /**
     * feuser
     *
     * @var \Be\SmLaufliste\Domain\Model\Feuser
     */
    protected $feuser = null;

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
     * Returns the value
     *
     * @return string $value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value
     *
     * @param string $value
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Returns the module
     *
     * @return \Be\SmLaufliste\Domain\Model\Modul $module
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Sets the module
     *
     * @param \Be\SmLaufliste\Domain\Model\Modul $module
     * @return void
     */
    public function setModule(\Be\SmLaufliste\Domain\Model\Modul $module)
    {
        $this->module = $module;
    }

    /**
     * Returns the rundgangaktiv
     *
     * @return \Be\SmLaufliste\Domain\Model\Rundgangaktiv $rundgangaktiv
     */
    public function getRundgangaktiv()
    {
        return $this->rundgangaktiv;
    }

    /**
     * Sets the module
     *
     * @param string $rundgangaktiv
     * @return void
     */
    public function setRundgangaktiv($rundgangaktiv)
    {
        $this->rundgangaktiv = $rundgangaktiv;
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
}
