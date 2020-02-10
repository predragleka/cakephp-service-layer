<?php
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
declare(strict_types = 1);

namespace App\Service;

use Burzum\Cake\Service\ServicePaginatorTrait;
use Cake\Datasource\ModelAwareTrait;

/**
 * Class ArticlesService
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 *
 * @package App\Service
 */
class ArticlesService
{
    use ModelAwareTrait;
    use ServicePaginatorTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize()
    {
        $this->loadModel('Articles');
    }

    /**
     * List articles
     *
     * @param $request
     *
     * @return \Cake\Datasource\ResultSetInterface
     */
    public function listing($request)
    {
        $query = $this->Articles->find();
        $result = $this->paginate($query);
        $this->addPagingParamToRequest($request);

        return $result;
    }
}
