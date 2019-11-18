<?php

namespace Twilio\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * This file is placed outside of the Unit test suite to prevent parse errors by earlier PHP versions.
 *
 * Void keyword is available since 7.1.
 */
abstract class UnitTest extends TestCase
{
    protected function setUp(): void
    {
        if (\method_exists($this, 'doSetUp')) {
            $this->doSetUp();
        }
    }

    protected function tearDown(): void
    {
        if (\method_exists($this, 'doTearDown')) {
            $this->doTearDown();
        }
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
