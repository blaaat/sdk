<?php

declare(strict_types=1);

namespace PayNL\Sdk\AuthAdapter;

use PayNL\Sdk\Service\AbstractPluginManager;

/**
 * Class Manager
 *
 * @package PayNL\Sdk\AuthAdapter
 */
class Manager extends AbstractPluginManager
{
    protected $instanceOf = AdapterInterface::class;
}
