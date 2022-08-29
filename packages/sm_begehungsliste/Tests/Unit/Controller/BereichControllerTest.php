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
class BereichControllerTest extends UnitTestCase
{
    /**
     * @var \Be\SmBegehungsliste\Controller\BereichController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Be\SmBegehungsliste\Controller\BereichController::class))
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
    public function listActionFetchesAllBereichesFromRepositoryAndAssignsThemToView(): void
    {
        $allBereiches = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bereichRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\BereichRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $bereichRepository->expects(self::once())->method('findAll')->will(self::returnValue($allBereiches));
        $this->subject->_set('bereichRepository', $bereichRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('bereiches', $allBereiches);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenBereichToView(): void
    {
        $bereich = new \Be\SmBegehungsliste\Domain\Model\Bereich();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('bereich', $bereich);

        $this->subject->showAction($bereich);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenBereichToBereichRepository(): void
    {
        $bereich = new \Be\SmBegehungsliste\Domain\Model\Bereich();

        $bereichRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\BereichRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $bereichRepository->expects(self::once())->method('add')->with($bereich);
        $this->subject->_set('bereichRepository', $bereichRepository);

        $this->subject->createAction($bereich);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenBereichToView(): void
    {
        $bereich = new \Be\SmBegehungsliste\Domain\Model\Bereich();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('bereich', $bereich);

        $this->subject->editAction($bereich);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenBereichInBereichRepository(): void
    {
        $bereich = new \Be\SmBegehungsliste\Domain\Model\Bereich();

        $bereichRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\BereichRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $bereichRepository->expects(self::once())->method('update')->with($bereich);
        $this->subject->_set('bereichRepository', $bereichRepository);

        $this->subject->updateAction($bereich);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenBereichFromBereichRepository(): void
    {
        $bereich = new \Be\SmBegehungsliste\Domain\Model\Bereich();

        $bereichRepository = $this->getMockBuilder(\Be\SmBegehungsliste\Domain\Repository\BereichRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $bereichRepository->expects(self::once())->method('remove')->with($bereich);
        $this->subject->_set('bereichRepository', $bereichRepository);

        $this->subject->deleteAction($bereich);
    }
}
