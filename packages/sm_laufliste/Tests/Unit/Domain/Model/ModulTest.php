<?php
namespace Be\SmLaufliste\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class ModulTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Domain\Model\Modul
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Be\SmLaufliste\Domain\Model\Modul();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getKksReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getKks()
        );
    }

    /**
     * @test
     */
    public function setKksForStringSetsKks()
    {
        $this->subject->setKks('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'kks',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTokenidReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTokenid()
        );
    }

    /**
     * @test
     */
    public function setTokenidForStringSetsTokenid()
    {
        $this->subject->setTokenid('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'tokenid',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getKurztextReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getKurztext()
        );
    }

    /**
     * @test
     */
    public function setKurztextForStringSetsKurztext()
    {
        $this->subject->setKurztext('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'kurztext',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAnleitungReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAnleitung()
        );
    }

    /**
     * @test
     */
    public function setAnleitungForStringSetsAnleitung()
    {
        $this->subject->setAnleitung('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'anleitung',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getOrtReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getOrt()
        );
    }

    /**
     * @test
     */
    public function setOrtForStringSetsOrt()
    {
        $this->subject->setOrt('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'ort',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCheckonlyReturnsInitialValueForBool()
    {
        self::assertSame(
            false,
            $this->subject->getCheckonly()
        );
    }

    /**
     * @test
     */
    public function setCheckonlyForBoolSetsCheckonly()
    {
        $this->subject->setCheckonly(true);

        self::assertAttributeEquals(
            true,
            'checkonly',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getUnitReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getUnit()
        );
    }

    /**
     * @test
     */
    public function setUnitForStringSetsUnit()
    {
        $this->subject->setUnit('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'unit',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDokumenteReturnsInitialValueForFileReference()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getDokumente()
        );
    }

    /**
     * @test
     */
    public function setDokumenteForFileReferenceSetsDokumente()
    {
        $dokumente = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $objectStorageHoldingExactlyOneDokumente = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneDokumente->attach($dokumente);
        $this->subject->setDokumente($objectStorageHoldingExactlyOneDokumente);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneDokumente,
            'dokumente',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addDokumenteToObjectStorageHoldingDokumente()
    {
        $dokumente = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $dokumenteObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $dokumenteObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($dokumente));
        $this->inject($this->subject, 'dokumente', $dokumenteObjectStorageMock);

        $this->subject->addDokumente($dokumente);
    }

    /**
     * @test
     */
    public function removeDokumenteFromObjectStorageHoldingDokumente()
    {
        $dokumente = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $dokumenteObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $dokumenteObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($dokumente));
        $this->inject($this->subject, 'dokumente', $dokumenteObjectStorageMock);

        $this->subject->removeDokumente($dokumente);
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
    public function getMeldungReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getMeldung()
        );
    }

    /**
     * @test
     */
    public function setMeldungForStringSetsMeldung()
    {
        $this->subject->setMeldung('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'meldung',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getMinReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getMin()
        );
    }

    /**
     * @test
     */
    public function setMinForFloatSetsMin()
    {
        $this->subject->setMin(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'min',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getMaxReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getMax()
        );
    }

    /**
     * @test
     */
    public function setMaxForFloatSetsMax()
    {
        $this->subject->setMax(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'max',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getDiffReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getDiff()
        );
    }

    /**
     * @test
     */
    public function setDiffForFloatSetsDiff()
    {
        $this->subject->setDiff(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'diff',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getLetztemessungReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getLetztemessung()
        );
    }

    /**
     * @test
     */
    public function setLetztemessungForFloatSetsLetztemessung()
    {
        $this->subject->setLetztemessung(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'letztemessung',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getProblemReturnsInitialValueForProblem()
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
    public function setProblemForObjectStorageContainingProblemSetsProblem()
    {
        $problem = new \Be\SmLaufliste\Domain\Model\Problem();
        $objectStorageHoldingExactlyOneProblem = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneProblem->attach($problem);
        $this->subject->setProblem($objectStorageHoldingExactlyOneProblem);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneProblem,
            'problem',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addProblemToObjectStorageHoldingProblem()
    {
        $problem = new \Be\SmLaufliste\Domain\Model\Problem();
        $problemObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $problemObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($problem));
        $this->inject($this->subject, 'problem', $problemObjectStorageMock);

        $this->subject->addProblem($problem);
    }

    /**
     * @test
     */
    public function removeProblemFromObjectStorageHoldingProblem()
    {
        $problem = new \Be\SmLaufliste\Domain\Model\Problem();
        $problemObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $problemObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($problem));
        $this->inject($this->subject, 'problem', $problemObjectStorageMock);

        $this->subject->removeProblem($problem);
    }
}
