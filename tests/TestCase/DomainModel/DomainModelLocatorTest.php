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

namespace Burzum\Cake\Test\TestCase\DomainModel;

use App\DomainModel\Article;
use Burzum\Cake\DomainModel\DomainModelLocator;
use Cake\TestSuite\TestCase;

/**
 * ServiceLocatorTest
 */
class DomainModelLocatorTest extends TestCase
{
    /**
     * testLocate
     *
     * @return void
     * @throws \Exception
     */
    public function testLocate()
    {
        $locator = new DomainModelLocator();
        $service = $locator->load('Article');
        $this->assertInstanceOf(Article::class, $service);
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
        $this->expectExceptionMessage('Domain Model class `DoesNotExist` not found.');
        $locator = new DomainModelLocator();
        $locator->load('DoesNotExist');
    }
}
