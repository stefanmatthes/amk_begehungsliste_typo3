<?php
namespace Be\SmLaufliste\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class LogControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Controller\LogController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Be\SmLaufliste\Controller\LogController::class)
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
    public function listActionFetchesAllLogsFromRepositoryAndAssignsThemToView()
    {

        $allLogs = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $logRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\LogRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $logRepository->expects(self::once())->method('findAll')->will(self::returnValue($allLogs));
        $this->inject($this->subject, 'logRepository', $logRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('logs', $allLogs);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenLogToView()
    {
        $log = new \Be\SmLaufliste\Domain\Model\Log();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('log', $log);

        $this->subject->showAction($log);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenLogToLogRepository()
    {
        $log = new \Be\SmLaufliste\Domain\Model\Log();

        $logRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\LogRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $logRepository->expects(self::once())->method('add')->with($log);
        $this->inject($this->subject, 'logRepository', $logRepository);

        $this->subject->createAction($log);
    }
}
