<?php
namespace Be\SmLaufliste\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class MessungControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Controller\MessungController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Be\SmLaufliste\Controller\MessungController::class)
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
    public function listActionFetchesAllMessungsFromRepositoryAndAssignsThemToView()
    {

        $allMessungs = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $messungRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\MessungRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $messungRepository->expects(self::once())->method('findAll')->will(self::returnValue($allMessungs));
        $this->inject($this->subject, 'messungRepository', $messungRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('messungs', $allMessungs);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenMessungToView()
    {
        $messung = new \Be\SmLaufliste\Domain\Model\Messung();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('messung', $messung);

        $this->subject->showAction($messung);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenMessungToMessungRepository()
    {
        $messung = new \Be\SmLaufliste\Domain\Model\Messung();

        $messungRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\MessungRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $messungRepository->expects(self::once())->method('add')->with($messung);
        $this->inject($this->subject, 'messungRepository', $messungRepository);

        $this->subject->createAction($messung);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenMessungToView()
    {
        $messung = new \Be\SmLaufliste\Domain\Model\Messung();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('messung', $messung);

        $this->subject->editAction($messung);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenMessungInMessungRepository()
    {
        $messung = new \Be\SmLaufliste\Domain\Model\Messung();

        $messungRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\MessungRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $messungRepository->expects(self::once())->method('update')->with($messung);
        $this->inject($this->subject, 'messungRepository', $messungRepository);

        $this->subject->updateAction($messung);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenMessungFromMessungRepository()
    {
        $messung = new \Be\SmLaufliste\Domain\Model\Messung();

        $messungRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\MessungRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $messungRepository->expects(self::once())->method('remove')->with($messung);
        $this->inject($this->subject, 'messungRepository', $messungRepository);

        $this->subject->deleteAction($messung);
    }
}
