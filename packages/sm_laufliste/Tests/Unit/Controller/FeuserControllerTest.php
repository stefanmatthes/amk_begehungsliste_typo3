<?php
namespace Be\SmLaufliste\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class FeuserControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Controller\FeuserController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Be\SmLaufliste\Controller\FeuserController::class)
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
    public function listActionFetchesAllFeusersFromRepositoryAndAssignsThemToView()
    {

        $allFeusers = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $feuserRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\FeuserRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $feuserRepository->expects(self::once())->method('findAll')->will(self::returnValue($allFeusers));
        $this->inject($this->subject, 'feuserRepository', $feuserRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('feusers', $allFeusers);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenFeuserToView()
    {
        $feuser = new \Be\SmLaufliste\Domain\Model\Feuser();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('feuser', $feuser);

        $this->subject->showAction($feuser);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenFeuserToFeuserRepository()
    {
        $feuser = new \Be\SmLaufliste\Domain\Model\Feuser();

        $feuserRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\FeuserRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $feuserRepository->expects(self::once())->method('add')->with($feuser);
        $this->inject($this->subject, 'feuserRepository', $feuserRepository);

        $this->subject->createAction($feuser);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenFeuserToView()
    {
        $feuser = new \Be\SmLaufliste\Domain\Model\Feuser();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('feuser', $feuser);

        $this->subject->editAction($feuser);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenFeuserInFeuserRepository()
    {
        $feuser = new \Be\SmLaufliste\Domain\Model\Feuser();

        $feuserRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\FeuserRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $feuserRepository->expects(self::once())->method('update')->with($feuser);
        $this->inject($this->subject, 'feuserRepository', $feuserRepository);

        $this->subject->updateAction($feuser);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenFeuserFromFeuserRepository()
    {
        $feuser = new \Be\SmLaufliste\Domain\Model\Feuser();

        $feuserRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\FeuserRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $feuserRepository->expects(self::once())->method('remove')->with($feuser);
        $this->inject($this->subject, 'feuserRepository', $feuserRepository);

        $this->subject->deleteAction($feuser);
    }
}
