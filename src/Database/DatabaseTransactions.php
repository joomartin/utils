<?php

namespace Joomartin\Utils\Database;

trait DatabaseTransactions
{
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