<?php
namespace Be\SmLaufliste\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class RundgangaktivControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Controller\RundgangaktivController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Be\SmLaufliste\Controller\RundgangaktivController::class)
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
    public function listActionFetchesAllRundgangaktivsFromRepositoryAndAssignsThemToView()
    {

        $allRundgangaktivs = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $rundgangaktivRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\RundgangaktivRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $rundgangaktivRepository->expects(self::once())->method('findAll')->will(self::returnValue($allRundgangaktivs));
        $this->inject($this->subject, 'rundgangaktivRepository', $rundgangaktivRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('rundgangaktivs', $allRundgangaktivs);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenRundgangaktivToView()
    {
        $rundgangaktiv = new \Be\SmLaufliste\Domain\Model\Rundgangaktiv();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('rundgangaktiv', $rundgangaktiv);

        $this->subject->showAction($rundgangaktiv);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenRundgangaktivToRundgangaktivRepository()
    {
        $rundgangaktiv = new \Be\SmLaufliste\Domain\Model\Rundgangaktiv();

        $rundgangaktivRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\RundgangaktivRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundgangaktivRepository->expects(self::once())->method('add')->with($rundgangaktiv);
        $this->inject($this->subject, 'rundgangaktivRepository', $rundgangaktivRepository);

        $this->subject->createAction($rundgangaktiv);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenRundgangaktivToView()
    {
        $rundgangaktiv = new \Be\SmLaufliste\Domain\Model\Rundgangaktiv();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('rundgangaktiv', $rundgangaktiv);

        $this->subject->editAction($rundgangaktiv);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenRundgangaktivInRundgangaktivRepository()
    {
        $rundgangaktiv = new \Be\SmLaufliste\Domain\Model\Rundgangaktiv();

        $rundgangaktivRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\RundgangaktivRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundgangaktivRepository->expects(self::once())->method('update')->with($rundgangaktiv);
        $this->inject($this->subject, 'rundgangaktivRepository', $rundgangaktivRepository);

        $this->subject->updateAction($rundgangaktiv);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenRundgangaktivFromRundgangaktivRepository()
    {
        $rundgangaktiv = new \Be\SmLaufliste\Domain\Model\Rundgangaktiv();

        $rundgangaktivRepository = $this->getMockBuilder(\Be\SmLaufliste\Domain\Repository\RundgangaktivRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundgangaktivRepository->expects(self::once())->method('remove')->with($rundgangaktiv);
        $this->inject($this->subject, 'rundgangaktivRepository', $rundgangaktivRepository);

        $this->subject->deleteAction($rundgangaktiv);
    }
}
