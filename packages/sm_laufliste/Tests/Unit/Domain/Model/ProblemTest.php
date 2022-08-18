<?php
namespace Be\SmLaufliste\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class ProblemTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Domain\Model\Problem
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Be\SmLaufliste\Domain\Model\Problem();
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
    public function getStatusReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getStatus()
        );
    }

    /**
     * @test
     */
    public function setStatusForIntSetsStatus()
    {
        $this->subject->setStatus(12);

        self::assertAttributeEquals(
            12,
            'status',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getImagesReturnsInitialValueForFileReference()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getImages()
        );
    }

    /**
     * @test
     */
    public function setImagesForFileReferenceSetsImages()
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $objectStorageHoldingExactlyOneImages = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneImages->attach($image);
        $this->subject->setImages($objectStorageHoldingExactlyOneImages);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneImages,
            'images',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addImageToObjectStorageHoldingImages()
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $imagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $imagesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($image));
        $this->inject($this->subject, 'images', $imagesObjectStorageMock);

        $this->subject->addImage($image);
    }

    /**
     * @test
     */
    public function removeImageFromObjectStorageHoldingImages()
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $imagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $imagesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($image));
        $this->inject($this->subject, 'images', $imagesObjectStorageMock);

        $this->subject->removeImage($image);
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

    /**
     * @test
     */
    public function getLogsReturnsInitialValueForLog()
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
    public function setLogsForObjectStorageContainingLogSetsLogs()
    {
        $log = new \Be\SmLaufliste\Domain\Model\Log();
        $objectStorageHoldingExactlyOneLogs = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneLogs->attach($log);
        $this->subject->setLogs($objectStorageHoldingExactlyOneLogs);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneLogs,
            'logs',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addLogToObjectStorageHoldingLogs()
    {
        $log = new \Be\SmLaufliste\Domain\Model\Log();
        $logsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $logsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($log));
        $this->inject($this->subject, 'logs', $logsObjectStorageMock);

        $this->subject->addLog($log);
    }

    /**
     * @test
     */
    public function removeLogFromObjectStorageHoldingLogs()
    {
        $log = new \Be\SmLaufliste\Domain\Model\Log();
        $logsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $logsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($log));
        $this->inject($this->subject, 'logs', $logsObjectStorageMock);

        $this->subject->removeLog($log);
    }
}
