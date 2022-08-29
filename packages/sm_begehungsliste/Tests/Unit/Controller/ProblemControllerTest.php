<?php

declare(strict_types=1);

namespace Be\SmBegehungsliste\Tests\Unit\Controller;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class ProblemControllerTest extends UnitTestCase
{
    /**
     * @var \Be\SmBegehungsliste\Controller\ProblemController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Be\SmBegehungsliste\Controller\ProblemController::class))
            ->onlyMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllProblemsFromRepositoryAndAssignsThemToView(): void
    {
        $allProblems = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $problemRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\ProblemRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $problemRepository->expects(self::once())->method('findAll')->will(self::returnValue($allProblems));
        $this->subject->_set('problemRepository', $problemRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('problems', $allProblems);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenProblemToView(): void
    {
        $problem = new \Be\SmBegehungsliste\Domain\Model\Problem();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('problem', $problem);

        $this->subject->showAction($problem);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenProblemToProblemRepository(): void
    {
        $problem = new \Be\SmBegehungsliste\Domain\Model\Problem();

        $problemRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\ProblemRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $problemRepository->expects(self::once())->method('add')->with($problem);
        $this->subject->_set('problemRepository', $problemRepository);

        $this->subject->createAction($problem);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenProblemToView(): void
    {
        $problem = new \Be\SmBegehungsliste\Domain\Model\Problem();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('problem', $problem);

        $this->subject->editAction($problem);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenProblemInProblemRepository(): void
    {
        $problem = new \Be\SmBegehungsliste\Domain\Model\Problem();

        $problemRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\ProblemRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $problemRepository->expects(self::once())->method('update')->with($problem);
        $this->subject->_set('problemRepository', $problemRepository);

        $this->subject->updateAction($problem);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenProblemFromProblemRepository(): void
    {
        $problem = new \Be\SmBegehungsliste\Domain\Model\Problem();

        $problemRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\ProblemRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $problemRepository->expects(self::once())->method('remove')->with($problem);
        $this->subject->_set('problemRepository', $problemRepository);

        $this->subject->deleteAction($problem);
    }
}
