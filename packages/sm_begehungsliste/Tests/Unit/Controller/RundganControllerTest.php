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
class RundganControllerTest extends UnitTestCase
{
    /**
     * @var \Be\SmBegehungsliste\Controller\RundganController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Be\SmBegehungsliste\Controller\RundganController::class))
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
    public function listActionFetchesAllRundgansFromRepositoryAndAssignsThemToView(): void
    {
        $allRundgans = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $rundganRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\RundganRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $rundganRepository->expects(self::once())->method('findAll')->will(self::returnValue($allRundgans));
        $this->subject->_set('rundganRepository', $rundganRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('rundgans', $allRundgans);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenRundganToView(): void
    {
        $rundgan = new \Be\SmBegehungsliste\Domain\Model\Rundgan();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('rundgan', $rundgan);

        $this->subject->showAction($rundgan);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenRundganToRundganRepository(): void
    {
        $rundgan = new \Be\SmBegehungsliste\Domain\Model\Rundgan();

        $rundganRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\RundganRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundganRepository->expects(self::once())->method('add')->with($rundgan);
        $this->subject->_set('rundganRepository', $rundganRepository);

        $this->subject->createAction($rundgan);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenRundganToView(): void
    {
        $rundgan = new \Be\SmBegehungsliste\Domain\Model\Rundgan();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('rundgan', $rundgan);

        $this->subject->editAction($rundgan);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenRundganInRundganRepository(): void
    {
        $rundgan = new \Be\SmBegehungsliste\Domain\Model\Rundgan();

        $rundganRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\RundganRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundganRepository->expects(self::once())->method('update')->with($rundgan);
        $this->subject->_set('rundganRepository', $rundganRepository);

        $this->subject->updateAction($rundgan);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenRundganFromRundganRepository(): void
    {
        $rundgan = new \Be\SmBegehungsliste\Domain\Model\Rundgan();

        $rundganRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\RundganRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundganRepository->expects(self::once())->method('remove')->with($rundgan);
        $this->subject->_set('rundganRepository', $rundganRepository);

        $this->subject->deleteAction($rundgan);
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenRundganToView(): void
    {
        $rundgan = new \Be\SmBegehungsliste\Domain\Model\Rundgan();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('rundgan', $rundgan);

        $this->subject->showAction($rundgan);
    }
}
