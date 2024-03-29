<?php

namespace Temosh\Console;

use Symfony\Component\Console\Helper\HelperInterface;
use Symfony\Component\Console\Input\InputInterface;

interface MongoShellInterface
{

    /**
     * @return \Temosh\Sql\Query\SqlQueryInterface
     *  Instance of SQL query parser.
     */
    public function getSqlQuery();

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *  The Input instance.
     * @param bool $forceNew
     *  Flag indicates that new mongo client should be created even it already exists.
     *
     * @return \Temosh\Mongo\Client\Client
     */
    public function getMongoClientFromInput(InputInterface $input, $forceNew = false);
}
