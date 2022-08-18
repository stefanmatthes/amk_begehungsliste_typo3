<?php
namespace Be\SmLaufliste\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class LogTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Domain\Model\Log
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Be\SmLaufliste\Domain\Model\Log();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTextReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getText()
        );
    }

    /**
     * @test
     */
    public function setTextForStringSetsText()
    {
        $this->subject->setText('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'text',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTypeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getType()
        );
    }

    /**
     * @test
     */
    public function setTypeForStringSetsType()
    {
        $this->subject->setType('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'type',
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
