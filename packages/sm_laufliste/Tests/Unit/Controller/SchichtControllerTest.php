<?php
namespace Be\SmLaufliste\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class SchichtControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Controller\SchichtController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Be\SmLaufliste\Controller\SchichtController::class)
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
    public function listActionFetchesAllSchichtsFromRepositoryAndAssignsThemToView()
    {

        $allSchichts = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $schichtRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\SchichtRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $schichtRepository->expects(self::once())->method('findAll')->will(self::returnValue($allSchichts));
        $this->inject($this->subject, 'schichtRepository', $schichtRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('schichts', $allSchichts);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenSchichtToView()
    {
        $schicht = new \Be\SmLaufliste\Domain\Model\Schicht();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('schicht', $schicht);

        $this->subject->showAction($schicht);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenSchichtToSchichtRepository()
    {
        $schicht = new \Be\SmLaufliste\Domain\Model\Schicht();

        $schichtRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\SchichtRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $schichtRepository->expects(self::once())->method('add')->with($schicht);
        $this->inject($this->subject, 'schichtRepository', $schichtRepository);

        $this->subject->createAction($schicht);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenSchichtToView()
    {
        $schicht = new \Be\SmLaufliste\Domain\Model\Schicht();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('schicht', $schicht);

        $this->subject->editAction($schicht);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenSchichtInSchichtRepository()
    {
        $schicht = new \Be\SmLaufliste\Domain\Model\Schicht();

        $schichtRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\SchichtRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $schichtRepository->expects(self::once())->method('update')->with($schicht);
        $this->inject($this->subject, 'schichtRepository', $schichtRepository);

        $this->subject->updateAction($schicht);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenSchichtFromSchichtRepository()
    {
        $schicht = new \Be\SmLaufliste\Domain\Model\Schicht();

        $schichtRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\SchichtRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $schichtRepository->expects(self::once())->method('remove')->with($schicht);
        $this->inject($this->subject, 'schichtRepository', $schichtRepository);

        $this->subject->deleteAction($schicht);
    }
}
