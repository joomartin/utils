<?php

namespace Joomartin\Utils\Kohana\Testing;

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
    protected function beginTransaction()
    {
        \Model_Database::trans_start();
    }

    /**
     * Ends the transaction
     * @return void
     */
    protected function endTransaction()
    {
        \Model_Database::trans_end([false]);
    }
}