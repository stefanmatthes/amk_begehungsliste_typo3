<?php
namespace Be\SmLaufliste\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class MessungTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Domain\Model\Messung
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Be\SmLaufliste\Domain\Model\Messung();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getValueReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getValue()
        );
    }

    /**
     * @test
     */
    public function setValueForStringSetsValue()
    {
        $this->subject->setValue('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'value',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getModuleReturnsInitialValueForModul()
    {
        self::assertEquals(
            null,
            $this->subject->getModule()
        );
    }

    /**
     * @test
     */
    public function setModuleForModulSetsModule()
    {
        $moduleFixture = new \Be\SmLaufliste\Domain\Model\Modul();
        $this->subject->setModule($moduleFixture);

        self::assertAttributeEquals(
            $moduleFixture,
            'module',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFeuserReturnsInitialValueForFeuser()
    {
        self::assertEquals(
            null,
            $this->subject->getFeuser()
        );
    }

    /**
     * @test
     */
    public function setFeuserForFeuserSetsFeuser()
    {
        $feuserFixture = new \Be\SmLaufliste\Domain\Model\Feuser();
        $this->subject->setFeuser($feuserFixture);

        self::assertAttributeEquals(
            $feuserFixture,
            'feuser',
            $this->subject
        );
    }
}
