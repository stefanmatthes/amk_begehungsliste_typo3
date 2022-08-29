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
class MassnahmeControllerTest extends UnitTestCase
{
    /**
     * @var \Be\SmBegehungsliste\Controller\MassnahmeController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Be\SmBegehungsliste\Controller\MassnahmeController::class))
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
    public function listActionFetchesAllMassnahmesFromRepositoryAndAssignsThemToView(): void
    {
        $allMassnahmes = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $massnahmeRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\MassnahmeRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $massnahmeRepository->expects(self::once())->method('findAll')->will(self::returnValue($allMassnahmes));
        $this->subject->_set('massnahmeRepository', $massnahmeRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('massnahmes', $allMassnahmes);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenMassnahmeToView(): void
    {
        $massnahme = new \Be\SmBegehungsliste\Domain\Model\Massnahme();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('massnahme', $massnahme);

        $this->subject->showAction($massnahme);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenMassnahmeToMassnahmeRepository(): void
    {
        $massnahme = new \Be\SmBegehungsliste\Domain\Model\Massnahme();

        $massnahmeRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\MassnahmeRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $massnahmeRepository->expects(self::once())->method('add')->with($massnahme);
        $this->subject->_set('massnahmeRepository', $massnahmeRepository);

        $this->subject->createAction($massnahme);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenMassnahmeToView(): void
    {
        $massnahme = new \Be\SmBegehungsliste\Domain\Model\Massnahme();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('massnahme', $massnahme);

        $this->subject->editAction($massnahme);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenMassnahmeInMassnahmeRepository(): void
    {
        $massnahme = new \Be\SmBegehungsliste\Domain\Model\Massnahme();

        $massnahmeRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\MassnahmeRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $massnahmeRepository->expects(self::once())->method('update')->with($massnahme);
        $this->subject->_set('massnahmeRepository', $massnahmeRepository);

        $this->subject->updateAction($massnahme);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenMassnahmeFromMassnahmeRepository(): void
    {
        $massnahme = new \Be\SmBegehungsliste\Domain\Model\Massnahme();

        $massnahmeRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\MassnahmeRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $massnahmeRepository->expects(self::once())->method('remove')->with($massnahme);
        $this->subject->_set('massnahmeRepository', $massnahmeRepository);

        $this->subject->deleteAction($massnahme);
    }
}
