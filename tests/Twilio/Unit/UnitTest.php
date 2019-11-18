<?php

namespace Twilio\Tests\Unit;

use PHPUnit\Framework\TestCase;

if (\version_compare(PHP_VERSION, '7.1.0') >= 0) {
    require \dirname(__DIR__) . '/Php7UnitTest.php';

    return;
}

/**
 * Legacy UnitTest compatible with PHP < 7.1.
 */
abstract class UnitTest extends TestCase
{
    protected function setUp()
    {
        if (\method_exists($this, 'doSetUp')) {
            $this->doSetUp();
        }
    }

    protected function tearDown()
    {
        if (\method_exists($this, 'doTearDown')) {
            $this->doTearDown();
        }
    }

    /**
     * Forward compatibility for lower versions of PHPUnit.
     *
     * @internal This method is not covered by the backward compatibility promise and
     * will be dropped once the PHP requirement gets bumped to >=7.1.
     */
    public function expectException($exceptionClass)
    {
        if ($this->isLegacyPHPUnit()) {
            $this->setExpectedException($exceptionClass);

            return;
        }

        parent::expectException($exceptionClass);
    }

    /**
     * Forward compatibility for lower versions of PHPUnit.
     *
     * @internal This method is not covered by the backward compatibility promise and
     * will be dropped once the PHP requirement gets bumped to >=7.1.
     */
    public function createMock($mockClass)
    {
        if ($this->isLegacyPHPUnit()) {
            return $this->getMock($mockClass);

            return;
        }

        return parent::createMock($mockClass);
    }

    /**
     * @internal This method is not covered by the backward compatibility promise and
     * will be dropped once the PHP requirement gets bumped to >=7.1.
     */
    protected function isLegacyPHPUnit()
    {
        return \method_exists('PHPUnit_Runner_Version', 'id');
    }
}
