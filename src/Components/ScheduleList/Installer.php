<?php

declare(strict_types=1);

/**
 * This file is part of Laravel Zero.
 *
 * (c) Nuno Maduro <enunomaduro@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace LaravelZero\Framework\Components\ScheduleList;

use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Components\AbstractInstaller;

/**
 * @internal
 */
final class Installer extends AbstractInstaller
{
    /**
     * {@inheritdoc}
     */
    protected $name = 'install:schedule-list';

    /**
     * {@inheritdoc}
     */
    protected $description = 'Schedule List: List all scheduled commands.';

    /**
     * The config file path.
     */
    private const CONFIG_FILE = __DIR__.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'schedule-list.php';

    /**
     * {@inheritdoc}
     */
    public function install(): void
    {
        $this->require('hmazter/laravel-schedule-list "^2.0"');

        $this->task(
            'Creating default schedule list configuration',
            function () {
                if (! File::exists(config_path('schedule-list.php'))) {
                    return File::copy(
                        static::CONFIG_FILE,
                        $this->app->configPath('schedule-list.php')
                    );
                }

                return false;
            }
        );
    }
}
