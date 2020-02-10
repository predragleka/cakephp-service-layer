<?php
declare(strict_types = 1);

/**
 * Copyright (c) Florian Krämer
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Florian Krämer
 * @link          https://github.com/burzum/cakephp-service-layer
 * @since         1.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

namespace Burzum\Cake\Test\TestCase\Service;

use App\Service\Sub\Folder\NestedService;
use App\Service\TestService;
use Burzum\Cake\Service\ServiceLocator;
use Cake\TestSuite\TestCase;

/**
 * ServiceLocatorTest
 */
class ServiceLocatorTest extends TestCase
{
    /**
     * testLocate
     *
     * @return void
     * @throws \Exception
     */
    public function testLocate()
    {
        $locator = new ServiceLocator();
        $service = $locator->load('Test');
        $this->assertInstanceOf(TestService::class, $service);
    }

    /**
     * testLocate multiple
     *
     * @return void
     * @throws \Exception
     */
    public function testLocateMultiple()
    {
        $locator = new ServiceLocator();
        /** @noinspection PhpUnusedLocalVariableInspection */
        $service = $locator->load('Test');
        $service = $locator->load('Test');

        $this->assertInstanceOf(TestService::class, $service);
    }

    /**
     * testLocate
     *
     * @return void
     * @throws \Exception
     */
    public function testLocateNested()
    {
        $locator = new ServiceLocator();
        $service = $locator->load('Sub/Folder/Nested');
        $this->assertInstanceOf(NestedService::class, $service);
    }

    /**
     * testLocateClassNotFound
     *
     * @return void
     * @throws \Exception
     */
    public function testLocateClassNotFound()
    {
        $this->expectException('RuntimeException');
        $this->expectExceptionMessage('Service class `DoesNotExist` not found.');
        $locator = new ServiceLocator();
        $locator->load('DoesNotExist');
    }

    /**
     * testPassingClassName
     *
     * @return void
     * @throws \Exception
     */
    public function testPassingClassName()
    {
        $locator = new ServiceLocator();
        $locator->load('Existing', [
            'className' => TestService::class
        ]);
        $this->assertNull($locator->get('Test'));
        $this->assertInstanceOf(TestService::class, $locator->get('Existing'));
    }
}
