<?php
namespace Be\SmLaufliste\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class ModulControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Controller\ModulController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Be\SmLaufliste\Controller\ModulController::class)
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
    public function listActionFetchesAllModulsFromRepositoryAndAssignsThemToView()
    {

        $allModuls = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $modulRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\ModulRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $modulRepository->expects(self::once())->method('findAll')->will(self::returnValue($allModuls));
        $this->inject($this->subject, 'modulRepository', $modulRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('moduls', $allModuls);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenModulToView()
    {
        $modul = new \Be\SmLaufliste\Domain\Model\Modul();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('modul', $modul);

        $this->subject->showAction($modul);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenModulToModulRepository()
    {
        $modul = new \Be\SmLaufliste\Domain\Model\Modul();

        $modulRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\ModulRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $modulRepository->expects(self::once())->method('add')->with($modul);
        $this->inject($this->subject, 'modulRepository', $modulRepository);

        $this->subject->createAction($modul);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenModulToView()
    {
        $modul = new \Be\SmLaufliste\Domain\Model\Modul();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('modul', $modul);

        $this->subject->editAction($modul);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenModulInModulRepository()
    {
        $modul = new \Be\SmLaufliste\Domain\Model\Modul();

        $modulRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\ModulRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $modulRepository->expects(self::once())->method('update')->with($modul);
        $this->inject($this->subject, 'modulRepository', $modulRepository);

        $this->subject->updateAction($modul);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenModulFromModulRepository()
    {
        $modul = new \Be\SmLaufliste\Domain\Model\Modul();

        $modulRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\ModulRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $modulRepository->expects(self::once())->method('remove')->with($modul);
        $this->inject($this->subject, 'modulRepository', $modulRepository);

        $this->subject->deleteAction($modul);
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenModulToView()
    {
        $modul = new \Be\SmLaufliste\Domain\Model\Modul();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('modul', $modul);

        $this->subject->showAction($modul);
    }
}
