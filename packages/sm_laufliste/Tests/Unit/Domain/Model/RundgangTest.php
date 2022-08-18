<?php
namespace Be\SmLaufliste\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class RundgangTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Domain\Model\Rundgang
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Be\SmLaufliste\Domain\Model\Rundgang();
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
    public function getStandortReturnsInitialValueForStandort()
    {
        self::assertEquals(
            null,
            $this->subject->getStandort()
        );
    }

    /**
     * @test
     */
    public function setStandortForStandortSetsStandort()
    {
        $standortFixture = new \Be\SmLaufliste\Domain\Model\Standort();
        $this->subject->setStandort($standortFixture);

        self::assertAttributeEquals(
            $standortFixture,
            'standort',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLauflisteReturnsInitialValueForLaufliste()
    {
        self::assertEquals(
            null,
            $this->subject->getLaufliste()
        );
    }

    /**
     * @test
     */
    public function setLauflisteForLauflisteSetsLaufliste()
    {
        $lauflisteFixture = new \Be\SmLaufliste\Domain\Model\Laufliste();
        $this->subject->setLaufliste($lauflisteFixture);

        self::assertAttributeEquals(
            $lauflisteFixture,
            'laufliste',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSchichtenReturnsInitialValueForSchicht()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getSchichten()
        );
    }

    /**
     * @test
     */
    public function setSchichtenForObjectStorageContainingSchichtSetsSchichten()
    {
        $schichten = new \Be\SmLaufliste\Domain\Model\Schicht();
        $objectStorageHoldingExactlyOneSchichten = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneSchichten->attach($schichten);
        $this->subject->setSchichten($objectStorageHoldingExactlyOneSchichten);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneSchichten,
            'schichten',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addSchichtenToObjectStorageHoldingSchichten()
    {
        $schichten = new \Be\SmLaufliste\Domain\Model\Schicht();
        $schichtenObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $schichtenObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($schichten));
        $this->inject($this->subject, 'schichten', $schichtenObjectStorageMock);

        $this->subject->addSchichten($schichten);
    }

    /**
     * @test
     */
    public function removeSchichtenFromObjectStorageHoldingSchichten()
    {
        $schichten = new \Be\SmLaufliste\Domain\Model\Schicht();
        $schichtenObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $schichtenObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($schichten));
        $this->inject($this->subject, 'schichten', $schichtenObjectStorageMock);

        $this->subject->removeSchichten($schichten);
    }

    /**
     * @test
     */
    public function getUserReturnsInitialValueForFeuser()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getUser()
        );
    }

    /**
     * @test
     */
    public function setUserForObjectStorageContainingFeuserSetsUser()
    {
        $user = new \Be\SmLaufliste\Domain\Model\Feuser();
        $objectStorageHoldingExactlyOneUser = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneUser->attach($user);
        $this->subject->setUser($objectStorageHoldingExactlyOneUser);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneUser,
            'user',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addUserToObjectStorageHoldingUser()
    {
        $user = new \Be\SmLaufliste\Domain\Model\Feuser();
        $userObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $userObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($user));
        $this->inject($this->subject, 'user', $userObjectStorageMock);

        $this->subject->addUser($user);
    }

    /**
     * @test
     */
    public function removeUserFromObjectStorageHoldingUser()
    {
        $user = new \Be\SmLaufliste\Domain\Model\Feuser();
        $userObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $userObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($user));
        $this->inject($this->subject, 'user', $userObjectStorageMock);

        $this->subject->removeUser($user);
    }

    /**
     * @test
     */
    public function getLogReturnsInitialValueForRundgangaktiv()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getLog()
        );
    }

    /**
     * @test
     */
    public function setLogForObjectStorageContainingRundgangaktivSetsLog()
    {
        $log = new \Be\SmLaufliste\Domain\Model\Rundgangaktiv();
        $objectStorageHoldingExactlyOneLog = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneLog->attach($log);
        $this->subject->setLog($objectStorageHoldingExactlyOneLog);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneLog,
            'log',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addLogToObjectStorageHoldingLog()
    {
        $log = new \Be\SmLaufliste\Domain\Model\Rundgangaktiv();
        $logObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $logObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($log));
        $this->inject($this->subject, 'log', $logObjectStorageMock);

        $this->subject->addLog($log);
    }

    /**
     * @test
     */
    public function removeLogFromObjectStorageHoldingLog()
    {
        $log = new \Be\SmLaufliste\Domain\Model\Rundgangaktiv();
        $logObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $logObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($log));
        $this->inject($this->subject, 'log', $logObjectStorageMock);

        $this->subject->removeLog($log);
    }
}
