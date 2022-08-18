<?php
namespace Be\SmLaufliste\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class LauflisteControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Controller\LauflisteController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Be\SmLaufliste\Controller\LauflisteController::class)
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
    public function listActionFetchesAllLauflistesFromRepositoryAndAssignsThemToView()
    {

        $allLauflistes = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $lauflisteRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\LauflisteRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $lauflisteRepository->expects(self::once())->method('findAll')->will(self::returnValue($allLauflistes));
        $this->inject($this->subject, 'lauflisteRepository', $lauflisteRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('lauflistes', $allLauflistes);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenLauflisteToView()
    {
        $laufliste = new \Be\SmLaufliste\Domain\Model\Laufliste();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('laufliste', $laufliste);

        $this->subject->showAction($laufliste);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenLauflisteToLauflisteRepository()
    {
        $laufliste = new \Be\SmLaufliste\Domain\Model\Laufliste();

        $lauflisteRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\LauflisteRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $lauflisteRepository->expects(self::once())->method('add')->with($laufliste);
        $this->inject($this->subject, 'lauflisteRepository', $lauflisteRepository);

        $this->subject->createAction($laufliste);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenLauflisteToView()
    {
        $laufliste = new \Be\SmLaufliste\Domain\Model\Laufliste();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('laufliste', $laufliste);

        $this->subject->editAction($laufliste);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenLauflisteInLauflisteRepository()
    {
        $laufliste = new \Be\SmLaufliste\Domain\Model\Laufliste();

        $lauflisteRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\LauflisteRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $lauflisteRepository->expects(self::once())->method('update')->with($laufliste);
        $this->inject($this->subject, 'lauflisteRepository', $lauflisteRepository);

        $this->subject->updateAction($laufliste);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenLauflisteFromLauflisteRepository()
    {
        $laufliste = new \Be\SmLaufliste\Domain\Model\Laufliste();

        $lauflisteRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\LauflisteRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $lauflisteRepository->expects(self::once())->method('remove')->with($laufliste);
        $this->inject($this->subject, 'lauflisteRepository', $lauflisteRepository);

        $this->subject->deleteAction($laufliste);
    }
}
