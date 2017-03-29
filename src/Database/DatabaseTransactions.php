<?php

namespace Joomartin\Utils\Database;

trait DatabaseTransactions
{
    public function setUp()
    {
        $this->beginTransaction();
    }

    public function tearDown()
    {
        $this->endTransaction();
    }

    /**
     * Begins the transaction
     * @return void
     */
    abstract public function beginTransaction();

    /**
     * Ends the transaction
     * @return void
     */
    abstract public function endTransaction();
}