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
class ProblemTest extends UnitTestCase
{
    /**
     * @var \Be\SmBegehungsliste\Domain\Model\Problem|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Be\SmBegehungsliste\Domain\Model\Problem::class,
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
    public function getStatusReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getStatus()
        );
    }

    /**
     * @test
     */
    public function setStatusForIntSetsStatus(): void
    {
        $this->subject->setStatus(12);

        self::assertEquals(12, $this->subject->_get('status'));
    }

    /**
     * @test
     */
    public function getImagesReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getImages()
        );
    }

    /**
     * @test
     */
    public function setImagesForStringSetsImages(): void
    {
        $this->subject->setImages('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('images'));
    }

    /**
     * @test
     */
    public function getTerminReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTermin()
        );
    }

    /**
     * @test
     */
    public function setTerminForStringSetsTermin(): void
    {
        $this->subject->setTermin('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('termin'));
    }

    /**
     * @test
     */
    public function getNeueinhalteReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getNeueinhalte()
        );
    }

    /**
     * @test
     */
    public function setNeueinhalteForStringSetsNeueinhalte(): void
    {
        $this->subject->setNeueinhalte('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('neueinhalte'));
    }

    /**
     * @test
     */
    public function getImageReturnsInitialValueForFileReference(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getImage()
        );
    }

    /**
     * @test
     */
    public function setImageForFileReferenceSetsImage(): void
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $objectStorageHoldingExactlyOneImage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneImage->attach($image);
        $this->subject->setImage($objectStorageHoldingExactlyOneImage);

        self::assertEquals($objectStorageHoldingExactlyOneImage, $this->subject->_get('image'));
    }

    /**
     * @test
     */
    public function addImageToObjectStorageHoldingImage(): void
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $imageObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $imageObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($image));
        $this->subject->_set('image', $imageObjectStorageMock);

        $this->subject->addImage($image);
    }

    /**
     * @test
     */
    public function removeImageFromObjectStorageHoldingImage(): void
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $imageObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $imageObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($image));
        $this->subject->_set('image', $imageObjectStorageMock);

        $this->subject->removeImage($image);
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

    /**
     * @test
     */
    public function getLogsReturnsInitialValueForLog(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getLogs()
        );
    }

    /**
     * @test
     */
    public function setLogsForObjectStorageContainingLogSetsLogs(): void
    {
        $log = new \Be\SmBegehungsliste\Domain\Model\Log();
        $objectStorageHoldingExactlyOneLogs = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneLogs->attach($log);
        $this->subject->setLogs($objectStorageHoldingExactlyOneLogs);

        self::assertEquals($objectStorageHoldingExactlyOneLogs, $this->subject->_get('logs'));
    }

    /**
     * @test
     */
    public function addLogToObjectStorageHoldingLogs(): void
    {
        $log = new \Be\SmBegehungsliste\Domain\Model\Log();
        $logsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $logsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($log));
        $this->subject->_set('logs', $logsObjectStorageMock);

        $this->subject->addLog($log);
    }

    /**
     * @test
     */
    public function removeLogFromObjectStorageHoldingLogs(): void
    {
        $log = new \Be\SmBegehungsliste\Domain\Model\Log();
        $logsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $logsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($log));
        $this->subject->_set('logs', $logsObjectStorageMock);

        $this->subject->removeLog($log);
    }

    /**
     * @test
     */
    public function getMassnahmeReturnsInitialValueForMassnahme(): void
    {
        self::assertEquals(
            null,
            $this->subject->getMassnahme()
        );
    }

    /**
     * @test
     */
    public function setMassnahmeForMassnahmeSetsMassnahme(): void
    {
        $massnahmeFixture = new \Be\SmBegehungsliste\Domain\Model\Massnahme();
        $this->subject->setMassnahme($massnahmeFixture);

        self::assertEquals($massnahmeFixture, $this->subject->_get('massnahme'));
    }

    /**
     * @test
     */
    public function getBereichReturnsInitialValueForBereich(): void
    {
        self::assertEquals(
            null,
            $this->subject->getBereich()
        );
    }

    /**
     * @test
     */
    public function setBereichForBereichSetsBereich(): void
    {
        $bereichFixture = new \Be\SmBegehungsliste\Domain\Model\Bereich();
        $this->subject->setBereich($bereichFixture);

        self::assertEquals($bereichFixture, $this->subject->_get('bereich'));
    }
}
