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
class RundgangTest extends UnitTestCase
{
    /**
     * @var \Be\SmBegehungsliste\Domain\Model\Rundgang|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Be\SmBegehungsliste\Domain\Model\Rundgang::class,
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
    public function getProblemsReturnsInitialValueForProblem(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getProblems()
        );
    }

    /**
     * @test
     */
    public function setProblemsForObjectStorageContainingProblemSetsProblems(): void
    {
        $problem = new \Be\SmBegehungsliste\Domain\Model\Problem();
        $objectStorageHoldingExactlyOneProblems = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneProblems->attach($problem);
        $this->subject->setProblems($objectStorageHoldingExactlyOneProblems);

        self::assertEquals($objectStorageHoldingExactlyOneProblems, $this->subject->_get('problems'));
    }

    /**
     * @test
     */
    public function addProblemToObjectStorageHoldingProblems(): void
    {
        $problem = new \Be\SmBegehungsliste\Domain\Model\Problem();
        $problemsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $problemsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($problem));
        $this->subject->_set('problems', $problemsObjectStorageMock);

        $this->subject->addProblem($problem);
    }

    /**
     * @test
     */
    public function removeProblemFromObjectStorageHoldingProblems(): void
    {
        $problem = new \Be\SmBegehungsliste\Domain\Model\Problem();
        $problemsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $problemsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($problem));
        $this->subject->_set('problems', $problemsObjectStorageMock);

        $this->subject->removeProblem($problem);
    }

    /**
     * @test
     */
    public function getVerantwortlicherReturnsInitialValueForFeuser(): void
    {
        self::assertEquals(
            null,
            $this->subject->getVerantwortlicher()
        );
    }

    /**
     * @test
     */
    public function setVerantwortlicherForFeuserSetsVerantwortlicher(): void
    {
        $verantwortlicherFixture = new \Be\SmBegehungsliste\Domain\Model\Feuser();
        $this->subject->setVerantwortlicher($verantwortlicherFixture);

        self::assertEquals($verantwortlicherFixture, $this->subject->_get('verantwortlicher'));
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

    /**
     * @test
     */
    public function getSchwerpunktReturnsInitialValueForSchwerpunkt(): void
    {
        self::assertEquals(
            null,
            $this->subject->getSchwerpunkt()
        );
    }

    /**
     * @test
     */
    public function setSchwerpunktForSchwerpunktSetsSchwerpunkt(): void
    {
        $schwerpunktFixture = new \Be\SmBegehungsliste\Domain\Model\Schwerpunkt();
        $this->subject->setSchwerpunkt($schwerpunktFixture);

        self::assertEquals($schwerpunktFixture, $this->subject->_get('schwerpunkt'));
    }
}
