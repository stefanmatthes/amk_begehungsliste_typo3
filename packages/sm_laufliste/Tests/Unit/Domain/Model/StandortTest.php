<?php
namespace Be\SmLaufliste\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class StandortTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Domain\Model\Standort
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Be\SmLaufliste\Domain\Model\Standort();
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
    public function getAnsprechpartnerReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAnsprechpartner()
        );
    }

    /**
     * @test
     */
    public function setAnsprechpartnerForStringSetsAnsprechpartner()
    {
        $this->subject->setAnsprechpartner('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'ansprechpartner',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAdresseReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAdresse()
        );
    }

    /**
     * @test
     */
    public function setAdresseForStringSetsAdresse()
    {
        $this->subject->setAdresse('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'adresse',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getRundgaengeReturnsInitialValueForRundgang()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getRundgaenge()
        );
    }

    /**
     * @test
     */
    public function setRundgaengeForObjectStorageContainingRundgangSetsRundgaenge()
    {
        $rundgaenge = new \Be\SmLaufliste\Domain\Model\Rundgang();
        $objectStorageHoldingExactlyOneRundgaenge = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneRundgaenge->attach($rundgaenge);
        $this->subject->setRundgaenge($objectStorageHoldingExactlyOneRundgaenge);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneRundgaenge,
            'rundgaenge',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addRundgaengeToObjectStorageHoldingRundgaenge()
    {
        $rundgaenge = new \Be\SmLaufliste\Domain\Model\Rundgang();
        $rundgaengeObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundgaengeObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($rundgaenge));
        $this->inject($this->subject, 'rundgaenge', $rundgaengeObjectStorageMock);

        $this->subject->addRundgaenge($rundgaenge);
    }

    /**
     * @test
     */
    public function removeRundgaengeFromObjectStorageHoldingRundgaenge()
    {
        $rundgaenge = new \Be\SmLaufliste\Domain\Model\Rundgang();
        $rundgaengeObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundgaengeObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($rundgaenge));
        $this->inject($this->subject, 'rundgaenge', $rundgaengeObjectStorageMock);

        $this->subject->removeRundgaenge($rundgaenge);
    }

    /**
     * @test
     */
    public function getReceiverReturnsInitialValueForFeuser()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getReceiver()
        );
    }

    /**
     * @test
     */
    public function setReceiverForObjectStorageContainingFeuserSetsReceiver()
    {
        $receiver = new \Be\SmLaufliste\Domain\Model\Feuser();
        $objectStorageHoldingExactlyOneReceiver = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneReceiver->attach($receiver);
        $this->subject->setReceiver($objectStorageHoldingExactlyOneReceiver);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneReceiver,
            'receiver',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addReceiverToObjectStorageHoldingReceiver()
    {
        $receiver = new \Be\SmLaufliste\Domain\Model\Feuser();
        $receiverObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $receiverObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($receiver));
        $this->inject($this->subject, 'receiver', $receiverObjectStorageMock);

        $this->subject->addReceiver($receiver);
    }

    /**
     * @test
     */
    public function removeReceiverFromObjectStorageHoldingReceiver()
    {
        $receiver = new \Be\SmLaufliste\Domain\Model\Feuser();
        $receiverObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $receiverObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($receiver));
        $this->inject($this->subject, 'receiver', $receiverObjectStorageMock);

        $this->subject->removeReceiver($receiver);
    }
}
