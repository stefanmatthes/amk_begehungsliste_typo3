<?php

declare(strict_types=1);

namespace Be\SmBegehungsliste\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class LogTest extends UnitTestCase
{
    /**
     * @var \Be\SmBegehungsliste\Domain\Model\Log|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Be\SmBegehungsliste\Domain\Model\Log::class,
            ['dummy']
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTextReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getText()
        );
    }

    /**
     * @test
     */
    public function setTextForStringSetsText(): void
    {
        $this->subject->setText('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('text'));
    }

    /**
     * @test
     */
    public function getTypeReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getType()
        );
    }

    /**
     * @test
     */
    public function setTypeForStringSetsType(): void
    {
        $this->subject->setType('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('type'));
    }

    /**
     * @test
     */
    public function getFeuserReturnsInitialValueForFeuser(): void
    {
        self::assertEquals(
            null,
            $this->subject->getFeuser()
        );
    }

    /**
     * @test
     */
    public function setFeuserForFeuserSetsFeuser(): void
    {
        $feuserFixture = new \Be\SmBegehungsliste\Domain\Model\Feuser();
        $this->subject->setFeuser($feuserFixture);

        self::assertEquals($feuserFixture, $this->subject->_get('feuser'));
    }
}
