<?php
namespace Be\SmLaufliste\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Stefan Matthes <stefan.matthes@branding-energy.de>
 */
class FeuserTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Be\SmLaufliste\Domain\Model\Feuser
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Be\SmLaufliste\Domain\Model\Feuser();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function dummyTestToNotLeaveThisFileEmpty()
    {
        self::markTestIncomplete();
    }
}
