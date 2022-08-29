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
class RundganTest extends UnitTestCase
{
    /**
     * @var \Be\SmBegehungsliste\Domain\Model\Rundgan|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Be\SmBegehungsliste\Domain\Model\Rundgan::class,
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
    public function getKurztextReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getKurztext()
        );
    }

    /**
     * @test
     */
    public function setKurztextForStringSetsKurztext(): void
    {
        $this->subject->setKurztext('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('kurztext'));
    }

    /**
     * @test
     */
    public function getAnleitungReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getAnleitung()
        );
    }

    /**
     * @test
     */
    public function setAnleitungForStringSetsAnleitung(): void
    {
        $this->subject->setAnleitung('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('anleitung'));
    }

    /**
     * @test
     */
    public function getOrtReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getOrt()
        );
    }

    /**
     * @test
     */
    public function setOrtForStringSetsOrt(): void
    {
        $this->subject->setOrt('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('ort'));
    }

    /**
     * @test
     */
    public function getImagesReturnsInitialValueForFileReference(): void
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
    public function setImagesForFileReferenceSetsImages(): void
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $objectStorageHoldingExactlyOneImages = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneImages->attach($image);
        $this->subject->setImages($objectStorageHoldingExactlyOneImages);

        self::assertEquals($objectStorageHoldingExactlyOneImages, $this->subject->_get('images'));
    }

    /**
     * @test
     */
    public function addImageToObjectStorageHoldingImages(): void
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $imagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $imagesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($image));
        $this->subject->_set('images', $imagesObjectStorageMock);

        $this->subject->addImage($image);
    }

    /**
     * @test
     */
    public function removeImageFromObjectStorageHoldingImages(): void
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $imagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $imagesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($image));
        $this->subject->_set('images', $imagesObjectStorageMock);

        $this->subject->removeImage($image);
    }

    /**
     * @test
     */
    public function getProblemReturnsInitialValueForProblem(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getProblem()
        );
    }

    /**
     * @test
     */
    public function setProblemForObjectStorageContainingProblemSetsProblem(): void
    {
        $problem = new \Be\SmBegehungsliste\Domain\Model\Problem();
        $objectStorageHoldingExactlyOneProblem = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneProblem->attach($problem);
        $this->subject->setProblem($objectStorageHoldingExactlyOneProblem);

        self::assertEquals($objectStorageHoldingExactlyOneProblem, $this->subject->_get('problem'));
    }

    /**
     * @test
     */
    public function addProblemToObjectStorageHoldingProblem(): void
    {
        $problem = new \Be\SmBegehungsliste\Domain\Model\Problem();
        $problemObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $problemObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($problem));
        $this->subject->_set('problem', $problemObjectStorageMock);

        $this->subject->addProblem($problem);
    }

    /**
     * @test
     */
    public function removeProblemFromObjectStorageHoldingProblem(): void
    {
        $problem = new \Be\SmBegehungsliste\Domain\Model\Problem();
        $problemObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $problemObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($problem));
        $this->subject->_set('problem', $problemObjectStorageMock);

        $this->subject->removeProblem($problem);
    }

    /**
     * @test
     */
    public function getVerantworlicherReturnsInitialValueForFeuser(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getVerantworlicher()
        );
    }

    /**
     * @test
     */
    public function setVerantworlicherForObjectStorageContainingFeuserSetsVerantworlicher(): void
    {
        $verantworlicher = new \Be\SmBegehungsliste\Domain\Model\Feuser();
        $objectStorageHoldingExactlyOneVerantworlicher = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneVerantworlicher->attach($verantworlicher);
        $this->subject->setVerantworlicher($objectStorageHoldingExactlyOneVerantworlicher);

        self::assertEquals($objectStorageHoldingExactlyOneVerantworlicher, $this->subject->_get('verantworlicher'));
    }

    /**
     * @test
     */
    public function addVerantworlicherToObjectStorageHoldingVerantworlicher(): void
    {
        $verantworlicher = new \Be\SmBegehungsliste\Domain\Model\Feuser();
        $verantworlicherObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $verantworlicherObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($verantworlicher));
        $this->subject->_set('verantworlicher', $verantworlicherObjectStorageMock);

        $this->subject->addVerantworlicher($verantworlicher);
    }

    /**
     * @test
     */
    public function removeVerantworlicherFromObjectStorageHoldingVerantworlicher(): void
    {
        $verantworlicher = new \Be\SmBegehungsliste\Domain\Model\Feuser();
        $verantworlicherObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $verantworlicherObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($verantworlicher));
        $this->subject->_set('verantworlicher', $verantworlicherObjectStorageMock);

        $this->subject->removeVerantworlicher($verantworlicher);
    }

    /**
     * @test
     */
    public function getTeilnehmerReturnsInitialValueForFeuser(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getTeilnehmer()
        );
    }

    /**
     * @test
     */
    public function setTeilnehmerForObjectStorageContainingFeuserSetsTeilnehmer(): void
    {
        $teilnehmer = new \Be\SmBegehungsliste\Domain\Model\Feuser();
        $objectStorageHoldingExactlyOneTeilnehmer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneTeilnehmer->attach($teilnehmer);
        $this->subject->setTeilnehmer($objectStorageHoldingExactlyOneTeilnehmer);

        self::assertEquals($objectStorageHoldingExactlyOneTeilnehmer, $this->subject->_get('teilnehmer'));
    }

    /**
     * @test
     */
    public function addTeilnehmerToObjectStorageHoldingTeilnehmer(): void
    {
        $teilnehmer = new \Be\SmBegehungsliste\Domain\Model\Feuser();
        $teilnehmerObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $teilnehmerObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($teilnehmer));
        $this->subject->_set('teilnehmer', $teilnehmerObjectStorageMock);

        $this->subject->addTeilnehmer($teilnehmer);
    }

    /**
     * @test
     */
    public function removeTeilnehmerFromObjectStorageHoldingTeilnehmer(): void
    {
        $teilnehmer = new \Be\SmBegehungsliste\Domain\Model\Feuser();
        $teilnehmerObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $teilnehmerObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($teilnehmer));
        $this->subject->_set('teilnehmer', $teilnehmerObjectStorageMock);

        $this->subject->removeTeilnehmer($teilnehmer);
    }
}
