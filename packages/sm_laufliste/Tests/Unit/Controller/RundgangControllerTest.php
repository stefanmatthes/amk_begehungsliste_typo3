<?php
namespace Be\SmLaufliste\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class RundgangControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Controller\RundgangController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Be\SmLaufliste\Controller\RundgangController::class)
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
    public function listActionFetchesAllRundgangsFromRepositoryAndAssignsThemToView()
    {

        $allRundgangs = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $rundgangRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\RundgangRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $rundgangRepository->expects(self::once())->method('findAll')->will(self::returnValue($allRundgangs));
        $this->inject($this->subject, 'rundgangRepository', $rundgangRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('rundgangs', $allRundgangs);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenRundgangToView()
    {
        $rundgang = new \Be\SmLaufliste\Domain\Model\Rundgang();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('rundgang', $rundgang);

        $this->subject->showAction($rundgang);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenRundgangToRundgangRepository()
    {
        $rundgang = new \Be\SmLaufliste\Domain\Model\Rundgang();

        $rundgangRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\RundgangRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundgangRepository->expects(self::once())->method('add')->with($rundgang);
        $this->inject($this->subject, 'rundgangRepository', $rundgangRepository);

        $this->subject->createAction($rundgang);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenRundgangToView()
    {
        $rundgang = new \Be\SmLaufliste\Domain\Model\Rundgang();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('rundgang', $rundgang);

        $this->subject->editAction($rundgang);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenRundgangInRundgangRepository()
    {
        $rundgang = new \Be\SmLaufliste\Domain\Model\Rundgang();

        $rundgangRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\RundgangRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundgangRepository->expects(self::once())->method('update')->with($rundgang);
        $this->inject($this->subject, 'rundgangRepository', $rundgangRepository);

        $this->subject->updateAction($rundgang);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenRundgangFromRundgangRepository()
    {
        $rundgang = new \Be\SmLaufliste\Domain\Model\Rundgang();

        $rundgangRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\RundgangRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundgangRepository->expects(self::once())->method('remove')->with($rundgang);
        $this->inject($this->subject, 'rundgangRepository', $rundgangRepository);

        $this->subject->deleteAction($rundgang);
    }
}
