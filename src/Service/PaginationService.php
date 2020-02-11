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

namespace Burzum\Cake\Service;

use Cake\Http\ServerRequest;

/**
 * Pagination Service
 */
class PaginationService
{

    use ServicePaginatorTrait;

    /**
     * Server Request Object
     *
     * @var \Cake\Http\ServerRequest $request Server Request
     */
    protected $request;

    /**
     * Constructor
     *
     * @param \Cake\Http\ServerRequest $request Server Request
     */
    public function __construct(ServerRequest $request)
    {
        $this->request = $request;

        $this->getEventManager()->on('Service.afterPaginate', function () {
            $this->request = $this->addPagingAttrToRequest($this->request);
        });
    }

    /**
     * Returns request with 'paging' attribute added
     *
     * @return \Cake\Http\ServerRequest
     */
    public function getRequest()
    {
        return $this->request;
    }
}
