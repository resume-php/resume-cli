<?php

namespace Resume\Cli\Tests\Integration;

use Resume\Cli\Commands\InstallThemeCommand;
use LaravelZero\Framework\Contracts\Providers\Composer;
use Mockery as m;
use Resume\Cli\Tests\TestCase;

class InstallThemeCommandTest extends TestCase
{
    /** @test */
    function it_requires_the_right_package()
    {
        $composer = m::spy(Composer::class);

        app()->instance(Composer::class, $composer);

        $this->call(InstallThemeCommand::class, [
            'theme' => 'test/resume-theme',
        ]);

        $composer->shouldHaveReceived('require')
            ->with('test/resume-theme');

        $this->assertContains('test/resume-theme', $this->app->output());
    }
}
