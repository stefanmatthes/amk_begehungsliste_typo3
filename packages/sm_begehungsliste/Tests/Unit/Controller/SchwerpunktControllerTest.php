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
class SchwerpunktControllerTest extends UnitTestCase
{
    /**
     * @var \Be\SmBegehungsliste\Controller\SchwerpunktController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Be\SmBegehungsliste\Controller\SchwerpunktController::class))
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
    public function listActionFetchesAllSchwerpunktsFromRepositoryAndAssignsThemToView(): void
    {
        $allSchwerpunkts = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $schwerpunktRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\SchwerpunktRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $schwerpunktRepository->expects(self::once())->method('findAll')->will(self::returnValue($allSchwerpunkts));
        $this->subject->_set('schwerpunktRepository', $schwerpunktRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('schwerpunkts', $allSchwerpunkts);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenSchwerpunktToSchwerpunktRepository(): void
    {
        $schwerpunkt = new \Be\SmBegehungsliste\Domain\Model\Schwerpunkt();

        $schwerpunktRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\SchwerpunktRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $schwerpunktRepository->expects(self::once())->method('add')->with($schwerpunkt);
        $this->subject->_set('schwerpunktRepository', $schwerpunktRepository);

        $this->subject->createAction($schwerpunkt);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenSchwerpunktToView(): void
    {
        $schwerpunkt = new \Be\SmBegehungsliste\Domain\Model\Schwerpunkt();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('schwerpunkt', $schwerpunkt);

        $this->subject->editAction($schwerpunkt);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenSchwerpunktInSchwerpunktRepository(): void
    {
        $schwerpunkt = new \Be\SmBegehungsliste\Domain\Model\Schwerpunkt();

        $schwerpunktRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\SchwerpunktRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $schwerpunktRepository->expects(self::once())->method('update')->with($schwerpunkt);
        $this->subject->_set('schwerpunktRepository', $schwerpunktRepository);

        $this->subject->updateAction($schwerpunkt);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenSchwerpunktFromSchwerpunktRepository(): void
    {
        $schwerpunkt = new \Be\SmBegehungsliste\Domain\Model\Schwerpunkt();

        $schwerpunktRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\SchwerpunktRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $schwerpunktRepository->expects(self::once())->method('remove')->with($schwerpunkt);
        $this->subject->_set('schwerpunktRepository', $schwerpunktRepository);

        $this->subject->deleteAction($schwerpunkt);
    }
}
