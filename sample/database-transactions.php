<?php

use Joomartin\Utils\Database\DatabaseTransactions;

class TestCase extends PHPUnit_Framework_TestCase
{
    use DatabaseTransactions;

    /**
     * Begins the transaction
     * @return void
     */
    public function beginTransaction()
    {
        // Your database transaction begin code here
    }

    /**
     * Ends the transaction
     * @return void
     */
    public function endTransaction()
    {
        // Your database transaction end code here
    }
}

class FooTest extends TestCase
{
    public function setUp()
    {
        // If you override setUp, you have to call parent::setUp
        parent::setUp();
    }

    public function tearDown()
    {
        // If you override tearDown, you have to call parent::tearDown
        parent::tearDown();
    }

    /** @test */
    function it_can_foo()
    {
        // Transaction will begins here

        // Your code here

        // Transaction will ends here
    }
}