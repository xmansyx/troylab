<?php

namespace Tests\Unit;

use Tests\TestCase;

class CommandTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_fix_oreder_console_command()
    {
        $this->artisan('fix:order')
        ->expectsOutput('data reorder complete')
        ->expectsOutput('sending email...')
        ->expectsOutput('email sent succeffully')
        ->assertExitCode(0);
    }
}
