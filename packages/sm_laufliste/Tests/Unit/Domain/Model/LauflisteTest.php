<?php
namespace Be\SmLaufliste\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class LauflisteTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Domain\Model\Laufliste
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Be\SmLaufliste\Domain\Model\Laufliste();
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
    public function getModuleReturnsInitialValueForModul()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getModule()
        );
    }

    /**
     * @test
     */
    public function setModuleForObjectStorageContainingModulSetsModule()
    {
        $module = new \Be\SmLaufliste\Domain\Model\Modul();
        $objectStorageHoldingExactlyOneModule = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneModule->attach($module);
        $this->subject->setModule($objectStorageHoldingExactlyOneModule);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneModule,
            'module',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addModuleToObjectStorageHoldingModule()
    {
        $module = new \Be\SmLaufliste\Domain\Model\Modul();
        $moduleObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $moduleObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($module));
        $this->inject($this->subject, 'module', $moduleObjectStorageMock);

        $this->subject->addModule($module);
    }

    /**
     * @test
     */
    public function removeModuleFromObjectStorageHoldingModule()
    {
        $module = new \Be\SmLaufliste\Domain\Model\Modul();
        $moduleObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $moduleObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($module));
        $this->inject($this->subject, 'module', $moduleObjectStorageMock);

        $this->subject->removeModule($module);
    }
}
