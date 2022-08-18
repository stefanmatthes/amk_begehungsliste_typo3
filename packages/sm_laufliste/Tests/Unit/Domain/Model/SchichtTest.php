<?php
namespace Be\SmLaufliste\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class SchichtTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Domain\Model\Schicht
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Be\SmLaufliste\Domain\Model\Schicht();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getZeitstartReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getZeitstart()
        );
    }

    /**
     * @test
     */
    public function setZeitstartForIntSetsZeitstart()
    {
        $this->subject->setZeitstart(12);

        self::assertAttributeEquals(
            12,
            'zeitstart',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getZeitendeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getZeitende()
        );
    }

    /**
     * @test
     */
    public function setZeitendeForIntSetsZeitende()
    {
        $this->subject->setZeitende(12);

        self::assertAttributeEquals(
            12,
            'zeitende',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTageReturnsInitialValueForTag()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getTage()
        );
    }

    /**
     * @test
     */
    public function setTageForObjectStorageContainingTagSetsTage()
    {
        $tage = new \Be\SmLaufliste\Domain\Model\Tag();
        $objectStorageHoldingExactlyOneTage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneTage->attach($tage);
        $this->subject->setTage($objectStorageHoldingExactlyOneTage);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneTage,
            'tage',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addTageToObjectStorageHoldingTage()
    {
        $tage = new \Be\SmLaufliste\Domain\Model\Tag();
        $tageObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $tageObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($tage));
        $this->inject($this->subject, 'tage', $tageObjectStorageMock);

        $this->subject->addTage($tage);
    }

    /**
     * @test
     */
    public function removeTageFromObjectStorageHoldingTage()
    {
        $tage = new \Be\SmLaufliste\Domain\Model\Tag();
        $tageObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $tageObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($tage));
        $this->inject($this->subject, 'tage', $tageObjectStorageMock);

        $this->subject->removeTage($tage);
    }
}
