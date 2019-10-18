<?php

namespace Twilio\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * This file is placed outside of the Unit test suite to prevent parse errors by earlier PHP versions.
 */
abstract class UnitTest extends TestCase
{
    protected function setUp()
    {
        if (method_exists($this, 'doSetUp')) {
            $this->doSetUp();
        }
    }

    protected function tearDown()
    {
        if (method_exists($this, 'doTearDown')) {
            $this->doTearDown();
        }
    }

    /**
     * @internal This method is not covered by the backward compatibility promise and
     * will be dropped once the PHP requirement gets bumped to >=7.1.
     */
    protected function isLegacyPHPUnit()
    {
        return method_exists('PHPUnit_Runner_Version', 'id');
    }
}
