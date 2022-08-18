<?php
namespace Be\SmLaufliste\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class RundgangaktivTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Domain\Model\Rundgangaktiv
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Be\SmLaufliste\Domain\Model\Rundgangaktiv();
    }

    protected function tearDown()
    {
        parent::tearDown();
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
    public function getSignatureReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getSignature()
        );
    }

    /**
     * @test
     */
    public function setSignatureForFileReferenceSetsSignature()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setSignature($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'signature',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEmailprotokollReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getEmailprotokoll()
        );
    }

    /**
     * @test
     */
    public function setEmailprotokollForDateTimeSetsEmailprotokoll()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setEmailprotokoll($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'emailprotokoll',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getMessungenReturnsInitialValueForMessung()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getMessungen()
        );
    }

    /**
     * @test
     */
    public function setMessungenForObjectStorageContainingMessungSetsMessungen()
    {
        $messungen = new \Be\SmLaufliste\Domain\Model\Messung();
        $objectStorageHoldingExactlyOneMessungen = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneMessungen->attach($messungen);
        $this->subject->setMessungen($objectStorageHoldingExactlyOneMessungen);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneMessungen,
            'messungen',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addMessungenToObjectStorageHoldingMessungen()
    {
        $messungen = new \Be\SmLaufliste\Domain\Model\Messung();
        $messungenObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $messungenObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($messungen));
        $this->inject($this->subject, 'messungen', $messungenObjectStorageMock);

        $this->subject->addMessungen($messungen);
    }

    /**
     * @test
     */
    public function removeMessungenFromObjectStorageHoldingMessungen()
    {
        $messungen = new \Be\SmLaufliste\Domain\Model\Messung();
        $messungenObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $messungenObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($messungen));
        $this->inject($this->subject, 'messungen', $messungenObjectStorageMock);

        $this->subject->removeMessungen($messungen);
    }

    /**
     * @test
     */
    public function getSchichtReturnsInitialValueForSchicht()
    {
        self::assertEquals(
            null,
            $this->subject->getSchicht()
        );
    }

    /**
     * @test
     */
    public function setSchichtForSchichtSetsSchicht()
    {
        $schichtFixture = new \Be\SmLaufliste\Domain\Model\Schicht();
        $this->subject->setSchicht($schichtFixture);

        self::assertAttributeEquals(
            $schichtFixture,
            'schicht',
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
