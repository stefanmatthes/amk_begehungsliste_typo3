<?php
namespace Be\SmLaufliste\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class ProblemControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Controller\ProblemController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Be\SmLaufliste\Controller\ProblemController::class)
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
    public function listActionFetchesAllProblemsFromRepositoryAndAssignsThemToView()
    {

        $allProblems = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $problemRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\ProblemRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $problemRepository->expects(self::once())->method('findAll')->will(self::returnValue($allProblems));
        $this->inject($this->subject, 'problemRepository', $problemRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('problems', $allProblems);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenProblemToView()
    {
        $problem = new \Be\SmLaufliste\Domain\Model\Problem();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('problem', $problem);

        $this->subject->showAction($problem);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenProblemToProblemRepository()
    {
        $problem = new \Be\SmLaufliste\Domain\Model\Problem();

        $problemRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\ProblemRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $problemRepository->expects(self::once())->method('add')->with($problem);
        $this->inject($this->subject, 'problemRepository', $problemRepository);

        $this->subject->createAction($problem);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenProblemToView()
    {
        $problem = new \Be\SmLaufliste\Domain\Model\Problem();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('problem', $problem);

        $this->subject->editAction($problem);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenProblemInProblemRepository()
    {
        $problem = new \Be\SmLaufliste\Domain\Model\Problem();

        $problemRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\ProblemRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $problemRepository->expects(self::once())->method('update')->with($problem);
        $this->inject($this->subject, 'problemRepository', $problemRepository);

        $this->subject->updateAction($problem);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenProblemFromProblemRepository()
    {
        $problem = new \Be\SmLaufliste\Domain\Model\Problem();

        $problemRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\ProblemRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $problemRepository->expects(self::once())->method('remove')->with($problem);
        $this->inject($this->subject, 'problemRepository', $problemRepository);

        $this->subject->deleteAction($problem);
    }
}
