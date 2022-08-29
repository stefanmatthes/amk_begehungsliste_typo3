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
class RundgangControllerTest extends UnitTestCase
{
    /**
     * @var \Be\SmBegehungsliste\Controller\RundgangController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Be\SmBegehungsliste\Controller\RundgangController::class))
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
    public function listActionFetchesAllRundgangsFromRepositoryAndAssignsThemToView(): void
    {
        $allRundgangs = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $rundgangRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\RundgangRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $rundgangRepository->expects(self::once())->method('findAll')->will(self::returnValue($allRundgangs));
        $this->subject->_set('rundgangRepository', $rundgangRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('rundgangs', $allRundgangs);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenRundgangToView(): void
    {
        $rundgang = new \Be\SmBegehungsliste\Domain\Model\Rundgang();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('rundgang', $rundgang);

        $this->subject->showAction($rundgang);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenRundgangToRundgangRepository(): void
    {
        $rundgang = new \Be\SmBegehungsliste\Domain\Model\Rundgang();

        $rundgangRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\RundgangRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundgangRepository->expects(self::once())->method('add')->with($rundgang);
        $this->subject->_set('rundgangRepository', $rundgangRepository);

        $this->subject->createAction($rundgang);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenRundgangToView(): void
    {
        $rundgang = new \Be\SmBegehungsliste\Domain\Model\Rundgang();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('rundgang', $rundgang);

        $this->subject->editAction($rundgang);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenRundgangInRundgangRepository(): void
    {
        $rundgang = new \Be\SmBegehungsliste\Domain\Model\Rundgang();

        $rundgangRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\RundgangRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundgangRepository->expects(self::once())->method('update')->with($rundgang);
        $this->subject->_set('rundgangRepository', $rundgangRepository);

        $this->subject->updateAction($rundgang);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenRundgangFromRundgangRepository(): void
    {
        $rundgang = new \Be\SmBegehungsliste\Domain\Model\Rundgang();

        $rundgangRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\RundgangRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $rundgangRepository->expects(self::once())->method('remove')->with($rundgang);
        $this->subject->_set('rundgangRepository', $rundgangRepository);

        $this->subject->deleteAction($rundgang);
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenRundgangToView(): void
    {
        $rundgang = new \Be\SmBegehungsliste\Domain\Model\Rundgang();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('rundgang', $rundgang);

        $this->subject->showAction($rundgang);
    }
}
