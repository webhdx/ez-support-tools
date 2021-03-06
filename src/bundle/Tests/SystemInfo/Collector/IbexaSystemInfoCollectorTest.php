<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\EzSupportToolsBundle\Tests\SystemInfo\Collector;

use EzSystems\EzPlatformCoreBundle\EzPlatformCoreBundle;
use EzSystems\EzSupportToolsBundle\SystemInfo\Collector\IbexaSystemInfoCollector;
use EzSystems\EzSupportToolsBundle\SystemInfo\Collector\JsonComposerLockSystemInfoCollector;
use EzSystems\EzSupportToolsBundle\SystemInfo\Value\IbexaSystemInfo;
use PHPUnit\Framework\TestCase;

class IbexaSystemInfoCollectorTest extends TestCase
{
    public function testCollect(): void
    {
        $composerCollector = new JsonComposerLockSystemInfoCollector(
            __DIR__ . '/_fixtures/composer.lock', __DIR__ . '/_fixtures/composer.json'
        );

        $systemInfoCollector = new IbexaSystemInfoCollector($composerCollector);
        $systemInfo = $systemInfoCollector->collect();
        self::assertSame(IbexaSystemInfo::PRODUCT_NAME_OSS, $systemInfo->name);
        self::assertSame(EzPlatformCoreBundle::VERSION, $systemInfo->release);
    }
}
