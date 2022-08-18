<?php
namespace Be\SmLaufliste\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class StandortControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Controller\StandortController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Be\SmLaufliste\Controller\StandortController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllStandortsFromRepositoryAndAssignsThemToView()
    {

        $allStandorts = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $standortRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\StandortRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $standortRepository->expects(self::once())->method('findAll')->will(self::returnValue($allStandorts));
        $this->inject($this->subject, 'standortRepository', $standortRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('standorts', $allStandorts);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenStandortToView()
    {
        $standort = new \Be\SmLaufliste\Domain\Model\Standort();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('standort', $standort);

        $this->subject->showAction($standort);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenStandortToStandortRepository()
    {
        $standort = new \Be\SmLaufliste\Domain\Model\Standort();

        $standortRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\StandortRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $standortRepository->expects(self::once())->method('add')->with($standort);
        $this->inject($this->subject, 'standortRepository', $standortRepository);

        $this->subject->createAction($standort);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenStandortToView()
    {
        $standort = new \Be\SmLaufliste\Domain\Model\Standort();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('standort', $standort);

        $this->subject->editAction($standort);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenStandortInStandortRepository()
    {
        $standort = new \Be\SmLaufliste\Domain\Model\Standort();

        $standortRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\StandortRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $standortRepository->expects(self::once())->method('update')->with($standort);
        $this->inject($this->subject, 'standortRepository', $standortRepository);

        $this->subject->updateAction($standort);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenStandortFromStandortRepository()
    {
        $standort = new \Be\SmLaufliste\Domain\Model\Standort();

        $standortRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\StandortRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $standortRepository->expects(self::once())->method('remove')->with($standort);
        $this->inject($this->subject, 'standortRepository', $standortRepository);

        $this->subject->deleteAction($standort);
    }
}
