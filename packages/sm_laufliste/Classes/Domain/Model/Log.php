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
 * Log
 */
class Log extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var \DateTime
     */
    protected $crdate = null;

    /**
     * problem
     *
     * @var int
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $problem = null;

    /**
     * text
     *
     * @var string
     */
    protected $text = '';

    /**
     * type
     *
     * @var string
     */
    protected $type = '';

    /**
     * feuser
     *
     * @var \Be\SmLaufliste\Domain\Model\Feuser
     */
    protected $feuser = null;

    /**
     * Sets the text
     *
     * @param int $problem
     * @return void
     */
    public function setProblem($problem)
    {	
        $this->problem = $problem;
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
     * @return string text
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
     * Returns the type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type
     *
     * @param string $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
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
