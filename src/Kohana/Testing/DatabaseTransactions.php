<?php

namespace Joomartin\Utils\Kohana\Testing;

trait DatabaseTransactions
{
    public function setUp()
    {
        parent::setUp();
        $this->beginTransaction();
    }

    public function tearDown()
    {
        parent::setUp();
        $this->endTransaction();
    }

    /**
     * Begins the transaction
     * @return void
     */
    public function beginTransaction()
    {
        Model_Database::trans_start();
    }

    /**
     * Ends the transaction
     * @return void
     */
    public function endTransaction()
    {
        Model_Database::trans_end([false]);
    }
}